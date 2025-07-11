<?php

namespace LaravelEnso\Google;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publish();
    }

    public function publish()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/google.php', 'enso.google');
        $this->publishes([
                __DIR__.'/../config' => config_path('enso'),
            ], ['google-config', 'Wenso-config']);
    }

    public function register()
    {
    }
}
