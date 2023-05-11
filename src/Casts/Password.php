<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Support\Facades\Hash;

/**
 * @deprecated Use Laravel's hash cast instead. Will be removed in v4
 */
class Password implements CastsInboundAttributes
{
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        if (! Hash::needsRehash($value)) {
            return $value;
        }

        return Hash::make($value);
    }
}
