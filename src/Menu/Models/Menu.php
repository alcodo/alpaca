<?php

namespace Alpaca\Menu\Models;

use Alpaca\Block\Models\Block;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'class',
        'html',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getHtml($isMobile, $isMobileMenu)
    {
        return view('menu::show', [
            'menu' => $this,
            'isMobile' => $isMobile,
            'isMobileMenu' => $isMobileMenu
        ])->render();
    }

    public function block()
    {
        return $this->hasMany(Block::class);
    }
}
