<?php

namespace Alpaca\Page\Listeners;

use Alpaca\Page\Models\Page;
use Alpaca\Sitemap\Models\Sitemap;

class SitemapListener
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
     * @param  sitemap $event
     * @return void
     */
    public function handle()
    {
        $pages = Page::whereActive(true)->get();
        $sitemaps = [];
        $domain = config('app.url') . '/';

        foreach ($pages as $page) {

            if (empty($page->slug)) {
                // frontpage

                $sitemaps[] = new Sitemap([
                    'title' => $page->title,
                    'url' => $domain
                ]);
                continue;
            }

            $sitemaps[] = new Sitemap([
                'title' => $page->title,
                'url' => $domain . $page->slug
            ]);
        }

        return $sitemaps;
    }
}
