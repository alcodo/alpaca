<?php

namespace Alpaca\Support;

use Alpaca\Models\Category;
use Alpaca\Traits\AlpacaModelCache;

class CategoryCache
{
    use AlpacaModelCache;

    /** @var string */
    protected static $cacheKey = 'category.cache';

    public static function getFromDB()
    {
        return Category::with([
            'pages',
        ])
            ->get();
    }
}
