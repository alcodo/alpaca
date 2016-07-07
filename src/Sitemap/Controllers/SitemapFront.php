<?php

namespace Alpaca\Sitemap\Controllers;

use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Routing\Controller;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class SitemapFront extends Controller
{

    public function xml()
    {
        $sitemaps = collect([
            new Sitemap(['url' => '/test'])
        ]);

        return response()->view('sitemap::xml', compact('sitemaps'))->header('Content-Type', 'text/xml');
    }

    public function html()
    {
        $sitemaps = collect([
            new Sitemap(['url' => '/test'])
        ]);

        SEO::setTitle(trans('sitemap::sitemap.sitemap'));
        SEO::metatags()->addMeta('robots', 'noindex, follow');

        return view('sitemap::html', compact('sitemaps'));
    }

}
