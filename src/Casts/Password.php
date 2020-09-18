<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Support\Facades\Hash;

class Password implements CastsInboundAttributes
{
    public function set($model, string $key, $value, array $attributes)
    {
        return Hash::make($value);
    }
}
