<?php

namespace Alpaca;

use Alpaca\Core\CoreServiceProvider;
use Alpaca\Crud\CrudServiceProvider;
use Alpaca\Events\Block\BlockIsRequested;
use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Events\Sitemap\SitemapIsRequested;
use Alpaca\Listeners\AlpacaBlockListener;
use Alpaca\Listeners\Block\BlockPermissionListener;
use Alpaca\Listeners\Category\CategoryPermissionListener;
use Alpaca\Listeners\Category\CategorySitemapListener;
use Alpaca\Listeners\Contact\ContactPermissionListener;
use Alpaca\Listeners\EmailTemplate\EmailTemplatePermissionListener;
use Alpaca\Listeners\Image\ImagePermissionListener;
use Alpaca\Listeners\Menu\MenuPermissionListener;
use Alpaca\Listeners\Page\PagePermissionListener;
use Alpaca\Listeners\Page\PageSitemapListener;
use Alpaca\Listeners\Permission\PermissionPermissionListener;
use Alpaca\Listeners\Role\RolePermissionListener;
use Alpaca\Listeners\User\AccountVerification;
use Alpaca\Listeners\User\UserPermissionListener;
use Alpaca\Menu\MenuServiceProvider;
use Alpaca\Page\PageServiceProvider;
use Alpaca\Support\Block\BlockBuilder;
use Alpaca\Support\Block\BlockFacade;
use Alpaca\Block\BlockServiceProvider;
use Alpaca\Email\EmailServiceProvider;
use Alpaca\Contact\ContactServiceProvider;
use Alpaca\Gallery\GalleryServiceProvider;
use Alpaca\Sitemap\SitemapServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\AggregateServiceProvider;
use Alpaca\CookieConsent\CookieConsentServiceProvider;
use Illuminate\Support\Facades\Event;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        PermissionsIsRequested::class => [
            BlockPermissionListener::class,
            CategoryPermissionListener::class,
            ContactPermissionListener::class,
            EmailTemplatePermissionListener::class,
            ImagePermissionListener::class,
            MenuPermissionListener::class,
            PermissionPermissionListener::class,
            RolePermissionListener::class,
            UserPermissionListener::class,
            PagePermissionListener::class,
        ],
        Registered::class => [
            AccountVerification::class,
        ],
        SitemapIsRequested::class => [
            PageSitemapListener::class,
            CategorySitemapListener::class,
        ],
        BlockIsRequested::class => [
            AlpacaBlockListener::class,
//            UserBlockListener::class,
        ],
    ];

    /**
     * @var array
     */
    protected $middlewares = [
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    ];

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
        $this->loadRoutesFrom(__DIR__ . '/routes_backend.php');
        $this->loadRoutesFrom(__DIR__ . '/routes_fronted.php');


        $this->app->instance('block', new BlockBuilder());
    }

    /**
     * Add middlewares
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function registerMiddleware(\Illuminate\Routing\Router $router): void
    {
        $router->middlewareGroup('alpaca', [
            \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
            \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        ]);

        foreach ($this->middlewares as $name => $class) {
            $router->aliasMiddleware($name, $class);
        }
    }

    /**
     * Add events
     */
    public function registerEvents(): void
    {
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }
    }
}
