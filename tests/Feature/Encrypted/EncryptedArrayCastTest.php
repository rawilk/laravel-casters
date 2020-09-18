<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

class EncryptedArrayCastTest extends EncryptedTestCase
{
    protected function getTestValue(): array
    {
        return ['confidential', 'classified'];
    }

    /** @test */
    public function encrypts_arrays(): void
    {
        $this->model->encrypted = $this->value;

        $this->assertEncryption('encrypted');
    }

    /** @test */
    public function decrypts_arrays(): void
    {
        $this->setRawAttributes(['encrypted' => $this->encrypted]);

        $decryptedValue = $this->model->encrypted;

        self::assertIsArray($decryptedValue);
        self::assertSame($this->value, $decryptedValue);
    }
}
