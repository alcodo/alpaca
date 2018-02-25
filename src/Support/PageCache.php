<?php

namespace Alpaca\Support;

use Alpaca\Models\Page;
use Alpaca\Traits\AlpacaModelCache;

class PageCache
{
    use AlpacaModelCache;

    /** @var string */
    protected static $cacheKey = 'page.cache';

    public static function getFromDB()
    {
        return Page::get();
    }

}