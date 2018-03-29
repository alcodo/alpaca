<?php

namespace Alpaca\Support\Redirect;

use Alpaca\Models\Redirect;
use Alpaca\Traits\AlpacaModelCache;

class RedirectCache
{
    use AlpacaModelCache;

    /** @var string */
    protected static $cacheKey = 'redirect.cache';

    public static function getFromDB()
    {
        return Redirect::get();
    }
}
