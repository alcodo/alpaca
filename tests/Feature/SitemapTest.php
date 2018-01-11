<?php

namespace Tests\Feature;

use Tests\IntegrationTest;

class SitemapTest extends IntegrationTest
{
    /**
     * @test
     */
    public function it_allows_see_sitemap_xml()
    {
        $this->get('/sitemap.xml')
            ->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
    }
}
