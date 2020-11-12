<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Unit;

use Rawilk\LaravelCasters\Support\Str;
use Rawilk\LaravelCasters\Tests\TestCase;

final class StrTest extends TestCase
{
    /** @test */
    public function it_returns_the_first_letter_of_a_string(): void
    {
        self::assertEquals('R', Str::firstLetter('Randall'));
    }

    /** @test */
    public function it_squishes_additional_space_from_a_string(): void
    {
        self::assertSame('Randall James Wilk', Str::squish('     Randall   James    Wilk '));
    }
}
