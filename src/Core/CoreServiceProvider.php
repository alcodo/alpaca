<?php

namespace Alpaca\Core;

use Alpaca\Core\Listeners\AdminBlockListener;
use Alpaca\Core\Listeners\UserBlockListener;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'loadEventBlocks' => [
            AdminBlockListener::class,
            UserBlockListener::class
        ],
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $this->loadViewsFrom(__DIR__.'/Views', 'core');
    }
}
