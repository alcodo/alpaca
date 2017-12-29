<?php

namespace Alpaca\Core;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Alpaca\Core\Listeners\UserBlockListener;
use Alpaca\Core\Listeners\AdminBlockListener;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'loadEventBlocks' => [
//            UserBlockListener::class,
            AdminBlockListener::class,
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

    public function boot()
    {
        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        $this->loadViewsFrom(__DIR__.'/Views', 'core');
    }
}
