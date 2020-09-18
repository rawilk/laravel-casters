<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Rawilk\LaravelCasters\Casts\Password;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'password' => Password::class,
    ];
}
