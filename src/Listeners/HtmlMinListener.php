<?php

namespace Alpaca\Listeners;

use Illuminate\Console\Events\ArtisanStarting;

class HtmlMinListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param ArtisanStarting $event
     * @return void
     */
    public function handle($event)
    {
        /** @var \Illuminate\Console\Application $app */
        $app = $event->artisan;

        dd($app->all());
    }
}
