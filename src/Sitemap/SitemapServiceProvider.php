<?php

namespace Alpaca\Sitemap;

use Illuminate\Support\ServiceProvider as Provider;

class SitemapServiceProvider extends Provider
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
        $this->loadViewsFrom(__DIR__.'/Views', 'sitemap');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'sitemap');

        $this->app['router']->group(['namespace' => 'Alpaca\Sitemap\Controllers'], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
