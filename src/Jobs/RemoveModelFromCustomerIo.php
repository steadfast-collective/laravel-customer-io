<?php

namespace Steadfastcollective\LaravelCustomerIo\Jobs;

use Customerio\Client as CustomerIoClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class RemoveModelFromCustomerIo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * @var Model
     */
    private $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
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

        resolve('Customerio\Client')->customers->delete([
            'id' => $this->model->customer_io_id,
        ]);
    }
}
