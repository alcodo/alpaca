<?php

namespace Alpaca\Email;

use Illuminate\Support\ServiceProvider as Provider;

class EmailServiceProvider extends Provider
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
        $this->loadViewsFrom(__DIR__.'/Views', 'email');
        
        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\Email\Controllers',
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}