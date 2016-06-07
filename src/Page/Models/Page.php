<?php

namespace Alpaca\Page\Models;

use Alpaca\User\Models\User;
use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Page extends Model
{
    /*
     * Body text will be cuttet on this tag
     */
    const BREAK_TAG = '<!-- break -->';

    protected $fillable = [
        'active',
        'title',
        'slug',
        'body',

        // seo
        'html_title',
        'meta_robots',
        'meta_description',

        // reference
        'user_id',
        'category_id',
    ];

    public function getCreated()
    {
        return dateintl_full('short', $this->created_at);
    }

    public function getUpdated()
    {
        return dateintl_full('medium', $this->updated_at);
    }

    public function scopeActive($query, $status)
    {
        return $query->where('active', '=', $status);
    }

    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    public static function findBySlugOrFail($slug)
    {
        $entry = self::findBySlug($slug);
        if (is_null($entry)) {
            throw (new ModelNotFoundException())->setModel(get_called_class());
        }

        return $entry;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
