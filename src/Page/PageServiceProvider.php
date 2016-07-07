<?php

namespace Alpaca\Page;

use Alpaca\Page\Listeners\SitemapListener;
use Alpaca\Page\Models\Page;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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

    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

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

        $this->app['router']->group(['namespace' => 'Alpaca\Page\Controllers'], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
