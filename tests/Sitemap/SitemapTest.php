<?php

class SitemapTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_see_sitemap_xml()
    {
        $this->visit('/sitemap.xml')
            ->see('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');
    }
}
