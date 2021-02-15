<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enable / Disable
    |--------------------------------------------------------------------------
    |
    | If set to false it will prevent sending the events to customer.io,
    | disabling notifications via this channel.
    |
    */

    'enabled' => env('CUSTOMER_IO_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    */

    'site_id' => env('CUSTOMER_IO_SITE_ID'),

    'api_key' => env('CUSTOMER_IO_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Customer.io Model
    |--------------------------------------------------------------------------
    |
    | This is the model in your application that implements the
    | SyncsToCustomerIo trait.
    |
    */

    'model' => env('CUSTOMER_IO_MODEL', App\Models\User::class),
];
