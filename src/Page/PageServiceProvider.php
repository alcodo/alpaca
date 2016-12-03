<?php

namespace Alpaca\Page;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Alpaca\Page\Listeners\SitemapListener;

class PageServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'sitemap' => [
            SitemapListener::class,
        ],
    ];

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
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->loadViewsFrom(__DIR__.'/Views', 'page');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'page');

        $this->publishes([
            __DIR__.'/Config/' => base_path('/config'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/Seeds/' => base_path('/database/seeds'),
        ], 'seeds');

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\Page\Controllers',
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
