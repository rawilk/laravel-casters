<?php

namespace Rawilk\LaravelCasters;

use Illuminate\Support\ServiceProvider;
use Rawilk\LaravelCasters\Commands\LaravelCastersCommand;

class LaravelCastersServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-casters.php' => config_path('laravel-casters.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravel-casters'),
            ], 'views');

            if (! class_exists('CreatePackageTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_laravel_casters_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_laravel_casters_table.php'),
                ], 'migrations');
            }

            $this->commands([
                LaravelCastersCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-casters');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-casters.php', 'laravel-casters');
    }
}
