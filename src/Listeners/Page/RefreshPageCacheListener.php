<?php

namespace Alpaca\Listeners\Page;

use Alpaca\Support\PageCache;

class RefreshPageCacheListener
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
        PageCache::refreshCache();
    }
}
