<?php

namespace Steadfastcollective\LaravelCustomerIo;

use Customerio\Client as CustomerIoClient;
use Illuminate\Support\ServiceProvider;
use Steadfastcollective\LaravelCustomerIo\Commands\SyncCustomersCommand;

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

        $this->app->bind('command.customer-io:sync-customers', SyncCustomersCommand::class);

        $this->commands([
            'command.customer-io:sync-customers',
        ]);
    }
}
