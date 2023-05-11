---
title: Password
sort: 2
---

## Introduction

> {note} This cast is now deprecated in favor of the `hash` cast added to laravel in v10.10.0. This cast will be removed in v4 of this package.

If you're like me, you find it a chore to always have to hash a password for your user model. With this cast,
your passwords will automatically be hashed on your models. This cast only mutates values, so you will still
see the hashed version of the password when referencing it on your models.

## Usage

```php
<?php

namespace App\Models;

use Rawilk\LaravelCasters\Casts\Password;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $casts = [
        'password' => Password::class,
    ];
}
```

This will hash the password using Laravel's `Hash` facade. You can still check against the hashed password using `Hash::check()`:

```php
$user = new User;
$user->password = 'secret';

$user->password; // $2y$10...

Hash::check('secret', $user->password); // true
Hash::check('something-wrong', $user->password); // false
```
