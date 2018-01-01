<?php

namespace Alpaca\Listeners\Page;

use Alpaca\Models\Page;
use Alpaca\Models\Sitemap;

class PageSitemapListener
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
        $pages = Page::whereActive(true)->get();
        $sitemaps = [];

        foreach ($pages as $page) {

            $sitemaps[] = new Sitemap([
                'title' => $page->title,
                'url' => config('app.url') . $page->path,
            ]);

        }

        return $sitemaps;
    }
}
