<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Illuminate\Support\Facades\Crypt;

class EncryptedStringCastTest extends EncryptedTestCase
{
    protected function getTestValue(): string
    {
        return 'secret';
    }

    /** @test */
    public function encrypts_strings(): void
    {
        $this->model->encrypted = $this->value;

        $this->assertEncryption('encrypted');
    }

    /** @test */
    public function decrypts_strings(): void
    {
        $this->setRawAttributes(['encrypted' => $this->encrypted]);

        $actualValue = $this->model->encrypted;

        self::assertIsString($actualValue);
        self::assertSame($this->value, $actualValue);
    }

    /** @test */
    public function casts_to_string(): void
    {
        $this->model->setRawAttributes(['string' => Crypt::encrypt(60.1)]);

        $actualValue = $this->model->string;

        self::assertIsString($actualValue);
        self::assertSame('60.1', $actualValue);
    }
}
