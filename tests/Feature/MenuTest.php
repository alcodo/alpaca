<?php

namespace Tests\Feature;

use Alpaca\Events\Menu\MenuWasCreated;
use Alpaca\Events\Menu\MenuWasDeleted;
use Alpaca\Events\Menu\MenuWasUpdated;
use Alpaca\Repositories\MenuRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class MenuTest extends IntegrationTest
{

    public function test_index_menu()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/menu')
            ->assertSuccessful()
            ->assertSee('Create menu');
    }

    public function test_store_menu()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/menu', [
            'title' => 'Footer Menu',
            'class' => 'menu-footer',
        ])
            ->assertRedirect('/backend/menu');

        $this->assertDatabaseHas('menus', [
            'title' => 'Footer Menu',
        ]);

        Event::assertDispatched(MenuWasCreated::class);
    }

    public function test_update_menu()
    {
        Event::fake();

        $repo = new MenuRepository();
        $repo->create([
            'title' => 'Cazy'
        ]);


        $this->withoutExceptionHandling();
        $this->put('/backend/menu/1', [
            'title' => 'Crazy Menu',
        ])
            ->assertRedirect('/backend/menu');

        $this->assertDatabaseHas('menus', [
            'title' => 'Crazy Menu',
        ]);

        Event::assertDispatched(MenuWasUpdated::class);
    }

    public function test_destroy_menu()
    {
        Event::fake();

        $repo = new MenuRepository();
        $repo->create([
            'title' => 'Demo Menu'
        ]);

        $this->assertDatabaseHas('menus', [
            'title' => 'Demo Menu',
        ]);

        $this->withoutExceptionHandling();
        $this->delete('/backend/menu/1')
            ->assertRedirect('/backend/menu');

        $this->assertDatabaseMissing('menus', [
            'title' => 'Demo Menu',
        ]);

        Event::assertDispatched(MenuWasDeleted::class);
    }

}