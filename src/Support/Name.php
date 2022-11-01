<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Support;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use JsonSerializable;
use Rawilk\LaravelCasters\Casts\NameCast;

/**
 * @property-read string|null $first
 * @property-read string|null $last
 * @property-read string|null $full
 * @property-read string|null $familiar
 * @property-read string|null $abbreviated
 * @property-read string|null $sorted
 * @property-read string|null $initials
 * @property-read string|null $full_possessive
 * @property-read string|null $first_possessive
 * @property-read string|null $last_possessive
 * @property-read string|null $sorted_possessive
 * @property-read string|null $abbreviated_possessive
 * @property-read string|null $initials_possessive
 */
class Name implements JsonSerializable, Jsonable, Castable
{
    public static function from(?string $name): self
    {
        $parts = explode(' ', trim($name), 2);

        $lastName = Arr::get($parts, 1)
            ? Str::squish(Arr::get($parts, 1))
            : null;

        return new static(Arr::get($parts, 0), $lastName);
    }

    public function __construct(protected ?string $firstName, protected ?string $lastName = null)
    {
    }

    public function first(): ?string
    {
        return $this->firstName;
    }

    public function last(): ?string
    {
        return $this->lastName;
    }

    public function full(): ?string
    {
        return collect([$this->firstName, $this->lastName])
            ->filter()
            ->join(' ');
    }

    public function familiar(): ?string
    {
        if ($this->lastName) {
            return sprintf('%s %s.', $this->firstName, Str::firstLetter($this->lastName));
        }

        return $this->firstName;
    }

    public function abbreviated(): ?string
    {
        if ($this->lastName) {
            return sprintf('%s. %s', Str::firstLetter($this->firstName), $this->lastName);
        }

        return $this->firstName;
    }

    public function sorted(): ?string
    {
        if ($this->lastName) {
            return sprintf('%s, %s', $this->lastName, $this->firstName);
        }

        return $this->firstName;
    }

    public function initials(): ?string
    {
        return Str::of($this->full)
            ->replaceMatches('/(\(|\[).*(\)|\])/', '')
            ->matchAll('/([[:word:]])[[:word:]]*/i')
            ->join('');
    }

    protected function possessive(string $name): string
    {
        return sprintf("%s'%s", $name, (Str::endsWith($name, 's') ? null : 's'));
    }

    protected function wantsPossessive(string $key): bool
    {
        return Str::endsWith($key, 'possessive');
    }

    public function __get(string $key): ?string
    {
        if ($this->wantsPossessive($key)) {
            $key = Str::replaceLast('possessive', '', $key);

            return $this->possessive($this->{$key});
        }

        if (method_exists($this, $method = Str::studly($key))) {
            return $this->{$method}();
        }

        return null;
    }

    public function __toString(): string
    {
        return (string) $this->full();
    }

    public static function castUsing(array $arguments): CastsAttributes
    {
        return new NameCast(...$arguments);
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function jsonSerialize(): string
    {
        return (string) $this->full();
    }
}
