<?php

namespace CLDT\Aircall;

use CLDT\Aircall\Http\Controllers\AircallWebhooksController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AircallServiceProvider extends PackageServiceProvider
{

    public function register()
    {
        $this->app->singleton('aircall', function (){
            return new Aircall();
        });
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('aircall')
            ->hasConfigFile()
            ->hasMigration('create_aircall_webhook_calls_table')
            ->hasInstallCommand(function(InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->askToStarRepoOnGitHub('c-delouvencourt/laravel-aircall');
            });
        ;
    }

    public function bootingPackage()
    {
        $webhookPath = config('aircall.webhook_path');

        Route::post($webhookPath, AircallWebhooksController::class);
    }
}
