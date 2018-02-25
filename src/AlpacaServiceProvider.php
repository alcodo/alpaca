<?php

namespace Alpaca;

use Alpaca\Events\Category\CategoryWasCreated;
use Alpaca\Events\Category\CategoryWasDeleted;
use Alpaca\Events\Category\CategoryWasUpdated;
use Alpaca\Events\Page\PageWasCreated;
use Alpaca\Events\Page\PageWasDeleted;
use Alpaca\Events\Page\PageWasUpdated;
use Alpaca\Listeners\Category\RefreshCategoryCacheListener;
use Alpaca\Listeners\Page\RefreshPageCacheListener;
use Alpaca\Support\Guard;
use Alpaca\Support\Block\BlockFacade;
use Illuminate\Support\Facades\Event;
use Alpaca\Events\Role\RoleWasCreated;
use Alpaca\Events\Role\RoleWasDeleted;
use Alpaca\Events\Role\RoleWasUpdated;
use Alpaca\Events\User\UserIsVerified;
use Alpaca\Support\Block\BlockBuilder;
use Illuminate\Auth\Events\Registered;
use Alpaca\Events\Block\BlockIsRequested;
use Alpaca\Listeners\AlpacaBlockListener;
use Alpaca\Listeners\User\IsUserVerified;
use Illuminate\Auth\Events\Authenticated;
use Alpaca\Listeners\User\AssignGuestRole;
use Alpaca\Events\Sitemap\SitemapIsRequested;
use Alpaca\Listeners\User\AssignRegisterRole;
use Alpaca\Commands\PublishTranslationCommand;
use Alpaca\Listeners\Page\PageSitemapListener;
use Alpaca\Events\Permission\PermissionWasSaved;
use Illuminate\Support\AggregateServiceProvider;
use Alpaca\Listeners\Menu\MenuPermissionListener;
use Alpaca\Listeners\Page\PagePermissionListener;
use Alpaca\Listeners\Role\RolePermissionListener;
use Alpaca\Listeners\User\UserPermissionListener;
use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasUpdated;
use Alpaca\Listeners\Block\BlockPermissionListener;
use Alpaca\Listeners\Image\ImagePermissionListener;
use Alpaca\Listeners\User\StartVerificationProcess;
use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Listeners\Category\CategorySitemapListener;
use Alpaca\Listeners\Contact\ContactPermissionListener;
use Alpaca\Listeners\Category\CategoryPermissionListener;
use Alpaca\Listeners\Permission\PermissionPermissionListener;
use Alpaca\Listeners\Permission\RefreshPermissionCacheListener;
use Alpaca\Listeners\EmailTemplate\EmailTemplatePermissionListener;

class AlpacaServiceProvider extends AggregateServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [
        Authenticated::class => [
            IsUserVerified::class,
        ],
        Registered::class => [
            AssignGuestRole::class,
            StartVerificationProcess::class,
        ],
        UserIsVerified::class => [
            AssignRegisterRole::class,
        ],
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
        CategoryWasCreated::class => [
            RefreshCategoryCacheListener::class,
        ],
        CategoryWasUpdated::class => [
            RefreshCategoryCacheListener::class,
        ],
        CategoryWasDeleted::class => [
            RefreshCategoryCacheListener::class,
        ],
        PageWasCreated::class => [
            RefreshPageCacheListener::class,
        ],
        PageWasUpdated::class => [
            RefreshPageCacheListener::class,
        ],
        PageWasDeleted::class => [
            RefreshPageCacheListener::class,
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
        $this->mergeConfigFrom(__DIR__.'/../config/alpaca.php', 'alpaca');

        // view
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'alpaca');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/alpaca'),
        ]);

        // lang
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'alpaca');

        // migratiom
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // routes
        $this->loadRoutesFrom(__DIR__.'/routes_backend.php');
        $this->loadRoutesFrom(__DIR__.'/routes_testing.php');
        $this->loadRoutesFrom(__DIR__.'/routes_fronted.php');

        // facade
        $this->app->instance('block', new BlockBuilder());

        // gate
        $guard->registerPermissions();
    }

    /**
     * Add middlewares.
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
     * Add events.
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
