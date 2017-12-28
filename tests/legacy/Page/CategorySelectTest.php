<?php

use Alpaca\Page\Models\Page;
use Alpaca\User\Models\User;

/**
 * Category fronted test.
 */
class CategorySelectTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_choice_category()
    {
        $this->actingAs(User::first());

        $category = factory(\Alpaca\Page\Models\Category::class)->create();

        // create a page with a category
        $this->visit(route('backend.page.create'))
            ->type('Hallo', 'title')
            ->type('hallo', 'slug')
            ->select($category->id, 'category_id')
            ->type('Content', 'body')
            ->press('Save')
            ->see('alert-success');

        $page = Page::whereSlug('hallo')->first();
        $this->assertNotNull($page);
        $this->assertEquals($page->category_id, $category->id, 'Category id was not saved in page');

        // check page is viewable in category
        $this->visit(route('category.show', $category->slug))
            ->see($page->title);
    }

    /**
     * @test
     */
    public function it_allows_choice_no_category()
    {
        $this->actingAs(User::first());

        // create a page with a category
        $this->visit(route('backend.page.create'))
            ->type('Hallo', 'title')
            ->type('hallo', 'slug')
            ->select('', 'category_id')
            ->type('Content', 'body')
            ->press('Save')
            ->see('alert-success');

        $page = Page::whereSlug('hallo')->first();
        $this->assertNotNull($page);
        $this->assertEquals($page->category_id, '', 'Category id saved in page');
    }
}
