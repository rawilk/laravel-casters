<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Unit;

use Rawilk\LaravelCasters\Support\Name;
use Rawilk\LaravelCasters\Tests\TestCase;

final class NameTest extends TestCase
{
    private Name $firstOnly;

    private Name $firstAndLast;

    protected function setUp(): void
    {
        parent::setUp();

        $this->firstOnly = new Name('Randall');
        $this->firstAndLast = new Name('Randall', 'Wilk');
    }

    /** @test */
    public function it_can_be_created_with_a_full_name(): void
    {
        $name = Name::from('Randall James Wilk');

        self::assertSame('Randall', $name->first);
        self::assertSame('James Wilk', $name->last);
    }

    /** @test */
    public function it_can_be_created_with_a_first_name(): void
    {
        $name = Name::from('Randall');

        self::assertSame('Randall', $name->first);
        self::assertNull($name->last);
    }

    /** @test */
    public function it_trims_additional_spacing_when_creating_full_name(): void
    {
        $name = Name::from('    Randall   James    Wilk');

        self::assertSame('Randall', $name->first);
        self::assertSame('James Wilk', $name->last);
    }

    /** @test */
    public function it_gets_first_and_last(): void
    {
        self::assertSame('Randall', $this->firstAndLast->first);
        self::assertSame('Wilk', $this->firstAndLast->last);

        self::assertSame('Randall', $this->firstOnly->first);
        self::assertNull($this->firstOnly->last);
    }

    /** @test */
    public function it_gets_the_full_name(): void
    {
        self::assertSame('Randall Wilk', $this->firstAndLast->full);
        self::assertSame('Randall Wilk', (string) $this->firstAndLast);

        self::assertSame('Randall', $this->firstOnly->full);
        self::assertSame('Randall', (string) $this->firstOnly);
    }

    /** @test */
    public function it_gets_the_familiar_name(): void
    {
        self::assertSame('Randall W.', $this->firstAndLast->familiar);

        self::assertSame('Randall', $this->firstOnly->familiar);
    }

    /** @test */
    public function it_gets_the_abbreviated_name(): void
    {
        self::assertSame('R. Wilk', $this->firstAndLast->abbreviated);

        self::assertSame('Randall', $this->firstOnly->abbreviated);
    }

    /** @test */
    public function it_sorts_the_name(): void
    {
        self::assertSame('Wilk, Randall', $this->firstAndLast->sorted);

        self::assertSame('Randall', $this->firstOnly->sorted);
    }

    /** @test */
    public function it_gets_the_full_name_possessive_version(): void
    {
        self::assertSame("Randall Wilk's", $this->firstAndLast->full_possessive);
        self::assertSame("Randall's", $this->firstOnly->full_possessive);
        self::assertSame("Foo Bars'", (new Name('Foo', 'Bars'))->full_possessive);
    }

    /** @test */
    public function it_gets_the_first_name_possessive_version(): void
    {
        self::assertSame("Randall's", $this->firstAndLast->first_possessive);
    }

    /** @test */
    public function it_gets_the_last_name_possessive_version(): void
    {
        self::assertSame("Wilk's", $this->firstAndLast->last_possessive);
    }

    /** @test */
    public function it_gets_the_sorted_name_possessive_version(): void
    {
        self::assertSame("Wilk, Randall's", $this->firstAndLast->sorted_possessive);
    }

    /** @test */
    public function it_gets_the_abbreviated_name_possessive_version(): void
    {
        self::assertSame("R. Wilk's", $this->firstAndLast->abbreviated_possessive);
    }

    /** @test */
    public function it_gets_initials(): void
    {
        $name = Name::from('Randall James Wilk');

        self::assertSame('RJW', $name->initials);
    }

    /** @test */
    public function it_gets_the_initials_possessive_version(): void
    {
        self::assertSame("RW's", $this->firstAndLast->initials_possessive);
    }

    /** @test */
    public function it_gets_initials_with_spaces(): void
    {
        $name = Name::from('    Randall    James  Wilk');

        self::assertSame('RJW', $name->initials);
    }

    /** @test */
    public function it_gets_initials_with_first_name_only(): void
    {
        $name = Name::from('Randall');

        self::assertSame('R', $name->initials);
    }

    /** @test */
    public function it_gets_initials_without_parenthesis(): void
    {
        $name = Name::from('Randall James Wilk (Developer)');

        self::assertSame('RJW', $name->initials);
    }

    /** @test */
    public function it_gets_initials_without_special_characters(): void
    {
        $name = Name::from('Randall James Wilk !');

        self::assertSame('RJW', $name->initials);
    }
}
