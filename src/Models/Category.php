<?php

namespace Alpaca\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'page_categories';

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

//    public function fill(array $attributes)
//    {
//        parent::fill($attributes);
//
//        if (array_key_exists('slug', $attributes) === false &&
//            array_key_exists('title', $attributes)
//        ) {
//            // create slug
//            $slugify = new Slugify();
//            $this->slug = $slugify->slugify($attributes['title']);
//        }
//
//        return $this;
//    }
//
//    public function scopeSlug($query, $slug)
//    {
//        return $query->where('slug', '=', $slug);
//    }

//    public function getCreated()
//    {
//        return dateintl_full('short', $this->created_at);
//    }
//
//    public function getUpdated()
//    {
//        return dateintl_full('medium', $this->updated_at);
//    }
}
