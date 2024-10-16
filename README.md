# Aircall API for Laravel 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cdelouvencourt/laravel-aircall.svg?style=flat-square)](https://packagist.org/packages/cdelouvencourt/laravel-aircall)
[![Total Downloads](https://img.shields.io/packagist/dt/cdelouvencourt/laravel-aircall.svg?style=flat-square)](https://packagist.org/packages/cdelouvencourt/laravel-aircall)
![GitHub Actions](https://github.com/cdelouvencourt/laravel-aircall/actions/workflows/main.yml/badge.svg)

This package provides a simple way to interact with the Aircall API in your Laravel application.

## Installation

You can install the package via composer:

```bash
composer require cldt/laravel-aircall
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="CLDT\Aircall\AircallServiceProvider" --tag="aircall-config"
```

Configure the package with your Aircall API credentials in the `config/aircall.php` file.
Follow the instructions in the file to get your API credentials.

Next, you can publish the migration with:
```bash
php artisan vendor:publish --provider="CLDT\Aircall\AircallServiceProvider" --tag="aircall-migrations"
```

After the migration has been published you can create the `aircall_calls` table by running the migrations:

```bash
php artisan migrate
```

Next you can work with the Aircall API using the `Aircall` facade or the `Aircall` webhook processor.

# Usage

## API

You can consume the Aircall API using the `Aircall` facade. All methods available in the Aircall API are available in this package.

```php

use CLDT\Aircall\Facades\Aircall;

// Get all calls
$allCalls = Aircall::calls()->all();

// Get a teams by id
$call = Aircall::teams()->find($id);

// Get all users 
$allContacts = Aircall::users([
    "from" => "1729028410",
])->all();

```

## Webhook

Aircall will send out webhooks for several event types. You can find
the [full list of events types](https://developer.aircall.io/api-references/#webhook-usage)
in the Aircall documentation.

Aircall will sign all requests hitting the webhook url of your app with a token. This package will automatically verify if the
token is valid. If it is not, the request was probably not sent by Aircall and will be refused.

Unless something goes terribly wrong, this package will always respond with a `200` to webhook requests. Sending a `200`
will prevent Aircall from resending the same event over and over again. All webhook requests with a valid signature will
be logged in the `aircall_webhook_calls` table (table name is configurable in the config file). The table has a `payload` column where the entire payload of the incoming
webhook is saved.

If the signature is not valid, the request will not be logged in the `aircall_webhook_calls` table but
a `Spatie\GitHubWebhooks\WebhookFailed` exception will be thrown. If something goes wrong during the webhook request the
thrown exception will be saved in the `exception` column. In that case the controller will send a `500` instead of `200`.

There are two ways this package enables you to handle webhook requests: you can opt to queue a job or listen to the
events the package will fire.

### Handling webhook requests using jobs

If you want to do something when a specific event type comes in you can define a job that does the work. Here's an
example of such a job:

```php
namespace App\Jobs\AircallWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use CLDT\Aircall\Models\AircallWebhookCall;

class HandleUserCreatedWebhookJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public AircallWebhookCall $aircallWebhookCall;

    public function __construct(
        public AircallWebhookCall $webhookCall
    ) {}

    public function handle()
    {
        // do your work here

        // you can access the payload of the webhook call with `$this->webhookCall->payload`
    }
}
```

We highly recommend that you make this job queueable, because this will minimize the response time of the webhook
requests. This allows you to handle more Aircall webhook requests and avoid timeouts.

After having created your job you must register it at the `webhook_jobs` array in the `aircall.php` config file. The key
should be the name of [the Aircall event type](https://developer.aircall.io/api-references/#payload). Optionally, you can let it follow with a dot and the value that is in the action key of the payload of a event.

```php
// config/aircall.php

'webhook_jobs' => [
   'user.created' => \App\Jobs\Aircall\HandleAircallUserCreatedJob::class, // will be called when user are created
   '*' => \App\Jobs\Aircall\HandleAllWebhooks::class // will be called when any event/action comes in
],
```

### Working with a `AircallWebhookCall` model

The `CLDT\Aircall\Models\AircallWebhookCall` model contains some handy methods:

- `eventName()`: returns the event name and action name of a webhooks, for example `user.created`
- `payload($key = null)`: returns the payload of the webhook as an array. Optionally, you can pass a key in the payload which value you needed. For deeply nested values you can use dot notation (example: `$githubWebhookCall->payload('issue.user.login');`).

### Handling webhook requests using events

Instead of queueing jobs to perform some work when a webhook request comes in, you can opt to listen to the events this
package will fire. Whenever a valid request hits your app, the package will fire
a `aircall::<name-of-the-event>` event.

The payload of the events will be the instance of `AircallWebhookCall` that was created for the incoming request.

Let's take a look at how you can listen for such an event. In the `EventServiceProvider` you can register listeners.

```php
/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    'aircall::user.created' => [
        App\Listeners\UserCreated::class,
    ],
];
```

Here's an example of such a listener:

```php
<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use CLDT\Aircall\Models\AircallWebhookCall;

class UserCreated implements ShouldQueue
{
    public function handle(AircallWebhookCall $webhookCall)
    {
        // do your work here

        // you can access the payload of the webhook call with `$webhookCall->payload`
    }
}
```

We highly recommend that you make the event listener queueable, as this will minimize the response time of the webhook
requests. This allows you to handle more GitHub webhook requests and avoid timeouts.

The above example is only one way to handle events in Laravel. To learn the other options,
read [the Laravel documentation on handling events](https://laravel.com/docs/5.5/events).

## Deleting processed webhooks

The `CLDT\Aircall\Models\AircallWebhookCall` is [`MassPrunable`](https://laravel.com/docs/8.x/eloquent#mass-pruning). To delete all processed webhooks every day you can schedule this command.

```php
$schedule->command('model:prune', [
    '--model' => [\CLDT\Aircall\Models\AircallWebhookCall::class],
])->daily();
```

All models that are older than the specified amount of days in the `webhook_prune_calls_after_days` key of the `aircall` config file will be deleted.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email clement@meilleursbiens.com instead of using the issue tracker.

## Credits

-   [Clément de Louvencourt](https://github.com/cdelouvencourt)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.