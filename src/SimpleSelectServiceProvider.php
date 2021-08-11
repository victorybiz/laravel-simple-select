<?php

namespace Victorybiz\SimpleSelect;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Victorybiz\SimpleSelect\SimpleSelect;


class SimpleSelectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simple-select');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'simple-select');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('simple-select.php'),
            ], 'simple-select:config');
            
            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/simple-select'),
            ], 'simple-select:views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/simple-select'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/simple-select'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
        
        // Registering the blade components.
        Blade::component(config('simple-select.component-name', 'simple-select'), SimpleSelect::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'simple-select');

        // Register the main class to use with the facade
        $this->app->singleton('simple-select', function () {
            return new SimpleSelect;
        });
    }
}
