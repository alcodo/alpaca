<?php

/**
 * Page fronted test
 */
class PageFrontTest extends TestCase
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
