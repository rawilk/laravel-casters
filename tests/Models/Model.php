<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Rawilk\LaravelCasters\Casts\Encrypted;
use Rawilk\LaravelCasters\Casts\Password;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'encrypted' => Encrypted::class,

        'integer_int' => Encrypted::class . ':int',
        'integer_integer' => Encrypted::class . ':integer',

        'float_real' => Encrypted::class . ':real',
        'float_float' => Encrypted::class . ':float',
        'float_double' => Encrypted::class . ':double',

        'decimal_2' => Encrypted::class . ':decimal:2',
        'decimal_4' => Encrypted::class . ':decimal:4',

        'string' => Encrypted::class . ':string',

        'bool_bool' => Encrypted::class . ':bool',
        'bool_boolean' => Encrypted::class . ':boolean',

        'datetime' => Encrypted::class . ':datetime',

        'password' => Password::class,
    ];
}
