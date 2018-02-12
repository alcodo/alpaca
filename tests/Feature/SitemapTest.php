<?php

namespace Tests\Feature;

use Tests\IntegrationTest;

class SitemapTest extends IntegrationTest
{
    public function test_see_sitemap_xml()
    {
        $this->get('/sitemap.xml')
            ->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
    }

    public function test_see_sitemap_html()
    {
        $url = config('alpaca.sitemap.path');

        $this->get($url)
            ->assertSuccessful()
            ->assertSee('Title')
            ->assertSee('Hallo Welt');
    }
}
