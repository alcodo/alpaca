<?php

namespace Alpaca;

use Laracasts\Flash\FlashServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use Zizaco\Entrust\EntrustServiceProvider;
use Msurguy\Honeypot\HoneypotServiceProvider;
use Alcodo\PowerImage\PowerImageServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Approached\LaravelDateInternational\ServiceProvider;
use Artesaos\SEOTools\Providers\SEOToolsServiceProvider;
use Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider;

class DependencyServiceProvider extends AggregateServiceProvider
{
    protected $providers = [
        FlashServiceProvider::class,
        SEOToolsServiceProvider::class,
        SlugifyServiceProvider::class,
        ServiceProvider::class,
        HoneypotServiceProvider::class,
//        EntrustServiceProvider::class,
        PermissionServiceProvider::class,
//        PowerImageServiceProvider::class,
    ];

    protected $aliases = [
        'Flash'    => \Laracasts\Flash\Flash::class,
        'SEO'      => \Artesaos\SEOTools\Facades\SEOTools::class,
        'Slugify'  => \Cocur\Slugify\Bridge\Laravel\SlugifyFacade::class,
        'Dateintl' => \Approached\LaravelDateInternational\DateIntlFacade::class,
        'Honeypot' => \Msurguy\Honeypot\HoneypotFacade::class,
//        'Entrust'  => \Zizaco\Entrust\EntrustFacade::class,
    ];

    protected $middlewares = [
//        'role'       => \Zizaco\Entrust\Middleware\EntrustRole::class,
//        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
//        'ability'    => \Zizaco\Entrust\Middleware\EntrustAbility::class,
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
            $router->middleware($name, $class);
        }
    }
}
