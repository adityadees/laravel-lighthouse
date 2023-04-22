<?php

declare(strict_types=1);

namespace AdityaDees\LaravelLighthouse;

use Illuminate\Support\ServiceProvider;

class LaravelLighthouseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-lighthouse.php' => config_path('laravel-lighthouse.php'),
        ], 'config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-lighthouse.php', 'laravel-lighthouse');
    }
}
