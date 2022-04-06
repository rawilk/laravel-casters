<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Support;

use Illuminate\Support\Str as BaseStr;

class Str extends BaseStr
{
    public static function firstLetter(string $value): string
    {
        return mb_substr($value, 0, 1);
    }

    /**
     * This method can be removed if we ever remove support for Laravel 7.*.
     */
    public static function squish($value)
    {
        if (method_exists(BaseStr::class, 'squish')) {
            return parent::squish($value);
        }

        return preg_replace('/\s+/', ' ', trim($value));
    }
}
