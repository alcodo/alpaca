<?php

namespace Alpaca\Listeners\Permission;

use Alpaca\Support\Guard;

class RefreshPermissionCacheListener
{
    /**
     * @var Guard
     */
    private $guard;

    /**
     * Create the event listener.
     *
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Handle the event.
     *
     * @return array
     */
    public function handle()
    {
        $this->guard->refreshCache();
    }

}
