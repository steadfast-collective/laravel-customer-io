<?php

namespace Steadfastcollective\LaravelCustomerIo;

use Illuminate\Support\ServiceProvider;
use Customerio\Client as CustomerIoClient;

class LaravelCustomerIoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-customer-io.php' => config_path('laravel-customer-io.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-customer-io.php',
            'laravel-customer-io'
        );

        $this->app->bind(CustomerIoClient::class, function () {
            return new CustomerIoClient(
                config('laravel-customer-io.api_key'),
                config('laravel-customer-io.site_id')
            );
        });
    }
}
