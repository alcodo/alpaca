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

        $this->loadViewsFrom(__DIR__ . '/Views', 'user');
        $this->loadTranslationsFrom(__DIR__ . '/Langs', 'user');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/config/entrust.php' => config_path('entrust.php'),
        ]);
        $this->publishes([
            __DIR__ . '/database/seeds/UserTableSeeder.php' => base_path('/database/seeds/UserTableSeeder.php'),
        ]);

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\User\Controllers',
        ], function ($router) {
            require __DIR__ . '/routes.php';
        });
    }
}
