<?php

namespace Alcodo\Block\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * Possible areas.
     */
    const AREAS = [
        'top',
        'bottom',
        'left',
        'right',
    ];

    /**
     * Possible ranges.
     */
    const RANGES = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
        12, 13, 14, 15, 16, 17, 18, 19, 20,
        21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
    ];

    protected $fillable = [
        'active',
        'name',
        'range',
        'area',
        'menu_id',
        'exception',
        'html',
    ];

    public static function getAreaChoice()
    {
        $areas = self::AREAS;
        $areas = array_flip($areas);

        foreach ($areas as $id => $number) {
            $areas[$id] = trans('block::block.'.$id);
        }

        return $areas;
    }

    public function scopeArea($query, $area)
    {
        return $query->where('area', '=', $area);
    }
}
