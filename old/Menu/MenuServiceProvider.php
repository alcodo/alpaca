<?php

namespace Alpaca\Menu;

use Illuminate\Support\Facades\Route;
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
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\Menu\Controllers',
        ], function ($router) {
            require __DIR__.'/routes.php';
        });

//        $routes = Route::getRoutes();
//        dd($routes);
    }
}