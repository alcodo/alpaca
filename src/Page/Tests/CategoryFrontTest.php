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
    public function it_allows_see_category_without_topic()
    {
        $category = alpacaFactory(\Alpaca\Page\Models\Category::class)->create();

        $this->visit(config('page.categoryPrefix') . '/' . $category->slug)
            ->see($category->title);
    }

    /**
     * @test
     */
    public function it_allows_see_category_with_topic()
    {
        $topic = alpacaFactory(\Alpaca\Page\Models\Topic::class)->create();
        $category = alpacaFactory(\Alpaca\Page\Models\Category::class)->create();

        $url = $topic->slug . '/' . config('page.categoryPrefix') . '/' . $category->slug;

        $this->visit($url)
            ->see($category->title);
    }
}
