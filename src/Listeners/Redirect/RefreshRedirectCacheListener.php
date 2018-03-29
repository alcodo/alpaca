<?php

namespace Alpaca\Listeners\Redirect;

use Alpaca\Support\Redirect\RedirectCache;

class RefreshRedirectCacheListener
{
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return array
     */
    public function handle()
    {
        RedirectCache::refreshCache();
    }
}
