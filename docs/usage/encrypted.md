---
title: Encrypted
sort: 1
---

## Introduction

With the `Encrypted` caster, you can encrypt and decrypt columns on your models automatically.

## Basic Usage

Mark any column on your model as encrypted:

```php
<?php

namespace App\Models;

use Rawilk\LaravelCasters\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $casts = [
        'something_secret' => Encrypted::class,
    ];
}
```

You can work with the attribute as you normally would, but it will be encrypted in the database.

```php
$user = new User;

$user->something_secret = 'secret info';
$user->save();
```

## Type Casting

Encryption serializes the variable and decryption unserializes it, so you get out exactly what you put in. This usually
means that no type casting is needed.

There may be cases however that you want everything casted to some type even if you put something else in. In those cases you can
specify types (all of Eloquent's default casts are supported):

```php
<?php

namespace App\Models;

use Rawilk\LaravelCasters\Casts\Encrypted;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $casts = [
        'an_integer' => Encrypted::class . ':integer',
        'a_string' => Encrypted::class . ':string',
        'decimal_with_two_places' => Encrypted::class . ':decimal:2',
    ];
}
```
