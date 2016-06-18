<?php
use Alpaca\Page\Models\Page;
use Alpaca\User\Models\User;

/**
 * Page frontpage test
 */
class PageFrontPageTest extends AlpacaTestCase
{
    /**
     * @test
     */
    public function it_allows_create_frontpage()
    {
        // delete frontpage
        $page = Page::findBySlugOrFail('');
        $page->delete();

        $this->assertNull(Page::findBySlug(''));

        // log in
        $adminUser = User::first();
        $this->actingAs($adminUser);

        // create a page without slug
        $this->visit('/backend/page/create')
            ->type('My Cool CMF System', 'title')
//            ->type('', 'slug')
            ->type('Soo cool', 'body')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        $this->assertNotNull(Page::findBySlug(''), 'Page without slug was not created for the frontpage');
    }

    /**
     * @test
     */
    public function it_not_allows_create_frontpage()
    {
        $this->assertNotNull(Page::findBySlug(''));

        // log in
        $adminUser = User::first();
        $this->actingAs($adminUser);

        // create a page without slug
        $this->visit('/backend/page/create')
            ->type('WildWest', 'title')
//            ->type('', 'slug')
            ->type('Soo cool', 'body')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        $page = Page::whereTitle('WildWest')->firstOrFail();
        $this->assertEquals('wildwest', $page->slug);
    }

    /**
     * @test
     */
    public function it_allows_update_frontpage()
    {
        // log in
        $adminUser = User::first();
        $this->actingAs($adminUser);

        // update a page without slug
        $this->visit('/backend/page/1/edit')
            ->type('My Cool CMF System', 'title')
//            ->type('', 'slug')
            ->type('Soo cool', 'body')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        $this->assertNotNull(Page::findBySlug(''), 'Page slug was created on update');
    }

    /**
     * @test
     */
    public function it_not_allows_update_page_to_a_frontpage()
    {
        // log in
        $adminUser = User::first();
        $this->actingAs($adminUser);

        // create a page without slug
        $this->visit('/backend/page/create')
            ->type('WildWest', 'title')
            ->type('wild', 'slug')
            ->type('Soo cool', 'body')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        // try to update this page without a slug
        $this->visit('/backend/page/2/edit')
            ->type('Wildeast', 'title')
            ->type('', 'slug')
            ->type('Soo cool', 'body')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        $page = Page::whereTitle('Wildeast')->firstOrFail();
        $this->assertEquals('wildeast', $page->slug);

    }

}
