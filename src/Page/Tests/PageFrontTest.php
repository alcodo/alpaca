<?php
use Alpaca\Page\Models\Page;

/**
 * Page fronted test.
 */
class PageFrontTest extends AlpacaTestCase
{
    /**
     * @test
     */
    public function it_allows_see_front_page()
    {
        $this->visit('/')
            ->see('Frontpage');
    }

    /**
     * @test
     */
    public function it_allows_see_simple_page_with_category()
    {
        $category = alpacaFactory(\Alpaca\Page\Models\Category::class)->create();

        $page = Page::create(array(
            'title' => 'Cat vs Dog',
            'slug' => 'cat-dog',
            'body' => '<p>...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'user_id' => 1,
            'active' => 1,
            'category_slug' => $category->slug,
        ));

        $url = '/' . $category->slug . '/' . $page->slug;

        $this->visit($url)
            ->see($page->title);
    }
}
