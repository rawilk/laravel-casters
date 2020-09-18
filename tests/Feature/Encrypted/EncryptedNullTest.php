<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

class EncryptedNullTest extends EncryptedTestCase
{
    protected function getTestValue()
    {
        return null;
    }

    /** @test */
    public function encrypts_nulls(): void
    {
        $this->model->encrypted = $this->value;

        $encryptedValue = $this->getEncryptedAttribute('encrypted');

        self::assertNull($encryptedValue);
    }

    /** @test */
    public function decrypts_nulls(): void
    {
        $this->setRawAttributes(['encrypted' => null]);

        $actualValue = $this->model->encrypted;

        self::assertNull($actualValue);
        self::assertSame($this->value, $actualValue);
    }
}
