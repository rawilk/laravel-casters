<?php

declare(strict_types=1);

use Rawilk\LaravelCasters\Support\Name;

beforeEach(function () {
    $this->firstOnly = new Name('John');
    $this->firstAndLast = new Name('John', 'Smith');
});

it('can be created with a full name', function () {
    $name = Name::from('John Adam Smith');

    expect($name->first)->toBe('John')
        ->and($name->last)->toBe('Adam Smith');
});

it('can be created with just a first name', function () {
    $name = Name::from('John');

    expect($name->first)->toBe('John')
        ->and($name->last)->toBeNull();
});

it('trims additional spacing when creating from a full name', function () {
    $name = Name::from('     John   Adam           Smith');

    expect($name->first)->toBe('John')
        ->and($name->last)->toBe('Adam Smith');
});

it('gets the first and last name')
    ->expect(fn () => $this->firstAndLast)
    ->first->toBe('John')
    ->last->toBe('Smith')
    ->and(fn () => $this->firstOnly)
    ->first->toBe('John')
    ->last->toBeNull();

it('gets the full name')
    ->expect(fn () => $this->firstAndLast)
    ->full->toBe('John Smith')
    ->and(fn () => (string) $this->firstAndLast)->toBe('John Smith')
    ->and(fn () => $this->firstOnly)
    ->full->toBe('John')
    ->and(fn () => (string) $this->firstOnly)->toBe('John');

it('gets the familiar name')
    ->expect(fn () => $this->firstAndLast)->familiar->toBe('John S.')
    ->and(fn () => $this->firstOnly)->familiar->toBe('John');

it('gets the abbreviated name')
    ->expect(fn () => $this->firstAndLast)->abbreviated->toBe('J. Smith')
    ->and(fn () => $this->firstOnly)->abbreviated->toBe('John');

it('sorts the name')
    ->expect(fn () => $this->firstAndLast)->sorted->toBe('Smith, John')
    ->and(fn () => $this->firstOnly)->sorted->toBe('John');

it('gets the full name possessive version')
    ->expect(fn () => $this->firstAndLast)->full_possessive->toBe('John Smith\'s')
    ->and(fn () => $this->firstOnly)->full_possessive->toBe('John\'s')
    ->and(new Name('Foo', 'Bars'))->full_possessive->toBe('Foo Bars\'');

it('gets the first name possessive version')
    ->expect(fn () => $this->firstAndLast)->first_possessive->toBe('John\'s');

it('gets the last name possessive version')
    ->expect(fn () => $this->firstAndLast)->last_possessive->toBe('Smith\'s');

it('gets the sorted name possessive version')
    ->expect(fn () => $this->firstAndLast)->sorted_possessive->toBe('Smith, John\'s');

it('gets the abbreviated name possessive version')
    ->expect(fn () => $this->firstAndLast)->abbreviated_possessive->toBe('J. Smith\'s');

it('gets initials')
    ->expect(Name::from('John Adam Smith'))->initials->toBe('JAS');

it('gets initials possessive version')
    ->expect(fn () => $this->firstAndLast)->initials_possessive->toBe('JS\'s');

it('gets initials with spaces')
    ->expect(Name::from('     John    Adam  Smith'))->initials->toBe('JAS');

it('gets initials with first name only')
    ->expect(Name::from('John'))->initials->toBe('J');

it('gets initials without parenthesis')
    ->expect(Name::from('John Adam Smith (Developer)'))->initials->toBe('JAS');

it('gets initials without special characters')
    ->expect(Name::from('John Adam Smith!'))->initials->toBe('JAS');
