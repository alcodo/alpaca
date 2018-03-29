<?php

namespace Alpaca\Listeners;

//use Alpaca\Commands\HtmlMinCommand;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\Artisan;

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
     * @param CommandFinished $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->command == 'view:cache' && $event->exitCode === 0) {
            Artisan::call('alpaca:html_minifier');
        }
    }
}
