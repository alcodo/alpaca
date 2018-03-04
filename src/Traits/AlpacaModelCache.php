<?php

namespace Alpaca\Traits;

use Illuminate\Support\Facades\Cache;

trait AlpacaModelCache
{
    public static function refreshCache()
    {
        if (Cache::has(self::$cacheKey)) {
            Cache::forget(self::$cacheKey);
            self::get();
        }
    }

    public static function get()
    {
        return Cache::rememberForever(self::$cacheKey, function () {
            return self::getFromDB();
        });
    }
}
