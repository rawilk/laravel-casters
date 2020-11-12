---
title: Name
sort: 3
---

## Introduction

The name cast provides a cast/formatter for presenting your user's names. It can get a user's first, last or full name,
their initials, and common abbreviations. This cast will also allow you to store a user's name in a single column and
fetch what you need.

This cast is based on the [nameable](https://github.com/dwightwatson/nameable) cast by [@dwightwatson](https://github.com/dwightwatson).

## Usage

Add either the `NameCast` or `Name` class as a cast on your model's name field. Using either class will give the same result.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rawilk\LaravelCasters\Casts\NameCast;
use Rawilk\LaravelCasters\Support\Name;

class User extends Model
{
    protected $casts = [
        'name' => Name::class,
        
        // Or
        // 'name' => NameCast::class,
    ];
}
```

## Manipulations

There are several manipulations you can perform on a `Name` instance. Below is a demonstration of each of them
using the `User` model defined above:

```php
$user = new User(['name' => 'John Smith']);

echo $user->name->full; // 'John Smith'
echo $user->name->first; // 'John'
echo $user->name->last; // 'Smith'
echo $user->name->familiar; // 'John S.'
echo $user->name->abbreviated; // 'J. Smith'
echo $user->name->sorted; // 'Smith, John'
echo $user->name->initials; // 'JS'
```

There are also possessive variants you can use which will even work with names that end in `s`:

```php
$user = new User(['name' => 'John Doe']);

echo $user->name->full_possessive; // John Doe's
echo $user->name->first_possessive; // John's
echo $user->name->last_possessive; // Doe's
echo $user->name->abbreviated_possessive; // J. Doe's
echo $user->name->sorted_possessive; // Doe, John's
echo $user->name->initials_possessive; // JD's

$user = new User(['name' => 'Angus Young']);

$user->name->full_possessive; // Angus Young's
$user->name->first_possessive; // Angus'
```

If a user doesn't provide a full name (for example, just a first name) the attributes will just omit the last name.

## Casting from multiple fields

If you prefer to separate your user's first and last names in the database, this cast will still work as well.
You can create a "name" field at runtime on your model from your model's first and last name attributes.

If you have a `first_name` and `last_name` attribute on your model, you can cast it like this:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rawilk\LaravelCasters\Support\Name;

class User extends Model
{
    // $fillable not needed, just here to show the user has those fields...
    protected $fillable = ['first_name', 'last_name'];

    protected $casts = [
        'name' => Name::class,
    ];
}
```

Now when you create a new User model with a first and last name, it will be able to grab them and instantiate a new `Name` instance from them.

```php
$user = new User(['first_name' => 'John', 'last_name' => 'Smith']);

echo $user->name->full; // 'John Smith'
echo $user->name->initials; // 'JS'
```

### Using custom first and last name attribute names

If you have your first or last name attributes named something different in the database, you can specify the column names in the
cast definition:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rawilk\LaravelCasters\Support\Name;

class User extends Model
{
    protected $casts = [
        'name' => Name::class . ':given_name,family_name',
    ];
}
```

Now the name cast will use the `given_name` attribute as the user's "first_name", and
the `family_name` attribute as the user's "last_name" when casting the name attribute.

```php
$user = new User(['given_name' => 'John', 'family_name' => 'Smith']);

echo $user->name->full; // 'John Smith'
```

## Using Without a Model

You can alternatively use the `Name` class without it being a cast on a model. Just provide a name to it directly:

```php
<?php

namespace App;

use Rawilk\LaravelCasters\Support\Name;

$name = new Name('Randall', 'James Wilk');

// or
$name = Name::from('Randall James Wilk');

echo $name->full; // Randall James Wilk
echo $name->initials; // RJW
```
