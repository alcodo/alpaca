<?php

namespace Alpaca\Contact;

use Illuminate\Support\ServiceProvider as Provider;

class ContactServiceProvider extends Provider
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
        $this->loadViewsFrom(__DIR__.'/Views', 'contact');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'contact');
        $this->publishes([
            __DIR__.'/Config/' => base_path('/config'),
        ], 'config');

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\Contact\Controllers'
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
