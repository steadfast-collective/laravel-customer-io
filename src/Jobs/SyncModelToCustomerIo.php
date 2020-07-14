<?php

namespace Steadfastcollective\LaravelCustomerIo\Jobs;

use Customerio\Client as CustomerIoClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class SyncModelToCustomerIo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var CustomerIoClient
     */
    private $customerIo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CustomerIoClient $customerIo, Model $model)
    {
        $this->customerIo = $customerIo;
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (! config('laravel-customer-io.enabled')) {
            return;
        }

        $this->customerIo->customers->update($this->model->getCustomerIoData());
    }
}
