<?php

declare(strict_types=1);

namespace Rawilk\LaravelCasters\Tests\Unit;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Rawilk\LaravelCasters\Support\Caster;
use Rawilk\LaravelCasters\Tests\TestCase;

class CasterTest extends TestCase
{
    /** @test */
    public function casts_to_string(): void
    {
        $caster = new Caster('string');

        self::assertIsString($caster->coerce(12));
        self::assertSame('55.1', $caster->coerce(55.1));
    }

    /** @test */
    public function casts_to_decimal(): void
    {
        $caster = new Caster('decimal:2');

        self::assertIsString($caster->coerce(12));
        self::assertSame('98.00', $caster->coerce(98));
        self::assertSame('24.00', $caster->coerce(24));
        self::assertSame('78.99', $caster->coerce(78.9898));
    }

    /** @test */
    public function casts_to_datetime(): void
    {
        $caster = new Caster('datetime');
        $casted = $caster->coerce('1592-03-14');

        self::assertIsObject($casted);
        self::assertInstanceOf(Carbon::class, $casted);
        self::assertEquals('1592-03-14', $casted->format('Y-m-d'));

        $now = now();
        $nonCasted = $caster->coerce($now);

        self::assertSame($now, $nonCasted);
    }

    /** @test */
    public function casts_to_object(): void
    {
        $caster = new Caster('object');
        $list = (object) ['secret' => 'classified'];

        $castedJson = $caster->coerce(json_encode($list));

        self::assertIsObject($castedJson);
        self::assertInstanceOf('stdClass', $castedJson);
        self::assertEquals($list, $castedJson);

        $castedObject = $caster->coerce($list);

        self::assertSame($list, $castedObject);
    }

    /** @test */
    public function casts_to_array(): void
    {
        $caster = new Caster('array');
        $list = ['secret', 'classified'];

        $castedJson = $caster->coerce(json_encode($list));

        self::assertIsArray($castedJson);
        self::assertEquals($list, $castedJson);

        $castedArray = $caster->coerce($list);

        self::assertSame($list, $castedArray);
    }

    /** @test */
    public function casts_to_collection(): void
    {
        $caster = new Caster('collection');
        $list = ['secret', 'classified'];
        $collection = collect(['secret', 'classified']);

        $castedJson = $caster->coerce(json_encode($list));

        self::assertInstanceOf(Collection::class, $castedJson);
        self::assertEquals($collection, $castedJson);

        $castedArray = $caster->coerce($list);

        self::assertInstanceOf(Collection::class, $castedArray);
        self::assertSame($list, $castedArray->toArray());

        $castedCollection = $caster->coerce($collection);

        self::assertSame($collection, $castedCollection);
    }
}
