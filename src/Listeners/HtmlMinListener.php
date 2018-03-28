<?php

namespace Alpaca\Listeners;

use Illuminate\Console\Events\CommandFinished;

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
        dump($this->command);
        dump($this->exitCode);
    }
}
