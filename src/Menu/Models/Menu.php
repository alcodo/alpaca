<?php

namespace Alpaca\Menu\Models;

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
        return $this->hasMany('Alpaca\Menu\Models\Item', 'menu_id', 'id');
    }

    public function getHtml()
    {
        return view('menu::show', ['menu' => $this])->render();
    }
}
