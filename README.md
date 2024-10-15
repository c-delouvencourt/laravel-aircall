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
php artisan vendor:publish --provider="CLDT\Aircall\AircallServiceProvider" --tag="config"
```

## Usage

```php
use CLDT\Aircall\Facades\Aircall;

// Get all calls
$allCalls = Aircall::calls()->all();

// Get a call by ID
$call = Aircall::calls()->find($id);

// Get all users 
$allContacts = Aircall::users([
    "from" => "1729028410",
])->all();

```

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