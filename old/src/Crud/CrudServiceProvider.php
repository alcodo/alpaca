<?php

namespace Alpaca\Crud;

use Illuminate\Support\ServiceProvider as Provider;

class CrudServiceProvider extends Provider
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
        $this->loadViewsFrom(__DIR__.'/Views', 'crud');
        $this->loadTranslationsFrom(__DIR__.'/Langs', 'crud');
    }
}
