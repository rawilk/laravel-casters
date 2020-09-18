<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature\Encrypted;

use Illuminate\Support\Collection;

class EncryptedObjectCastTest extends EncryptedTestCase
{
    protected function getTestValue()
    {
        return collect(['confidential', 'classified']);
    }

    /** @test */
    public function encrypts_objects(): void
    {
        $this->model->encrypted = $this->value;

        $this->assertEncryption('encrypted');
    }

    /** @test */
    public function decrypts_objects(): void
    {
        $this->setRawAttributes(['encrypted' => $this->encrypted]);

        $actualValue = $this->model->encrypted;

        self::assertInstanceOf(Collection::class, $actualValue);
        self::assertEquals($this->value, $actualValue);
    }
}
