<?php namespace Alcodo\Page\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = array(
        'title',
        'slug',
        'body'
    );

    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (array_key_exists('slug', $attributes) === false &&
            array_key_exists('title', $attributes)) {
            // create slug
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($attributes['title']);
        }

        return $this;
    }

    public static function getCategory($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    public static function getCategoryOrFail($slug)
    {
        $entry = self::getCategory($slug);
        if (is_null($entry)) {
            abort(404);
        }

        return $entry;
    }

//    public static function select()
//    {
//        $allCategories = self::all();
//        $result = array('' => '');
//
//        foreach ($allCategories as $category) {
//            $result[$category->id] = $category->name;
//        }
//
//        return $result;
//
//    }

    public function page()
    {
        return $this->hasOne('Alcodo\Page\Models\Page');
    }

}