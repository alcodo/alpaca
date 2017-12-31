<?php

namespace Tests\Feature;

use Alpaca\Events\Page\PageWasCreated;
use Alpaca\Events\Page\PageWasDeleted;
use Alpaca\Events\Page\PageWasUpdated;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class PageTest extends IntegrationTest
{

    public function test_show_page()
    {
        $this->withoutExceptionHandling();
        $this->get('/hallo-welt')
            ->assertSuccessful()
            ->assertSee('Hallo');
    }

    public function test_index_page()
    {
        $this->get('/backend/page')
            ->assertSuccessful()
            ->assertSee('Create page');
    }

    public function test_create_page()
    {
        $this->get('/backend/page/create')
            ->assertSuccessful()
            ->assertSee('Save');
    }

    public function test_store_page()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/page', [
            'title' => 'My new Page',
            'content' => 'So cool',
            'active' => true,
        ])
            ->assertRedirect('/my-new-page');

        $this->assertDatabaseHas('page_pages', [
            'title' => 'My new Page',
        ]);

        Event::assertDispatched(PageWasCreated::class);
    }

    public function test_edit_page()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/page/1/edit')
            ->assertSuccessful()
            ->assertSee('Save');
    }

    public function test_update_page()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->put('/backend/page/1', [
            'title' => 'New cool Title',
            'path' => '/new/path',
            'content' => 'So cool',
            'active' => true,
        ])
            ->assertRedirect('/new/path');

        $this->assertDatabaseHas('page_pages', [
            'title' => 'New cool Title',
        ]);

        Event::assertDispatched(PageWasUpdated::class);
    }

    public function test_destroy_page()
    {
        Event::fake();

        $this->assertDatabaseHas('page_pages', [
            'title' => 'Hallo Welt!',
        ]);

        $this->withoutExceptionHandling();
        $this->delete('/backend/page/1')
            ->assertRedirect('/backend/page');

        $this->assertDatabaseMissing('page_pages', [
            'title' => 'Hallo Welt!',
        ]);

        Event::assertDispatched(PageWasDeleted::class);
    }

}