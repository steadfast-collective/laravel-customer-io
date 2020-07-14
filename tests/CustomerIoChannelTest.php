<?php

namespace Steadfastcollective\LaravelCustomerIo\Tests;

use Customerio\Client as CustomerIoClient;
use Illuminate\Notifications\Notification;
use Mockery;
use Orchestra\Testbench\TestCase;
use Steadfastcollective\LaravelCustomerIo\Channels\CustomerIoChannel;

class CustomerIoChannelTest extends TestCase
{
    /** @var Mockery\Mock */
    protected $customerIo;

    /** @var \Steadfastcollective\LaravelCustomerIo\Channels\CustomerIoChannel */
    protected $channel;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->customerIo = Mockery::mock(CustomerIoClient::class);
        $this->channel = new CustomerIoChannel($this->customerIo);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_can_send_a_notification_to_notifiable()
    {
        $this->markTestIncomplete();

        // $this->customerIo
        //     ->shouldReceive('customers->event')
        //     ->once()
        //     ->with('https://api.customer.io/v1/api/events', ['data' => ['name' => 'John Doe']], false);

        // $this->channel->send(new TestNotifiable(), new TestNotification());
    }

    public function it_can_send_a_notification_manually_routed()
    {
        $this->markTestIncomplete();
    }
}


class TestNotifiable
{
    use \Illuminate\Notifications\Notifiable;

    /**
     * @return int
     */
    public function routeNotificationForCustomerIo()
    {
        return false;
    }
}


class TestNotification extends Notification
{
    /**
     * @param $notifiable
     */
    public function toCustomerIo($notifiable)
    {
        return [
            'name' => 'John Doe',
        ];
    }
}
