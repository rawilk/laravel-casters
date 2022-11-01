<?php

declare(strict_types=1);

use Rawilk\LaravelCasters\Support\Name;
use Rawilk\LaravelCasters\Tests\Models\Model;

it('casts to a name', function () {
    $model = new Model(['name' => 'John Smith']);

    expect($model->name)->toBeInstanceOf(Name::class)
        ->and($model->name->first)->toBe('John')
        ->and($model->name->last)->toBe('Smith')
        ->and($model->name->full)->toBe('John Smith')
        ->and((string) $model->name)->toBe('John Smith');
});

it('can be casted from first and last name on a model', function () {
    $model = new Model(['first_name' => 'John', 'last_name' => 'Smith']);

    expect($model->name->full)->toBe('John Smith')
        ->and($model->name->first)->toBe('John')
        ->and($model->name->initials)->toBe('JS');
});

test('different first and last name attributes can be used', function () {
    $model = new Model(['given_name' => 'John', 'family_name' => 'Smith']);

    expect($model->custom_name->full)->toBe('John Smith')
        ->and($model->custom_name->first)->toBe('John')
        ->and($model->custom_name->last)->toBe('Smith');
});
