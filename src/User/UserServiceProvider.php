<?php

namespace Alpaca\User;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider as Provider;

class UserServiceProvider extends EventServiceProvider
{
    protected $listen = [
//        'eloquent.created: Arena\Video\Models\Video' => [
//            DownloadVideo::class,
//            ExternalVideo::class,
//            YouTubeVideo::class,
//        ],
//        'eloquent.updated: Arena\Video\Models\Video' => [
//            DownloadVideo::class,
//            ExternalVideo::class,
//        ],
        Registered::class => [
            DeleteVideo::class,
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
        parent::boot();

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
