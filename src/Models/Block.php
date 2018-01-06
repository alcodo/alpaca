<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'al_blocks';

    /**
     * Possible areas.
     */
    const AREAS = [
        'header' => 'Header',
        'top' => 'Top',
        'bottom' => 'Bottom',
        'left' => 'Left',
        'right' => 'Right',
        'content-top' => 'Content top',
        'content-bottom' => 'Content bottom',
    ];

    /**
     * Possible ranges.
     */
    const RANGES = [
        0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
        12, 13, 14, 15, 16, 17, 18, 19, 20,
        21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
    ];

    const EXCEPTION_EXCLUDE = 0;

    const EXCEPTION_ONLY = 1;

    protected $fillable = [
        'title',
        'slug',
        'html',

        // options
        'area',
        'active',
        'position',
        'exception_rule', // true =  exclude false = only
        'exception',

        // reference
        'menu_id',
        'user_id',
    ];


    public static function getAreaChoice()
    {
        $areas = self::AREAS;
        $areas = array_flip($areas);

        foreach ($areas as $id => $number) {
            $areas[$id] = trans('block::block.' . $id);
        }

        return $areas;
    }

    public function getMenu()
    {
        if (is_null($this->menu)) {
            return;
        }

        return $this->menu->title;
    }

    public function getHtml($isMobile, $isMobileView)
    {
        if ($isMobileView) {
            $template = 'block::blockMobile';
        } else {
            $template = 'block::block';
        }

//        dump($template);/**/

        return view($template, [
            'block' => $this,
//            'isMobile' => $isMobile,
            'isMobileView' => $isMobileView,
        ])->render();
    }

    public function scopeArea($query, $area)
    {
        return $query->where('area', '=', $area);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
