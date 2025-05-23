---
title: Introduction
sort: 1
---

## Introduction

Casts for Laravel is a collection of custom class casts for Laravel Eloquent Models. This package allows you to quickly
and easily add casts for names and hashing passwords on your user models.

```php
protected $casts = [
    // Hashes the value when assigning to `$model->password`.
    'password' => Password::class,

    // Provides utilities for manipulating a name
    'name' => Name::class,
];
```

## Alternatives

Some alternatives to this package include:

- [crudly/encrypted](https://github.com/Crudly/Encrypted)
- [watson/nameable](https://github.com/dwightwatson/nameable)

## Disclaimer

This package is not affiliated with, maintained, authorized, endorsed or sponsored by Laravel or any of its affiliates.
