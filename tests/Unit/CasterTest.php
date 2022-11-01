<?php

declare(strict_types=1);

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Rawilk\LaravelCasters\Support\Caster;

it('casts to string', function () {
    $caster = new Caster('string');

    expect($caster->coerce(12))->toBeString()
        ->and($caster->coerce(55.1))->toBe('55.1');
});

it('casts to decimal', function () {
    $caster = new Caster('decimal:2');

    expect($caster->coerce(12))->toBeString()
        ->and($caster->coerce(98))->toBe('98.00')
        ->and($caster->coerce(24))->toBe('24.00')
        ->and($caster->coerce(78.9898))->toBe('78.99');
});

it('casts to datetime', function () {
    $caster = new Caster('datetime');
    $casted = $caster->coerce('1592-03-14');

    expect($casted)->toBeObject()
        ->and($casted)->toBeInstanceOf(Carbon::class)
        ->and($casted->format('Y-m-d'))->toBe('1592-03-14');

    $now = now();
    $nonCasted = $caster->coerce($now);

    expect($nonCasted)->toBe($now);
});

it('casts to object', function () {
    $caster = new Caster('object');
    $list = (object) ['secret' => 'classified'];

    $castedJson = $caster->coerce(json_encode($list));

    expect($castedJson)->toBeObject()
        ->and($castedJson)->toBeInstanceOf('stdClass')
        ->and($castedJson)->toEqual($list);

    $castedObject = $caster->coerce($list);

    expect($castedObject)->toBe($list);
});

it('casts to array', function () {
    $caster = new Caster('array');
    $list = ['secret', 'classified'];

    $castedJson = $caster->coerce(json_encode($list));

    expect($castedJson)->toBeArray()
        ->and($castedJson)->toEqual($list);

    $castedArray = $caster->coerce($list);

    expect($castedArray)->toBe($list);
});

it('casts to collection', function () {
    $caster = new Caster('collection');
    $list = ['secret', 'classified'];
    $collection = collect(['secret', 'classified']);

    $castedJson = $caster->coerce(json_encode($list));

    expect($castedJson)->toBeInstanceOf(Collection::class)
        ->and($castedJson)->toEqual($collection);

    $castedArray = $caster->coerce($list);

    expect($castedArray)->toBeInstanceOf(Collection::class)
        ->and($castedArray->toArray())->toBe($list);

    $castedCollection = $caster->coerce($collection);

    expect($castedCollection)->toBe($collection);
});
