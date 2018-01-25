<?php

namespace Alpaca\Models;

use Alpaca\Block\Models\Block;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'class',
    ];

    public function links()
    {
        return $this->hasMany( MenuLink::class);
    }

    public function block()
    {
        return $this->hasMany(Block::class);
    }
}
