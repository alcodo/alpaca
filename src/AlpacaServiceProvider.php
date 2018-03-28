<?php

namespace Alpaca;

use Alpaca\Commands\HtmlMinCommand;
use Alpaca\Support\Permission\Guard;
use Alpaca\Listeners\HtmlMinListener;
use Alpaca\Listeners\User\VerifyUser;
use Alpaca\Support\Block\BlockFacade;
use Illuminate\Support\Facades\Event;
use Alpaca\Events\Page\PageWasCreated;
use Alpaca\Events\Page\PageWasDeleted;
use Alpaca\Events\Page\PageWasUpdated;
use Alpaca\Events\Role\RoleWasCreated;
use Alpaca\Events\Role\RoleWasDeleted;
use Alpaca\Events\Role\RoleWasUpdated;
use Alpaca\Events\User\UserIsVerified;
use Alpaca\Support\Block\BlockBuilder;
use Illuminate\Auth\Events\Registered;
use Alpaca\Events\Block\BlockWasCreated;
use Alpaca\Events\Block\BlockWasDeleted;
use Alpaca\Events\Block\BlockWasUpdated;
use Alpaca\Events\Image\ImageWasCreated;
use Alpaca\Events\Image\ImageWasUpdated;
use Alpaca\Events\Block\BlockIsRequested;
use Alpaca\Listeners\AlpacaBlockListener;
use Alpaca\Listeners\User\IsUserVerified;
use Alpaca\Support\Captcha\CaptchaFacade;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\PasswordReset;
use Alpaca\Listeners\User\AssignGuestRole;
use Alpaca\Support\Captcha\CaptchaBuilder;
use Alpaca\Events\Sitemap\SitemapIsRequested;
use Alpaca\Listeners\User\AssignRegisterRole;
use Alpaca\Commands\PublishTranslationCommand;
use Alpaca\Events\Category\CategoryWasCreated;
use Alpaca\Events\Category\CategoryWasDeleted;
use Alpaca\Events\Category\CategoryWasUpdated;
use Alpaca\Listeners\Page\PageSitemapListener;
use Illuminate\Console\Events\CommandFinished;
use Alpaca\Events\Permission\PermissionWasSaved;
use Illuminate\Support\AggregateServiceProvider;
use Alpaca\Listeners\Image\OptimizeImageListener;
use Alpaca\Listeners\Menu\MenuPermissionListener;
use Alpaca\Listeners\Page\PagePermissionListener;
use Alpaca\Listeners\Role\RolePermissionListener;
use Alpaca\Listeners\User\UserPermissionListener;
use Alpaca\Events\Permission\PermissionWasCreated;
use Alpaca\Events\Permission\PermissionWasDeleted;
use Alpaca\Events\Permission\PermissionWasUpdated;
use Alpaca\Listeners\Block\BlockPermissionListener;
use Alpaca\Listeners\Image\ImagePermissionListener;
use Alpaca\Listeners\Page\RefreshPageCacheListener;
use Alpaca\Listeners\User\StartVerificationProcess;
use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Listeners\Block\RefreshBlockCacheListener;
use Alpaca\Listeners\Category\CategorySitemapListener;
use Alpaca\Listeners\Contact\ContactPermissionListener;
use Alpaca\Listeners\Category\CategoryPermissionListener;
use Alpaca\Listeners\Category\RefreshCategoryCacheListener;
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
        PasswordReset::class => [
            VerifyUser::class,
        ],
        Registered::class => [
            AssignGuestRole::class,
            StartVerificationProcess::class,
        ],
        UserIsVerified::class => [
            AssignRegisterRole::class,
        ],
        CommandFinished::class => [
            HtmlMinListener::class,
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
            RefreshCategoryCacheListener::class,
        ],
        PageWasUpdated::class => [
            RefreshPageCacheListener::class,
            RefreshCategoryCacheListener::class,
        ],
        PageWasDeleted::class => [
            RefreshPageCacheListener::class,
            RefreshCategoryCacheListener::class,
        ],
        BlockWasCreated::class => [
            RefreshBlockCacheListener::class,
        ],
        BlockWasUpdated::class => [
            RefreshBlockCacheListener::class,
        ],
        BlockWasDeleted::class => [
            RefreshBlockCacheListener::class,
        ],
        ImageWasCreated::class => [
            OptimizeImageListener::class,
        ],
        ImageWasUpdated::class => [
            OptimizeImageListener::class,
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
        $loader->alias('Captcha', CaptchaFacade::class);

        // commands
        $this->commands([
            PublishTranslationCommand::class,
            HtmlMinCommand::class,
        ]);
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

        // validation
        $this->app['validator']->extend('captcha', function ($attribute, $value) {
            return $this->app['captcha']->verify();
        });

        // facade
        $this->app->instance('block', new BlockBuilder());
        $this->app->singleton('captcha', function ($app) {
            return new CaptchaBuilder(
                config('alpaca.recaptcha.public'),
                config('alpaca.recaptcha.secret')
            );
        });

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
