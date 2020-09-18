<?php

namespace Rawilk\LaravelCasters\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rawilk\LaravelCasters\LaravelCasters
 */
class LaravelCastersFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-casters';
    }
}
