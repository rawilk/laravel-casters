<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Arr;
use Rawilk\LaravelCasters\Support\Name;

class NameCast implements CastsAttributes
{
    protected ?string $firstName;
    protected ?string $lastName;

    public function __construct(?string $firstName = null, ?string $lastName = null)
    {
        $this->firstName = $firstName ?: 'first_name';
        $this->lastName = $lastName ?: 'last_name';
    }

    public function get($model, string $key, $value, array $attributes): Name
    {
        if ($value) {
            return Name::from($value);
        }

        $firstName = Arr::get($attributes, $this->firstName);
        $lastName = Arr::get($attributes, $this->lastName);

        return Name::from("{$firstName} {$lastName}");
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        return (string) $value;
    }
}
