<?php

namespace Alpaca\Sitemap\Controllers;

use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Routing\Controller;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class SitemapFront extends Controller
{
    public function xml()
    {
        $sitemaps = $this->getSitemaps();

        return response()->view('sitemap::xml', compact('sitemaps'))->header('Content-Type', 'text/xml');
    }

    public function html()
    {
        $sitemaps = $this->getSitemaps();

        SEO::setTitle(trans('sitemap::sitemap.sitemap'));
        SEO::metatags()->addMeta('robots', 'noindex, follow');

        return view('sitemap::html', compact('sitemaps'));
    }

    protected function getSitemaps()
    {
        $data = event('sitemap');

        $sitemaps = collect();

        foreach ($data as $items) {
            $sitemaps = $sitemaps->merge($items);
        }

        return $sitemaps;
    }
}
