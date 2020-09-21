<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Rawilk\LaravelCasters\Tests\Models\Model;
use Rawilk\LaravelCasters\Tests\TestCase;

class PasswordTest extends TestCase
{
    /** @test */
    public function it_hashes_passwords(): void
    {
        $model = new Model(['password' => 'secret']);

        $passwordFromAttributes = $model->getAttributes()['password'];

        self::assertIsString($passwordFromAttributes);
        self::assertNotSame('secret', $passwordFromAttributes);
        self::assertTrue(Hash::check('secret', $passwordFromAttributes));

        self::assertIsString($model->password);
        self::assertNotSame('secret', $model->password);
        self::assertTrue(Hash::check('secret', $model->password));

        $model->password = 'updated password';

        self::assertNotSame('updated password', $model->password);
        self::assertTrue(Hash::check('updated password', $model->password));
        self::assertFalse(Hash::check('secret', $model->password));
    }

    /** @test */
    public function it_ignores_null_values(): void
    {
        $model = new Model;
        $model->password = null;

        self::assertNull($model->password);
    }

    /** @test */
    public function does_not_rehash_the_password(): void
    {
        $password = Hash::make('secret');
        $model = new Model(compact('password'));

        self::assertTrue(Hash::check('secret', $password));
        self::assertTrue(Hash::check('secret', $model->password));
    }
}
