<?php

namespace Steadfastcollective\LaravelCustomerIo;

use Customerio\Client as CustomerIoClient;
use Illuminate\Support\ServiceProvider;

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
