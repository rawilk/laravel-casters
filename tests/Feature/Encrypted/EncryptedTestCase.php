<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Illuminate\Support\Facades\Crypt;
use Rawilk\LaravelCasters\Tests\Models\Model;
use Rawilk\LaravelCasters\Tests\TestCase;

abstract class EncryptedTestCase extends TestCase
{
    protected Model $model;
    protected string $encrypted;

    /** @var mixed */
    protected $value;

    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new Model;
        $this->value = $this->getTestValue();
        $this->encrypted = Crypt::encrypt($this->value);
    }

    abstract protected function getTestValue();

    protected function getEncryptedAttribute(string $attribute): ?string
    {
        return $this->model->getAttributes()[$attribute];
    }

    protected function setRawAttributes(array $attributes): void
    {
        $this->model->setRawAttributes($attributes);
    }

    protected function assertEncryption(string $column): void
    {
        $encryptedValue = $this->getEncryptedAttribute($column);

        self::assertIsString($encryptedValue);
        self::assertNotEquals($this->value, $encryptedValue);
        self::assertEquals($this->value, Crypt::decrypt($encryptedValue));
    }
}
