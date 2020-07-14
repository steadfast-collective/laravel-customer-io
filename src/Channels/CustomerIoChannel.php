<?php

namespace Steadfastcollective\LaravelCustomerIo\Channels;

use Customerio\Client as CustomerIoClient;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CustomerIoChannel
{
    /**
     * @var Client
     */
    protected $customerIo;

    public function __construct(CustomerIoClient $customerIo)
    {
        $this->customerIo = $customerIo;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification): void
    {
        if (! config('services.customer_io.enabled')) {
            return;
        }

        $notificationName = Str::of(get_class($notification))
            ->afterLast('\\')
            ->snake()
            ->replace('_notification', '');

        $data = array_merge($notification->toCustomerIo($notifiable), [
            'app_environment' => App::environment(),
            'app_url'         => URL::to('/'),
        ]);

        // Notification sent directly to a model.
        if ($notifiable instanceof \Illuminate\Database\Eloquent\Model) {
            if ($notifiable->customer_io_id !== null) {
                $notifiable->syncToCustomerIoNow();
                $this->customerIo->customers->event(
                    [
                        'id'         => $notifiable->customer_io_id,
                        'name'       => (string) $notificationName,
                        'data'       => $data,
                        '_timestamp' => now()->addSeconds(5)->timestamp,
                    ]
                );
            }
        }

        // Notification manually routed.
        else {
            $data['recipient'] = $notifiable->routeNotificationFor('customerIo');

            $this->customerIo->events->anonymous(
                [
                    'name' => (string) $notificationName,
                    'data' => $data,
                ]
            );
        }
    }
}
