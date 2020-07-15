# Customer io notification channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/steadfastcollective/laravel-customer-io.svg?style=flat-square)](https://packagist.org/packages/steadfastcollective/laravel-customer-io)
[![Build Status](https://travis-ci.com/steadfast-collective/laravel-customer-io.svg?branch=master)](https://travis-ci.com/steadfast-collective/laravel-customer-io)
[![Total Downloads](https://img.shields.io/packagist/dt/steadfastcollective/laravel-customer-io.svg?style=flat-square)](https://packagist.org/packages/steadfastcollective/laravel-customer-io)
[![StyleCI](https://github.styleci.io/repos/279264881/shield?branch=master)](https://github.styleci.io/repos/279264881?branch=master)

This package makes it easy to send notifications using the Customer io API with Laravel.

## About

The Customer io channel makes it possible to send out Laravel notifications as a Customer io event.

## Installation

You can install the package via composer:

```bash
composer require steadfastcollective/laravel-customer-io
```

## Setting up the Customer io service
You will need to create a Customer io account to use this channel. Within your account, you will find the API key and the site ID. Place them inside your .env file:

```
CUSTOMER_IO_ENABLED=true
CUSTOMER_IO_SITE_ID=[SITE_ID]
CUSTOMER_IO_API_KEY=[API_KEY]
```

## Usage

Add the trait to your notifiable model:

``` php
use Steadfastcollective\LaravelCustomerIo\Traits\SyncsToCustomerIo;

class User extends Authenticatable
{
    use Notifiable, SyncsToCustomerIo;
    
    // ...
}

```

Adding customer io support to the notification class:

``` php
use Steadfastcollective\LaravelCustomerIo\Channels\CustomerIoChannel;
```
``` php
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            CustomerIoChannel::class,
        ];
    }

    /**
     * Get the customer io representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toCustomerIo($notifiable)
    {
        return [
            // ...
        ];
    }
}
```

### Testing

``` php
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dev@steadfastcollective.com instead of using the issue tracker.

## Credits

- [André Breia](https://github.com/andrebreia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.