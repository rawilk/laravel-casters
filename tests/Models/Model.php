<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Rawilk\LaravelCasters\Support\Name;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $casts = [
        'name' => Name::class,
        'custom_name' => Name::class . ':given_name,family_name',
    ];
}
