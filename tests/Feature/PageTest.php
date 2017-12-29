<?php

namespace Tests\Feature;

use Tests\IntegrationTest;
use Alpaca\Models\Page;

class PageTest extends IntegrationTest
{

    public function test_show_page()
    {
        $this->get('hallo-welt')
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
        $this->post('/backend/page', [
            'title' => 'My new Page',
            'content' => 'So cool',
            'active' => true,
        ])
            ->assertRedirect('/my-new-page');

        $this->assertDatabaseHas('page_pages', [
            'title' => 'My new Page',
        ]);


//        'active' => true,
//            'path' => '/hallo-welt',
//            'title' => 'Hallo Welt!',
//            'teaser' => '<p>Willkommen beim AlpacaCMS System. Dies ist der erste Beitrag. Du kannst ihn bearbeiten oder löschen. Und dann starte mit dem Schreiben!</p>',
//            'content' => '<p>Willkommen beim AlpacaCMS System. Dies ist der erste Beitrag. Du kannst ihn bearbeiten oder löschen. Und dann starte mit dem Schreiben!</p>',
//            'user_id' => null,
//            'category_id' => $category->id,
//            'html_title' => null,
//            'meta_robots' => null,
//            'meta_description' => null,
    }

    public function test_edit_page()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/page/1/edit')
            ->assertSuccessful()
            ->assertSee('Save');
    }

}