<?php

namespace Alpaca\Menu;

use Illuminate\Support\ServiceProvider as Provider;

class MenuServiceProvider extends Provider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'menu');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'menu');
        $this->publishes([
            __DIR__.'/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
//        $this->publishes([
//            __DIR__.'/Seeds/' => base_path('/database/seeds'),
//        ], 'seeds');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }
}
