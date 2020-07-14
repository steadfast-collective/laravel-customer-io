<?php

namespace Steadfastcollective\LaravelCustomerIo;

use Illuminate\Support\ServiceProvider;
use Customerio\Client as CustomerIoClient;

class LaravelCustomerIoServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(CustomerIoClient::class, function () {
            return new CustomerIoClient(
                config('services.customer_io.api_key'),
                config('services.customer_io.site_id')
            );
        });
    }
}
