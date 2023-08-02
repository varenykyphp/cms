<?php

namespace Varenyky\Support;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }   

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../../routes/cms.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'varenyky');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'varenyky');

        $this->publishes([
            __DIR__.'/../../config/varenyky.php' => config_path('varenyky.php'),
        ]);
    }
}