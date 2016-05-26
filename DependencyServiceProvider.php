<?php

namespace Alcodo;

use Illuminate\Support\ServiceProvider as Provider;

class DependencyServiceProvider extends Provider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        // flash
        $this->app->register(\Laracasts\Flash\FlashServiceProvider::class);
        $loader->alias('Flash', \Laracasts\Flash\Flash::class);

        // entrust
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $loader->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);

        // seo
        $this->app->register(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
        $loader->alias('SEO', \Artesaos\SEOTools\Facades\SEOTools::class);

        // slugify
        $this->app->register(\Cocur\Slugify\Bridge\Laravel\SlugifyServiceProvider::class);
        $loader->alias('Slugify', \Cocur\Slugify\Bridge\Laravel\SlugifyFacade::class);

        // datebuilder
        $this->app->register(\Approached\LaravelDateInternational\ServiceProvider::class);
        $loader->alias('Dateintl', \Approached\LaravelDateInternational\DateIntlFacade::class);

        // formbuilder
        $this->app->register(\AdamWathan\BootForms\BootFormsServiceProvider::class);
        $loader->alias('BootForm', \AdamWathan\BootForms\Facades\BootForm::class);
    }

    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        // user entrust
        $router->middleware('role', \Zizaco\Entrust\Middleware\EntrustRole::class);
        $router->middleware('permission', \Zizaco\Entrust\Middleware\EntrustPermission::class);
        $router->middleware('ability', \Zizaco\Entrust\Middleware\EntrustAbility::class);
    }

}
