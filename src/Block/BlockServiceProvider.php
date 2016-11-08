<?php

namespace Alpaca\Block;

use Alpaca\Block\Builder\Desktop;
use Alpaca\Block\Builder\Mobile;
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
//        $loader->alias('Block', \Alpaca\Block\Builder\BlockFacade::class);
        $loader->alias('BlockDesktop', \Alpaca\Block\Facades\BlockDesktopFacade::class);
        $loader->alias('BlockMobile', \Alpaca\Block\Facades\BlockMobileFacade::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/Views', 'block');
        $this->loadTranslationsFrom(__DIR__.'/Lang', 'block');
        $this->publishes([
            __DIR__.'/Migrations/' => base_path('/database/migrations'),
        ], 'migrations');
        $this->app->instance('block_desktop', new Desktop());
        $this->app->instance('block_mobile', new Mobile());

        $this->app['router']->group([
            'middleware' => 'web',
            'namespace' => 'Alpaca\Block\Controllers',
        ], function ($router) {
            require __DIR__.'/routes.php';
        });
    }
}
