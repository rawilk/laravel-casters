<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Support;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Caster
{
    use HasAttributes;

    protected string $castType;

    protected Model $model;

    public function __construct(string $castType)
    {
        $this->castType = $castType;
    }

    public function coerce($value)
    {
        if (! is_string($value)) {
            if (in_array($this->castType, ['array', 'json'], true)) {
                return (array) $value;
            }

            if ($this->castType === 'collection') {
                return $value instanceof Collection ? $value : collect($value);
            }

            if ($this->castType === 'object') {
                return (object) $value;
            }

            if (is_object($value) && in_array($this->castType, ['date', 'datetime'], true)) {
                return (object) $value;
            }
        }

        // Don't specify key, we override getCastType to provide the correct type.
        return $this->castAttribute('', $value);
    }

    protected function getCastType(): string
    {
        if ($this->isCustomDateTimeCast($this->castType)) {
            return 'custom_datetime';
        }

        if ($this->isDecimalCast($this->castType)) {
            return 'decimal';
        }

        return strtolower(trim($this->castType));
    }

    /**
     * Tell HasAttributes::castAttribute() that we don't use further casting classes.
     *
     * @return bool
     */
    protected function isClassCastable(): bool
    {
        return false;
    }

    public function getCasts(): array
    {
        return [null => $this->castType];
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getDateFormat(): string
    {
        return $this->model->getDateFormat();
    }
}
