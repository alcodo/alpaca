<?php

namespace Alpaca;

use Approached\LaravelDateInternational\ServiceProvider as LaravelDateInternationalServiceProvider;
use Laracasts\Flash\FlashServiceProvider;
use Msurguy\Honeypot\HoneypotServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider;

class DependencyServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        FlashServiceProvider::class,
        SEOToolsServiceProvider::class,
        SlugifyServiceProvider::class,
        HoneypotServiceProvider::class,
        LaravelDateInternationalServiceProvider::class,
    ];

    protected $aliases = [
        'Flash' => \Laracasts\Flash\Flash::class,
        'SEO' => \Artesaos\SEOTools\Facades\SEOTools::class,
        'Slugify' => \Cocur\Slugify\Bridge\Laravel\SlugifyFacade::class,
        'Honeypot' => \Msurguy\Honeypot\HoneypotFacade::class,
    ];

    protected $middlewares = [
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        // register aliases
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        foreach ($this->aliases as $name => $class) {
            $loader->alias($name, $class);
        }
    }

    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        foreach ($this->middlewares as $name => $class) {
            $router->aliasMiddleware($name, $class);
        }
    }
}
