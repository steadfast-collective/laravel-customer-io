<?php

namespace Steadfastcollective\LaravelCustomerIo;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Steadfastcollective\LaravelCustomerIo\Skeleton\SkeletonClass
 */
class LaravelCustomerIoFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-customer-io';
    }
}
