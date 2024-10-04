<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Arr;
use Rawilk\LaravelCasters\Contracts\HasSingleNameColumn;
use Rawilk\LaravelCasters\Support\Name;

class NameCast implements CastsAttributes
{
    public function __construct(protected ?string $firstName = null, protected ?string $lastName = null)
    {
        $this->firstName = $firstName ?: 'first_name';
        $this->lastName = $lastName ?: 'last_name';
    }

    public function get($model, string $key, $value, array $attributes): Name
    {
        // We're probably dealing with a single column instead of a combination
        // of two columns.
        if (Arr::has($attributes, $key)) {
            return Name::from($value);
        }

        $firstName = Arr::get($attributes, $this->firstName);
        $lastName = Arr::get($attributes, $this->lastName);

        return Name::from("{$firstName} {$lastName}");
    }

    public function set($model, string $key, $value, array $attributes): array
    {
        // We're probably dealing with a single column instead of a combination
        // of two columns.
        if (! $value instanceof Name) {
            return [$key => $value];
        }

        if ($model instanceof HasSingleNameColumn) {
            return [$key => $value->full];
        }

        return [
            $this->firstName => $value->first,
            $this->lastName => $value->last,
        ];
    }
}
