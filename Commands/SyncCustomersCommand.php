<?php

namespace SteadfastCollective\LaravelCustomerIo\Commands;

use Illuminate\Console\Command;

class SyncCustomersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer-io:sync-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync customers with customer.io.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = config('laravel-customer-io.model');

        $this->errorMessages = [];

        $progressBar = $this->output->createProgressBar((new $model)->count());

        foreach ((new $model)->cursor() as $customer) {
            try {
                $customer->syncToCustomerIo();
            } catch (\Exception $exception) {
                $this->errorMessages[$customer->getKey()] = $exception->getMessage();
            }
            $progressBar->advance();
        }

        $progressBar->finish();

        if (count($this->errorMessages)) {
            $this->warn("\nAll done, but with some error messages:");
            foreach ($this->errorMessages as $customerId => $message) {
                $this->warn("\nCustomer id {$customerId}: `{$message}`");
            }
        }

        $this->info("\nAll done!");
    }
}
