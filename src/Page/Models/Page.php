<?php

namespace Alpaca\Page\Models;

use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page_pages';

    /*
     * Body text will be cuttet on this tag
     */
//    const BREAK_TAG = '<!--break-->';

    protected $fillable = [
        'active',
        'path',

        'title',
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

//    public function getIsActive()
//    {
//        if ($this->active) {
//            return '<i class="fa fa-check text-success" aria-hidden="true"></i>';
//        }
//
//        return '<i class="fa fa-times text-danger" aria-hidden="true"></i>';
//    }
//
//    public function getCreated()
//    {
//        return dateintl_full('short', $this->created_at);
//    }
//
//    public function getUpdated()
//    {
//        return dateintl_full('medium', $this->updated_at);
//    }
//
//    public function getTopic()
//    {
//        if (is_null($this->topic)) {
//            return;
//        }
//
//        return $this->topic->title;
//    }
//
//    public function getCategory()
//    {
//        if (is_null($this->category)) {
//            return;
//        }
//
//        return $this->category->title;
//    }
//
//    public function getCategoryLink()
//    {
//        if (is_null($this->topic)) {
//            return route('category.show', [$this->category->slug]);
//        }
//
//        return route('category.show.topic', [$this->topic->slug, $this->category->slug]);
//    }
//
//    public function getPageLink()
//    {
//        if (!is_null($this->topic_id)) {
//            return route('page.show.topic', [$this->topic->slug, $this->slug]);
//        }
//
//        return route('page.show', [$this->slug]);
//    }


//    public function topic()
//    {
//        return $this->belongsTo(Topic::class);
//    }

}
