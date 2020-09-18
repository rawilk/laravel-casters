<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Crypt;
use Rawilk\LaravelCasters\Support\Caster;

class Encrypted implements CastsAttributes
{
    protected ?string $castType;
    protected Caster $caster;

    public function __construct(string $castType = null)
    {
        $this->castType = $castType === 'null' ? null : $castType;

        if ($this->castType) {
            $this->caster = new Caster($this->castType);
        }
    }

    public function get($model, string $key, $value, array $attributes)
    {
        if (! is_null($value)) {
            $value = Crypt::decrypt($value);
        }

        if (! $this->castType) {
            return $value;
        }

        return $this->caster->setModel($model)->coerce($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        return Crypt::encrypt($value);
    }
}
