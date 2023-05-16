# Changelog

All notable changes to `laravel-casters` will be documented in this file

## v3.0.3 - 2023-05-16

### What's Changed

- [Name Cast]: Don't attempt to store computed columns to the database by @rawilk in https://github.com/rawilk/laravel-casters/pull/12

**Full Changelog**: https://github.com/rawilk/laravel-casters/compare/v3.0.2...v3.0.3

## v3.0.2 - 2023-05-11

### What's Changed

- Bump creyD/prettier_action from 4.2 to 4.3 by @dependabot in https://github.com/rawilk/laravel-casters/pull/8
- Bump actions/checkout from 2 to 3 by @dependabot in https://github.com/rawilk/laravel-casters/pull/9
- Bump aglipanci/laravel-pint-action from 2.1.0 to 2.2.0 by @dependabot in https://github.com/rawilk/laravel-casters/pull/10
- Bump dependabot/fetch-metadata from 1.3.6 to 1.4.0 by @dependabot in https://github.com/rawilk/laravel-casters/pull/11
- Deprecated the `Password` cast in favor of the `hash` cast added to Laravel in v10.10.0

**Full Changelog**: https://github.com/rawilk/laravel-casters/compare/v3.0.1...v3.0.2

## v3.0.1 - 2023-02-15

### What's Changed

- Bump dependabot/fetch-metadata from 1.3.4 to 1.3.5 by @dependabot in https://github.com/rawilk/laravel-casters/pull/4
- Bump dependabot/fetch-metadata from 1.3.5 to 1.3.6 by @dependabot in https://github.com/rawilk/laravel-casters/pull/6
- Bump aglipanci/laravel-pint-action from 1.0.0 to 2.1.0 by @dependabot in https://github.com/rawilk/laravel-casters/pull/5
- Php 8.2/Laravel 10.x Compatibility by @rawilk in https://github.com/rawilk/laravel-casters/pull/7

**Full Changelog**: https://github.com/rawilk/laravel-casters/compare/v3.0.0...v3.0.1

## v3.0.0 - 2022-11-01

### What's Changed

- Bump actions/checkout from 2 to 3 by @dependabot in https://github.com/rawilk/laravel-casters/pull/2
- Bump creyD/prettier_action from 3.0 to 4.2 by @dependabot in https://github.com/rawilk/laravel-casters/pull/3
- Update syntax to take advantage of newer PHP features

### Breaking Changes

- Drop PHP 7.4 support
- Drop PHP 8.0 support
- Drop Laravel 8.0 support
- Remove Encrypted cast in favor of native laravel encryption cast

**Full Changelog**: https://github.com/rawilk/laravel-casters/compare/v2.0.2...v3.0.0

## 2.0.2 - 2022-04-06

### Fixed

- Make `Rawilk\LaravelCasters\Support\Str` compatible with base `Str` class by making `squish` method signature compatible with parent signature

## 2.0.1 - 2022-02-23

### Updated

- Add Laravel 9.* support
- Add PHP 8.1 support

### Fixed

- Handle null values correctly on Password cast in Laravel 9

## 2.0.0 - 2020-11-12

### Breaking Changes

- Drop support for Laravel 7

### Added

- Add a name cast

## 1.0.1 - 2020-09-21

### Fixed

- Fix bug in password cast causing passwords to be re-hashed - [#1](https://github.com/rawilk/laravel-casters/issues/1).

## 1.0.0 - 2020-09-18

- initial release
