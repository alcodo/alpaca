<?php

namespace Alpaca\Listeners\Category;

use Alpaca\Models\Category;
use Alpaca\Models\Page;
use Alpaca\Models\Sitemap;

class CategorySitemapListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return array
     */
    public function handle()
    {
        $categories = Category::whereActive(true)->get();
        $sitemaps = [];

        foreach ($categories as $category) {

            $sitemaps[] = new Sitemap([
                'title' => $category->title,
                'url' => config('app.url') . $category->path,
            ]);

        }

        return $sitemaps;
    }
}
