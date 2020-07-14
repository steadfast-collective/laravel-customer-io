<?php

namespace Steadfastcollective\LaravelCustomerIo;

use Customerio\Client as CustomerIoClient;
use Illuminate\Support\ServiceProvider;

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
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-customer-io');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-customer-io');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-customer-io.php' => config_path('laravel-customer-io.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-customer-io'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-customer-io'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-customer-io'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-customer-io.php', 'laravel-customer-io');

        $this->app->bind(CustomerIoClient::class, function () {
            return new CustomerIoClient(
                config('laravel-customer-io.api_key'),
                config('laravel-customer-io.site_id')
            );
        });
    }
}
