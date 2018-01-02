<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'al_categories';

    protected $fillable = [
        'active',
        'path',
        'title',
        'content',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function pages()
    {
        return $this->hasMany(Page::class);
    }
}
