# Customer io notification channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/steadfastcollective/laravel-customer-io.svg?style=flat-square)](https://packagist.org/packages/steadfastcollective/laravel-customer-io)
[![Build Status](https://img.shields.io/travis/steadfastcollective/laravel-customer-io/master.svg?style=flat-square)](https://travis-ci.org/steadfastcollective/laravel-customer-io)
[![Quality Score](https://img.shields.io/scrutinizer/g/steadfastcollective/laravel-customer-io.svg?style=flat-square)](https://scrutinizer-ci.com/g/steadfastcollective/laravel-customer-io)
[![Total Downloads](https://img.shields.io/packagist/dt/steadfastcollective/laravel-customer-io.svg?style=flat-square)](https://packagist.org/packages/steadfastcollective/laravel-customer-io)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require steadfastcollective/laravel-customer-io
```

## Usage

Env variables:
``` php
CUSTOMER_IO_ENABLED
CUSTOMER_IO_SITE_ID
CUSTOMER_IO_API_KEY
```

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
// TODO
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email andre@steadfastcollective.com instead of using the issue tracker.

## Credits

- [André Breia](https://github.com/steadfastcollective)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.