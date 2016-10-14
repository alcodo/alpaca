<?php

namespace Alpaca\CookieConsent;

use Illuminate\Support\ServiceProvider as Provider;

class CookieConsentProvider extends Provider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'cookieconsent');
        $this->loadTranslationsFrom(__DIR__.'/Langs', 'cookieconsent');
    }
}
