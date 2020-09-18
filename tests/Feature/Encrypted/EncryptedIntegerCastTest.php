<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Illuminate\Support\Facades\Crypt;

class EncryptedIntegerCastTest extends EncryptedTestCase
{
    protected function getTestValue(): int
    {
        return 359;
    }

    /** @test */
    public function encrypts_integers(): void
    {
        $this->model->encrypted = $this->value;

        $this->assertEncryption('encrypted');
    }

    /** @test */
    public function decrypts_integers(): void
    {
        $this->setRawAttributes(['encrypted' => $this->encrypted]);

        $actualValue = $this->model->encrypted;

        self::assertSame($this->value, $actualValue);
    }

    /**
     * @test
     * @dataProvider integersToCast
     * @param mixed $valueToCast
     * @param int $expectedValue
     */
    public function casts_to_integer($valueToCast, int $expectedValue): void
    {
        $this->setRawAttributes(['integer_integer' => Crypt::encrypt($valueToCast)]);

        $actualValue = $this->model->integer_integer;

        self::assertIsInt($actualValue);
        self::assertSame($expectedValue, $actualValue);

        // Also test the "int" alias.
        $this->setRawAttributes(['integer_int' => Crypt::encrypt($valueToCast)]);

        $actualValue = $this->model->integer_int;

        self::assertIsInt($actualValue);
        self::assertSame($expectedValue, $actualValue);
    }

    public function integersToCast(): array
    {
        return [
            [60.1, 60],
            ['55', 55],
            [73.4, 73],
        ];
    }
}
