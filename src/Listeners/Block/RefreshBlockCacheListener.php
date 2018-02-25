<?php

namespace Alpaca\Listeners\Block;

use Alpaca\Support\Block\BlockCache;

class RefreshBlockCacheListener
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
        BlockCache::refreshCache();
    }
}
