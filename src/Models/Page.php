<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'active',
        'path',

        'title',
        'teaser',
        'content',

        // reference
        'category_id',
        'user_id',

        // seo
        'html_title',
        'meta_robots',
        'meta_description',

    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
