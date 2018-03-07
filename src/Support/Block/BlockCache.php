<?php

namespace Alpaca\Support\Block;

use Alpaca\Models\Block;
use Alpaca\Traits\AlpacaModelCache;

class BlockCache
{
    use AlpacaModelCache;

    /** @var string */
    protected static $cacheKey = 'block.cache';

    public static function getFromDB()
    {
        return Block::with([
            'menu',
            'menu.links' => function ($query) {
                $query->orderBy('position', 'ASC');
            },
        ])->orderBy('position', 'asc')->get();
    }
}
