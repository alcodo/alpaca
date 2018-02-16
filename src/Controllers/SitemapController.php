<?php

namespace Alpaca\Controllers;

use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Routing\Controller;
use Alpaca\Events\Sitemap\SitemapIsRequested;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class SitemapController extends Controller
{
    public function xml()
    {
        $sitemaps = $this->getSitemaps();

        return response()->view('alpaca::sitemap.xml', compact('sitemaps'))->header('Content-Type', 'text/xml');
    }

    public function html()
    {
        $sitemaps = $this->getSitemaps();

        SEO::setTitle('Sitemap');
        SEO::metatags()->addMeta('robots', 'noindex, follow');

        return view('alpaca::sitemap.html', compact('sitemaps'));
    }

    protected function getSitemaps()
    {
        $data = event(new SitemapIsRequested());

        $sitemaps = collect();

        foreach ($data as $items) {
            $sitemaps = $sitemaps->merge($items);
        }

        return $sitemaps;
    }
}
