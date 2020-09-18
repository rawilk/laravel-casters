# laravel-casters

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rawilk/laravel-casters.svg?style=flat-square)](https://packagist.org/packages/rawilk/laravel-casters)
![Tests](https://github.com/rawilk/laravel-casters/workflows/Tests/badge.svg?style=flat-square)
[![Total Downloads](https://img.shields.io/packagist/dt/rawilk/laravel-casters.svg?style=flat-square)](https://packagist.org/packages/rawilk/laravel-casters)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require rawilk/laravel-casters
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Rawilk\LaravelCasters\LaravelCastersServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Rawilk\LaravelCasters\LaravelCastersServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$laravel-casters = new Rawilk\LaravelCasters;
echo $laravel-casters->echoPhrase('Hello, Rawilk!');
```

## Testing

``` bash
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

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
