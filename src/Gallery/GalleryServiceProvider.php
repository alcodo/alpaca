<?php

namespace Alpaca\Gallery;

use Illuminate\Support\ServiceProvider as Provider;

class GalleryServiceProvider extends Provider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'gallery');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'gallery');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\Gallery\Controllers',
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
