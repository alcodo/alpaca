<?php
use Alpaca\Page\Models\Page;

/**
 * Category fronted test.
 */
class CategoryFrontTest extends AlpacaTestCase
{

    /**
     * @test
     */
    public function it_allows_see_simple_category()
    {
        $category = alpacaFactory(\Alpaca\Page\Models\Category::class)->create();

        $this->visit('/' . $category->slug)
            ->see($category->title);
    }
}
