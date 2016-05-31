<?php

/**
 * Page fronted test.
 */
class PageFrontTest extends AlpacaTestCase
{
    /**
     * @test
     */
    public function it_allows_see_page()
    {
        $this->visit('/')
            ->see('Frontpage');
    }
}
