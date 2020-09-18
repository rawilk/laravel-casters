---
title: Introduction
sort: 1
---

## Introduction

`laravel-casters` is a collection of custom class casts for Laravel Eloquent Models. This package allows you to quickly
and easily add casts for encrypting attributes and hashing passwords on your user models.

```php
protected $casts = [
    // Hashes the value when assigning to `$model->password`.
    'password' => Password::class,

    // Encrypts on write, decrypts on read.
    'classified' => Encrypted::class,

    // Encrypts on write, decrypts and typecasts to integer on read.
    'secret_number' => Encrypted::class . ':integer',
];
```

## Alternatives

Some alternatives to this package include:

- [crudly/encrypted](https://github.com/Crudly/Encrypted)
