<?php

declare(strict_types=1);

use Rawilk\LaravelCasters\Support\Str;

it('returns the first letter of a string', function () {
    expect(Str::firstLetter('John Smith'))->toBe('J');
});
