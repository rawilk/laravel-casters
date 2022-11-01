<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Illuminate\Support\Facades\Crypt;

class EncryptedFloatTest extends EncryptedTestCase
{
    protected function getTestValue(): float
    {
        return 44.7;
    }

    /** @test */
    public function encrypts_floats(): void
    {
        $this->model->encrypted = $this->value;

        $this->assertEncryption('encrypted');
    }

    /** @test */
    public function decrypts_floats(): void
    {
        $this->setRawAttributes(['encrypted' => $this->encrypted]);

        $actualValue = $this->model->encrypted;

        self::assertIsFloat($actualValue);
        self::assertSame($this->value, $actualValue);
    }

    /**
     * @test
     * @dataProvider floatValues
     *
     * @param  mixed  $valueToCast
     * @param  float  $expectedValue
     */
    public function casts_as_float($valueToCast, float $expectedValue): void
    {
        $this->setRawAttributes(['float_float' => Crypt::encrypt($valueToCast)]);

        $actualValue = $this->model->float_float;

        self::assertIsFloat($actualValue);
        self::assertSame($expectedValue, $actualValue);
    }

    /** @test */
    public function casts_as_real(): void
    {
        $this->model->setRawAttributes(['float_real' => Crypt::encrypt('22.3')]);

        $actualValue = $this->model->float_real;

        self::assertSame(22.3, $actualValue);
    }

    /** @test */
    public function casts_as_double(): void
    {
        $this->model->setRawAttributes(['float_double' => Crypt::encrypt((int) 15)]);

        $actualValue = $this->model->float_double;

        self::assertSame(15.0, $actualValue);
    }

    public function floatValues(): array
    {
        return [
            [35, 35.0],
            ['49.87', 49.87],
        ];
    }
}
