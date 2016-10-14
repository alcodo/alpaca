<?php

namespace Alpaca\User;

use Illuminate\Support\ServiceProvider as Provider;

class UserServiceProvider extends Provider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'user');
        $this->loadTranslationsFrom(__DIR__.'/Langs', 'user');
        $this->publishes([
            __DIR__.'/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__.'/Configs/' => base_path('/config'),
        ], 'configs');
        $this->publishes([
            __DIR__.'/Seeds/' => base_path('/database/seeds'),
        ], 'seeds');

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\User\Controllers',
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
