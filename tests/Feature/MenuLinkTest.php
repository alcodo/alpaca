<?php

namespace Tests\Feature;

use Alpaca\Events\Menu\MenuLinkWasCreated;
use Alpaca\Events\Menu\MenuLinkWasDeleted;
use Alpaca\Events\Menu\MenuLinkWasUpdated;
use Alpaca\Repositories\MenuRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class MenuLinkTest extends IntegrationTest
{

    public function test_store_menu_link()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createMenu();

        $this->post('/backend/menu/1/link', [
            'text' => 'First link',
            'position' => 0,
            'href' => '/home',
        ])
            ->assertRedirect('/backend/menu');

        $this->assertDatabaseHas('menu_links', [
            'text' => 'First link',
        ]);

        Event::assertDispatched(MenuLinkWasCreated::class);
    }

    public function test_update_menu_link()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createMenu();
        $this->createLink();

        $this->put('/backend/menu/1/link/1', [
            'text' => 'Back',
            'position' => 1,
            'href' => '/back',
        ])
            ->assertRedirect('/backend/menu');

        $this->assertDatabaseHas('menu_links', [
            'text' => 'Back',
            'position' => 1,
            'href' => '/back',
        ]);

        Event::assertDispatched(MenuLinkWasUpdated::class);
    }

    public function test_destroy_menu_link()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createMenu();
        $this->createLink();

        $this->assertDatabaseHas('menu_links', [
            'text' => 'Menulink',
        ]);

        $this->delete('/backend/menu/1/link/1')
            ->assertRedirect('/backend/menu');

        $this->assertDatabaseMissing('menu_links', [
            'title' => 'Menulink',
        ]);

        Event::assertDispatched(MenuLinkWasDeleted::class);
    }

    private function createMenu()
    {
        $repo = new MenuRepository();
        $repo->create([
            'title' => 'Demo Menu'
        ]);
    }

    private function createLink()
    {
        $this->post('/backend/menu/1/link', [
            'text' => 'Menulink',
            'position' => 0,
            'href' => '/menulink',
        ]);
    }

}