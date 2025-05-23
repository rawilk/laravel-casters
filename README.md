# Casts for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rawilk/laravel-casters.svg?style=flat-square)](https://packagist.org/packages/rawilk/laravel-casters)
![Tests](https://github.com/rawilk/laravel-casters/workflows/Tests/badge.svg?style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/rawilk/laravel-casters.svg?style=flat-square)](https://packagist.org/packages/rawilk/laravel-casters)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/rawilk/laravel-casters?style=flat-square)](https://packagist.org/packages/rawilk/laravel-casters)
[![License](https://img.shields.io/github/license/rawilk/laravel-casters?style=flat-square)](https://github.com/rawilk/laravel-casters/blob/main/LICENSE.md)

![Social image](https://banners.beyondco.de/Casts%20for%20Laravel.png?theme=light&packageManager=composer+require&packageName=rawilk%2Flaravel-casters&pattern=architect&style=style_1&description=A+collection+of+custom+casts+for+Laravel.&md=1&showWatermark=0&fontSize=100px&images=check)

Casts for Laravel is a collection of custom class casts for Laravel Eloquent Models. This package allows you to quickly
and easily add casts for names and hashing passwords on your user models.

```php
protected $casts = [
    // Hashes the value when assigning to `$model->password`.
    // Note: Password cast is now deprecated. Use Laravel's hash cast instead.
    'password' => Password::class,

    // Provides utilities for manipulating a name
    'name' => Name::class,
];
```

## Installation

You can install the package via composer:

```bash
composer require rawilk/laravel-casters
```

## Documentation

For documentation, please refer to: https://randallwilk.dev/docs/laravel-casters

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

Please review [my security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Randall Wilk](https://github.com/rawilk)
- [All Contributors](../../contributors)

## Alternatives

Some alternatives to this package include:

- [crudly/encrypted](https://github.com/Crudly/Encrypted)
- [watson/nameable](https://github.com/dwightwatson/nameable)

## Disclaimer

This package is not affiliated with, maintained, authorized, endorsed or sponsored by Laravel or any of its affiliates.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
