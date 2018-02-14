<?php

namespace Alpaca;

use Alpaca\Commands\PublishTranslationCommand;
use Alpaca\Events\Block\BlockIsRequested;
use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasSaved;
use Alpaca\Events\Permission\PermissionWasUpdated;
use Alpaca\Events\Role\RoleWasCreated;
use Alpaca\Events\Role\RoleWasDeleted;
use Alpaca\Events\Role\RoleWasUpdated;
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
use Alpaca\Listeners\Permission\RefreshPermissionCacheListener;
use Alpaca\Listeners\Role\RolePermissionListener;
use Alpaca\Listeners\User\IsUserVerified;
use Alpaca\Listeners\User\SendVerificationEmail;
use Alpaca\Listeners\User\UserPermissionListener;
use Alpaca\Support\Block\BlockBuilder;
use Alpaca\Support\Block\BlockFacade;
use Alpaca\Support\Guard;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\AggregateServiceProvider;
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
        RoleWasCreated::class => [
            RefreshPermissionCacheListener::class,
        ],
        RoleWasUpdated::class => [
            RefreshPermissionCacheListener::class,
        ],
        RoleWasDeleted::class => [
            RefreshPermissionCacheListener::class,
        ],
        PermissionWasCreated::class => [
            RefreshPermissionCacheListener::class,
        ],
        PermissionWasUpdated::class => [
            RefreshPermissionCacheListener::class,
        ],
        PermissionWasDeleted::class => [
            RefreshPermissionCacheListener::class,
        ],
        PermissionWasSaved::class => [
            RefreshPermissionCacheListener::class,
        ],
        Registered::class => [
            SendVerificationEmail::class
        ],
        Authenticated::class => [
            IsUserVerified::class
        ],
    ];

    /**
     * @var array
     */
    protected $middlewares = [
        'permission' => \Alpaca\Middlewares\PermissionMiddleware::class,
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

        // commands
        $this->commands(PublishTranslationCommand::class);
    }

    public function boot(\Illuminate\Routing\Router $router, Guard $guard)
    {
        $this->app->register(DependencyServiceProvider::class);
        $this->registerMiddleware($router);
        $this->registerEvents();

        // config
        $this->mergeConfigFrom(__DIR__ . '/../config/alpaca.php', 'alpaca');

        // view
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'alpaca');
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/alpaca'),
        ]);

        // lang
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'alpaca');

        // migratiom
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // routes
        $this->loadRoutesFrom(__DIR__ . '/routes_backend.php');
        $this->loadRoutesFrom(__DIR__ . '/routes_fronted.php');

        // facade
        $this->app->instance('block', new BlockBuilder());

        // gate
        $guard->registerPermissions();
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
