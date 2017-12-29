<?php

namespace Alpaca;

use Alpaca\Core\CoreServiceProvider;
use Alpaca\Crud\CrudServiceProvider;
use Alpaca\Menu\MenuServiceProvider;
use Alpaca\Page\PageServiceProvider;
use Alpaca\User\UserServiceProvider;
use Alpaca\Block\BlockServiceProvider;
use Alpaca\Email\EmailServiceProvider;
use Alpaca\Contact\ContactServiceProvider;
use Alpaca\Gallery\GalleryServiceProvider;
use Alpaca\Sitemap\SitemapServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Alpaca\CookieConsent\CookieConsentServiceProvider;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    protected $listen = [];
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

    protected $middlewares = [
        'TrimStrings' => \Alpaca\Middlewares\TrimStrings::class,
    ];

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
    }

    /**
     * @param \Illuminate\Routing\Router $router
     */
    public function registerMiddleware(\Illuminate\Routing\Router $router): void
    {
        foreach ($this->middlewares as $name => $class) {
            $router->middleware($name, $class);
        }
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
