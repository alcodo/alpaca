<?php namespace Alcodo\Page;

use Illuminate\Support\ServiceProvider as Provider;

class PageServiceProvider extends Provider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->register(\Alcodo\Crud\ServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        // seo
        $this->app->register(\Artesaos\SEOTools\Providers\SEOToolsServiceProvider::class);
        $loader->alias('SEO', \Artesaos\SEOTools\Facades\SEOTools::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'page');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'page');
        $this->publishes([
            __DIR__ . '/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
        
        $this->publishes([
            __DIR__ . '/Seeds/' => base_path('/database/seeds'),
        ], 'seeds');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }
    }
}