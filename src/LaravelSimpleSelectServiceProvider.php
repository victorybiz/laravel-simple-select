<?php

namespace Victorybiz\LaravelSimpleSelect;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Victorybiz\LaravelSimpleSelect\LaravelSimpleSelect;


class LaravelSimpleSelectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-simple-select');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-simple-select');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-simple-select.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-simple-select'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-simple-select'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-simple-select'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        Blade::component(config('laravel-simple-select.component-name', 'simple-select'), LaravelSimpleSelect::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-simple-select');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-simple-select', function () {
            return new LaravelSimpleSelect;
        });
    }
}
