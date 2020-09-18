<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

class EncryptedDecimalCastTest extends EncryptedTestCase
{
    protected function getTestValue()
    {
        return 12.838;
    }

    /** @test */
    public function casts_to_decimal(): void
    {
        $this->setRawAttributes(['decimal_2' => $this->encrypted, 'decimal_4' => $this->encrypted]);

        $decimal2 = $this->model->decimal_2;
        $decimal4 = $this->model->decimal_4;

        self::assertSame('12.84', $decimal2);
        self::assertSame('12.8380', $decimal4);
    }
}
