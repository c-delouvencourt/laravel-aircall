<?php

namespace CLDT\LaravelAircall;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AircallServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('aircall.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'aircall');

        $client = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . base64_decode(config('aircall.api_id') . ':' . config('aircall.api_token')),
            'Content-Type' => 'application/json',
        ])->baseUrl(config('aircall.endpoint'));

        // Register the main class to use with the facade
        $this->app->singleton('aircall', function () use ($client) {
            return new Aircall($client);
        });
    }
}
