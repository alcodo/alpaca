<?php

class SitemapTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_see_sitemap_xml()
    {
        $responeContent = $this->visit('/sitemap.xml')->response->getContent();

        $xmlHeaderStart = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $exists = strpos($responeContent, $xmlHeaderStart) !== false;
        $this->assertTrue($exists);
    }
}
