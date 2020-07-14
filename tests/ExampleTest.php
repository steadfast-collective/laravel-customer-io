<?php

namespace Steadfastcollective\LaravelCustomerIo\Tests;

use Orchestra\Testbench\TestCase;
use Steadfastcollective\LaravelCustomerIo\LaravelCustomerIoServiceProvider;

class ExampleTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelCustomerIoServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
