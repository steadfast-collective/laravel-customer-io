<?php

namespace Steadfastcollective\LaravelCustomerIo\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Steadfastcollective\LaravelCustomerIo\Jobs\RemoveModelFromCustomerIo;
use Steadfastcollective\LaravelCustomerIo\Jobs\SyncModelToCustomerIo;

trait SyncsToCustomerIo
{
    protected static function bootSyncsToCustomerIo()
    {
        static::created(function ($model) {
            if ($model->email !== null) {
                $model->syncToCustomerIo();
            }
        });

        static::updated(function ($model) {
            if ($model->email !== null) {
                $model->syncToCustomerIo();
            }
        });

        static::deleting(function ($model) {
            if ($model->email !== null) {
                $model->removeFromCustomerIo();
            }
        });
    }

    /**
     *
     * @return string
     */
    public function getCustomerIoIdAttribute() : string
    {
        $model = Str::of(get_class($this))
            ->afterLast('\\')
            ->snake();

        return "{$model}_{$this->id}";
    }

    /**
     * Set the data that's synced with customer io with a key value array.
     *
     * @return array
     */
    public function toCustomerIoArray() : array
    {
        return array_replace($this->attributesToArray(), [
            'created_at' => $this->created_at->timestamp,
            'updated_at' => $this->updated_at->timestamp,
        ]);
    }

    /**
     * Map the attributes which should be synced to customer io into a key value array.
     *
     * @return array
     */
    public function getCustomerIoData() : array
    {
        return array_merge([
            'app_environment' => App::environment(),
            'locale'          => App::getLocale(),
            'timezone'        => config('app.timezone'),
            'id'              => $this->customer_io_id,
            'model_class'     => $this->getMorphClass(),
            'model_id'        => $this->id,
            '_timestamp'      => now()->timestamp,
        ], $this->toCustomerIoArray);
    }

    public function syncToCustomerIo()
    {
        return SyncModelToCustomerIo::dispatch($this);
    }

    public function syncToCustomerIoNow()
    {
        return SyncModelToCustomerIo::dispatchNow($this);
    }

    public function removeFromCustomerIo()
    {
        return RemoveModelFromCustomerIo::dispatch($this);
    }

    public function removeFromCustomerIoNow()
    {
        return RemoveModelFromCustomerIo::dispatchNow($this);
    }
}
