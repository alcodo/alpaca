<?php

namespace Alpaca\User;

use Illuminate\Auth\Events\Registered;
use Alpaca\User\Listener\AccountVerification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class UserServiceProvider extends EventServiceProvider
{
    protected $listen = [
        Registered::class => [
            AccountVerification::class,
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
