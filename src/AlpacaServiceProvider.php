<?php

namespace Alpaca;

use Alpaca\Core\CoreServiceProvider;
use Alpaca\Crud\CrudServiceProvider;
use Alpaca\Events\Sitemap\SitemapIsRequested;
use Alpaca\Listeners\Category\CategorySitemapListener;
use Alpaca\Listeners\Page\PageSitemapListener;
use Alpaca\Menu\MenuServiceProvider;
use Alpaca\Page\PageServiceProvider;
use Alpaca\Support\Block\BlockBuilder;
use Alpaca\Support\Block\BlockFacade;
use Alpaca\User\UserServiceProvider;
use Alpaca\Block\BlockServiceProvider;
use Alpaca\Email\EmailServiceProvider;
use Alpaca\Contact\ContactServiceProvider;
use Alpaca\Gallery\GalleryServiceProvider;
use Alpaca\Sitemap\SitemapServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Alpaca\CookieConsent\CookieConsentServiceProvider;
use Illuminate\Support\Facades\Event;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    protected $listen = [
        SitemapIsRequested::class => [
            PageSitemapListener::class,
            CategorySitemapListener::class,
        ]
    ];
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
//        DependencyServiceProvider::class,
//        CoreServiceProvider::class,
//        CookieConsentServiceProvider::class,
//        CrudServiceProvider::class,
//        UserServiceProvider::class,
//        BlockServiceProvider::class,
//        MenuServiceProvider::class,
//        SitemapServiceProvider::class,
//        ContactServiceProvider::class,
//        GalleryServiceProvider::class,
//        EmailServiceProvider::class,
//        PageServiceProvider::class,
    ];

//    protected $middlewares = [
//        'TrimStrings' => \Alpaca\Middlewares\TrimStrings::class,
//    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        // facade
        $loader->alias('Block', BlockFacade::class);
    }

    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->app->register(DependencyServiceProvider::class);
        $this->registerMiddleware($router);
        $this->registerEvents();

        $this->publishes([__DIR__ . '/../config/alpaca.php' => config_path('alpaca.php'),]);
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'alpaca');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'alpaca');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');


        $this->app->instance('block', new BlockBuilder());
    }

    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function registerMiddleware(\Illuminate\Routing\Router $router): void
    {
        $router->middlewareGroup('alpaca', [
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);
//        foreach ($this->middlewares as $name => $class) {
//            $router->middleware($name, $class);
//        }
    }

    public function registerEvents(): void
    {
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}
