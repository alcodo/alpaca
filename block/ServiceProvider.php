<?php namespace Alcodo\Block;

use Alcodo\Block\Builder\BlockBuilder;
use Illuminate\Support\ServiceProvider as Provider;

class ServiceProvider extends Provider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->register('Alcodo\Helper\ServiceProvider');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'block');
        $this->loadTranslationsFrom(__DIR__ . '/Lang', 'block');
        $this->publishes([
            __DIR__ . '/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/Seeds/' => base_path('/database/seeds'),
        ], 'seeds');

        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/routes.php';
        }

        $this->app->instance('block', new BlockBuilder());
    }
}