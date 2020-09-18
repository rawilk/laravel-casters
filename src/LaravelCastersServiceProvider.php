<?php

namespace Rawilk\LaravelCasters;

use Illuminate\Support\ServiceProvider;

class LaravelCastersServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-casters.php' => config_path('laravel-casters.php'),
            ], 'config');
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-casters.php', 'laravel-casters');
    }
}
