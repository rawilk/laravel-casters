<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Hash;
use Rawilk\LaravelCasters\Tests\Models\Model;

it('hashes passwords', function () {
    $model = new Model(['password' => 'secret']);

    $passwordFromAttributes = $model->getAttributes()['password'];

    expect($passwordFromAttributes)->toBeString()
        ->and($passwordFromAttributes)->not()->toBe('secret')
        ->and(Hash::check('secret', $passwordFromAttributes))->toBeTrue()
        ->and($model->password)->toBeString()
        ->and($model->password)->not()->toBe('secret')
        ->and(Hash::check('secret', $model->password))->toBeTrue();

    $model->password = 'updated password';

    expect($model->password)->not()->toBe('updated password')
        ->and(Hash::check('updated password', $model->password))->toBeTrue()
        ->and(Hash::check('secret', $model->password))->toBeFalse();
});

it('ignores null values', function () {
    $model = new Model;
    $model->password = null;

    expect($model->password)->toBeNull();
});

it('does not rehash the password', function () {
    $password = Hash::make('secret');
    $model = new Model(compact('password'));

    expect(Hash::check('secret', $password))->toBeTrue()
        ->and(Hash::check('secret', $model->password))->toBeTrue();
});
