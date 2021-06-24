<?php

namespace Victorybiz\SimpleLivewireSelect;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Victorybiz\SimpleLivewireSelect\SimpleLivewireSelect;


class SimpleLivewireSelectServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simple-livewire-select');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'simple-livewire-select');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('simple-livewire-select.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/simple-livewire-select'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/simple-livewire-select'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/simple-livewire-select'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        Blade::component("{config('simple-livewire-select.component-name', 'simple-select')}", SimpleLivewireSelect::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'simple-livewire-select');

        // Register the main class to use with the facade
        $this->app->singleton('simple-livewire-select', function () {
            return new SimpleLivewireSelect;
        });
    }
}
