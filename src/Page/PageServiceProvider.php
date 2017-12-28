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
//    protected $listen = [
//        'sitemap' => [
//            SitemapListener::class,
//        ],
//    ];

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
//        foreach ($this->listen as $event => $listeners) {
//            foreach ($listeners as $listener) {
//                Event::listen($event, $listener);
//            }
//        }

        $this->publishes([__DIR__ . '/Config/page.php' => config_path('page.php'),]);
        $this->loadViewsFrom(__DIR__ . '/Views', 'page');
        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'page');
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
