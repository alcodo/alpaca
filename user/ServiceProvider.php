<?php

namespace Alcodo\User;

use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        // entrust
        $this->app->register(\Zizaco\Entrust\EntrustServiceProvider::class);
        $loader->alias('Entrust', \Zizaco\Entrust\EntrustFacade::class);

        // seo
        $this->app->register(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
        $loader->alias('SEO', \Artesaos\SEOTools\Facades\SEOTools::class);
    }
    
    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $router->middleware('role', \Zizaco\Entrust\Middleware\EntrustRole::class);
        $router->middleware('permission', \Zizaco\Entrust\Middleware\EntrustPermission::class);
        $router->middleware('ability', \Zizaco\Entrust\Middleware\EntrustAbility::class);

        $this->loadViewsFrom(__DIR__ . '/Views', 'user');
        $this->loadTranslationsFrom(__DIR__ . '/Langs', 'user');
        $this->publishes([
            __DIR__ . '/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/Configs/' => base_path('/config'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/Seeds/' => base_path('/database/seeds'),
        ], 'seeds');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }
    }

}
