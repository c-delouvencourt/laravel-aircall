<?php

namespace CLDT\Aircall;

use CLDT\Aircall\Http\Controllers\AircallWebhooksController;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AircallServiceProvider extends PackageServiceProvider
{
    public function registeringPackage()
    {
        $this->app->bind('aircall', function () {
            return new Aircall();
        });

        parent::registeringPackage();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('aircall')
            ->hasConfigFile()
            ->hasMigration('create_aircall_webhook_calls_table');
    }

    public function bootingPackage()
    {
        $webhookPath = config('aircall.webhook_path');

        Route::post($webhookPath, AircallWebhooksController::class);
    }
}
