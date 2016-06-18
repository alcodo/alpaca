<?php

namespace Alpaca\Block;

use Alpaca\Block\Builder\BlockBuilder;
use Illuminate\Support\ServiceProvider as Provider;

class BlockServiceProvider extends Provider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        // facade
        $loader->alias('Block', \Alpaca\Block\Builder\BlockFacade::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'block');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'block');
        $this->publishes([
            __DIR__.'/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
//        $this->publishes([
//            __DIR__.'/Seeds/' => base_path('/database/seeds'),
//        ], 'seeds');

        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }

        $this->app->instance('block', new BlockBuilder());
    }
}
