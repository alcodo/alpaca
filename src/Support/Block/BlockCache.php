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
        return Block::with(['menu', 'menu.links'])->orderBy('position', 'asc')->get();
    }

}