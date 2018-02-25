<?php

namespace Alpaca\Listeners\Category;

use Alpaca\Support\CategoryCache;

class RefreshCategoryCacheListener
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
        CategoryCache::refreshCache();
    }
}
