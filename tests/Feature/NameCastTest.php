<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Feature;

use Rawilk\LaravelCasters\Support\Name;
use Rawilk\LaravelCasters\Tests\Models\Model;
use Rawilk\LaravelCasters\Tests\TestCase;

final class NameCastTest extends TestCase
{
    /** @test */
    public function it_casts_to_a_name(): void
    {
        $model = new Model(['name' => 'Randall Wilk']);

        self::assertInstanceOf(Name::class, $model->name);
        self::assertSame('Randall', $model->name->first);
        self::assertSame('Wilk', $model->name->last);
        self::assertSame('Randall Wilk', $model->name->full);
        self::assertSame('Randall Wilk', (string) $model->name);
    }

    /** @test */
    public function can_be_casted_from_first_and_last_name_on_a_model(): void
    {
        $model = new Model(['first_name' => 'Randall', 'last_name' => 'Wilk']);

        self::assertSame('Randall Wilk', $model->name->full);
        self::assertSame('Randall', $model->name->first);
        self::assertSame('RW', $model->name->initials);
    }

    /** @test */
    public function different_first_and_last_name_attributes_can_be_used(): void
    {
        $model = new Model(['given_name' => 'Randall', 'family_name' => 'Wilk']);

        self::assertSame('Randall Wilk', $model->custom_name->full);
        self::assertSame('Randall', $model->custom_name->first);
        self::assertSame('Wilk', $model->custom_name->last);
    }
}
