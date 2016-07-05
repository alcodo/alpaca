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

        $page = Page::create([
            'title' => 'Cat vs Dog',
            'slug' => 'cat-dog',
            'body' => '<p>...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'active' => 1,
            'category_slug' => $category->slug,
        ]);

        $url = config('page.prefix').'/'.$category->slug.'/'.$page->slug;

        $this->visit($url)
            ->see($page->title);
    }

    /**
     * @test
     */
    public function it_allows_see_simple_page_with_topic()
    {
        $topic = alpacaFactory(\Alpaca\Page\Models\Topic::class)->create();

        $page = Page::create([
            'title' => 'Topic is the king',
            'slug' => 'king',
            'body' => '<p>...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'active' => 1,
            'topic_id' => $topic->id,
        ]);

        $url = '/'.$topic->slug.'/'.$page->slug;

        $this->visit($url)
            ->see($page->title);
    }

    /**
     * @test
     */
    public function it_allows_see_simple_page_without_category_and_topic()
    {
        $page = Page::create([
            'title' => 'Alpaca is so cool',
            'slug' => 'alpaca',
            'body' => '<p>...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'active' => 1,
        ]);

        $this->visit('/alpaca')
            ->see($page->title);
    }
}
