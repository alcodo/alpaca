<?php

namespace Alpaca\CookieConsent;

use Illuminate\Support\ServiceProvider as Provider;

class CookieConsentServiceProvider extends Provider
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
        $this->publishes(
            [__DIR__.'/Configs/' => base_path('/config')],
            'configs'
        );
    }
}
