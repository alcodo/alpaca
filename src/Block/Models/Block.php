<?php

namespace Alpaca\Block\Models;

use Alpaca\Menu\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * Possible areas.
     */
    const AREAS = [
        'header',
        'top',
        'bottom',
        'left',
        'right',
        'content-top',
        'content-bottom',
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
        'active',
        'name',
        'title',
        'range',
        'area',
        'menu_id',
        'exception_rule', // true =  exclude false = only
        'exception',
        'html',
        'mobile_view',
        'desktop_view',
        'desktop_view_force', // 'mobile_view_on_desktop',
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
