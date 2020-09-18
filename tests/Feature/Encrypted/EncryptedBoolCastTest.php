<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Illuminate\Support\Facades\Crypt;

class EncryptedBoolCastTest extends EncryptedTestCase
{
    protected function getTestValue(): bool
    {
        return true;
    }

    /** @test */
    public function encrypts_boolean_values(): void
    {
        $this->model->encrypted = $this->value;

        $this->assertEncryption('encrypted');
    }

    /** @test */
    public function decrypts_boolean_values(): void
    {
        $this->setRawAttributes(['encrypted' => $this->encrypted]);

        $value = $this->model->encrypted;

        self::assertSame($this->value, $value);
    }

    /**
     * @test
     * @dataProvider valuesToCast
     * @param mixed $valueToEncrypt
     * @param bool $expectedValue
     */
    public function casts_to_boolean($valueToEncrypt, bool $expectedValue): void
    {
        $this->setRawAttributes(['bool_bool' => Crypt::encrypt($valueToEncrypt)]);

        $actualValue = $this->model->bool_bool;

        self::assertIsBool($actualValue);
        self::assertSame($expectedValue, $actualValue);

        // Test with the 'boolean' alias too.
        $this->setRawAttributes(['bool_boolean' => Crypt::encrypt($valueToEncrypt)]);

        $actualValue = $this->model->bool_boolean;

        self::assertIsBool($actualValue);
        self::assertSame($expectedValue, $actualValue);
    }

    public function valuesToCast(): array
    {
        return [
            ['true', true],
            ['false', true],
            [1, true],
            [15, true],
            [0, false],
            ['', false],
        ];
    }
}
