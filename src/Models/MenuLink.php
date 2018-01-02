<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $table = 'al_menu_links';

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
