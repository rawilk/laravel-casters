<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class EncryptedDateTimeCastTest extends EncryptedTestCase
{
    protected function getTestValue()
    {
        return now();
    }

    /** @test */
    public function encrypts_dates(): void
    {
        $this->model->datetime = $this->value;

        $this->assertEncryption('datetime');
    }

    /** @test */
    public function decrypts_dates(): void
    {
        $this->setRawAttributes(['datetime' => $this->encrypted]);

        $actualValue = $this->model->datetime;

        self::assertInstanceOf(Carbon::class, $actualValue);
        self::assertEquals($this->value, $actualValue);
        self::assertTrue($this->value->equalTo($actualValue));
    }

    /** @test */
    public function casts_dates(): void
    {
        $this->setRawAttributes(['datetime' => Crypt::encrypt($this->value->format('Y-m-d H:i:s.u'))]);

        $actualValue = $this->model->datetime;

        self::assertInstanceOf(Carbon::class, $actualValue);
        self::assertEquals($this->value, $actualValue);
        self::assertTrue($this->value->equalTo($actualValue));
    }
}
