<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $fillable = [
        'text',
        'position',
        'title',
        'href',
        'rel',
        'target',
        // ref
        'menu_id',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
