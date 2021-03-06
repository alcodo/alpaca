<?php

namespace Tests\Feature;

use Tests\IntegrationTest;
use Illuminate\Support\Facades\Event;
use Alpaca\Events\Category\CategoryWasCreated;
use Alpaca\Events\Category\CategoryWasDeleted;
use Alpaca\Events\Category\CategoryWasUpdated;

class CategoryTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_show_category()
    {
        $this->withoutExceptionHandling();
        $this->get('/')
            ->assertSuccessful()
            ->assertSee('Beiträge');
    }

    public function test_index_category()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/category')
            ->assertSuccessful()
            ->assertSee('Create category');
    }

    public function test_create_category()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/category/create')
            ->assertSuccessful()
            ->assertSee('Save');
    }

    public function test_store_category()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/category', [
            'title' => 'General category',
            'content' => 'Here you can ...',
            'active' => true,
        ])
            ->assertRedirect('/backend/category');

        $this->assertDatabaseHas('categories', [
            'title' => 'General category',
        ]);

        Event::assertDispatched(CategoryWasCreated::class);
    }

    public function test_edit_category()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/category/1/edit')
            ->assertSuccessful()
            ->assertSee('Save');
    }

    public function test_update_category()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->put('/backend/category/1', [
            'title' => 'New cool Title',
            'path' => '/new/path',
            'content' => 'So cool',
            'active' => true,
        ])
            ->assertRedirect('/backend/category');

        $this->assertDatabaseHas('categories', [
            'title' => 'New cool Title',
        ]);

        Event::assertDispatched(CategoryWasUpdated::class);
    }

    public function test_destroy_category()
    {
        Event::fake();

        $this->assertDatabaseHas('categories', [
            'title' => 'Beiträge',
        ]);

        $this->withoutExceptionHandling();
        $this->delete('/backend/category/1')
            ->assertRedirect('/backend/category');

        $this->assertDatabaseMissing('categories', [
            'title' => 'Beiträge',
        ]);

        Event::assertDispatched(CategoryWasDeleted::class);
    }
}
