<?php

namespace CLDT\Aircall\Jobs;


use function collect;
use function dispatch;
use function event;

use CLDT\Aircall\Exceptions\JobClassDoesNotExist;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Spatie\WebhookClient\Models\WebhookCall;
use CLDT\Aircall\Models\AircallWebhookCall;

class ProcessAircallWebhookJob extends ProcessWebhookJob
{
    public AircallWebhookCall | WebhookCall $webhookCall;

    public function handle()
    {
        event("aircall::{$this->webhookCall->eventName()}", $this->webhookCall);
        event("aircall::{$this->webhookCall->eventActionName()}", $this->webhookCall);

        collect(config('aircall.webhook_jobs'))
            ->filter(function (string $jobClassName, $eventActionName) {
                if ($eventActionName === '*') {
                    return true;
                }

                return in_array($eventActionName, [
                    $this->webhookCall->eventName(),
                    $this->webhookCall->eventActionName(),
                ]);
            })
            ->each(function (string $jobClassName) {
                if (! class_exists($jobClassName)) {
                    throw JobClassDoesNotExist::make($jobClassName);
                }
            })
            ->each(fn (string $jobClassName) => dispatch(new $jobClassName($this->webhookCall)));
    }
}