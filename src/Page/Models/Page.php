<?php

namespace Alpaca\Page\Models;

use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Page extends Model
{
    /*
     * Body text will be cuttet on this tag
     */
    const BREAK_TAG = '<!--break-->';

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
        'category_id',
        'topic_id',
    ];

    public function getCreated()
    {
        return dateintl_full('short', $this->created_at);
    }

    public function getUpdated()
    {
        return dateintl_full('medium', $this->updated_at);
    }

    public function getTopic()
    {
        if (is_null($this->topic)) {
            return;
        }

        return $this->topic->title;
    }

    public function getCategory()
    {
        if (is_null($this->category)) {
            return;
        }

        return $this->category->title;
    }

    public function getCategoryLink()
    {
        if (is_null($this->topic)) {
            return route('category.show', [$this->category->slug]);
        }

        return route('category.show.topic', [$this->topic->slug, $this->category->slug]);
    }

    public function getPageLink()
    {
        if (! is_null($this->topic)) {
            return route('page.show.topic', [$this->topic->slug, $this->slug]);
        }

        return route('page.show', [$this->slug]);
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

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
