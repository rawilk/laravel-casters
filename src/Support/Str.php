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
}
