<?php

namespace Tests\Feature;

use Alpaca\Events\Block\BlockWasCreated;
use Alpaca\Events\Block\BlockWasDeleted;
use Alpaca\Events\Block\BlockWasUpdated;
use Alpaca\Repositories\MenuRepository;
use Illuminate\Support\Facades\Event;
use Tests\IntegrationTest;

class BlockTest extends IntegrationTest
{

    public function test_index_menu()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/block')
            ->assertSuccessful()
            ->assertSee('Create block');
    }

    public function test_store_menu()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/block', [
            'title' => 'Footer Menu',
            'class' => 'menu-footer',
        ])
            ->assertRedirect('/backend/block');

        $this->assertDatabaseHas('al_blocks', [
            'title' => 'Footer Menu',
        ]);

        Event::assertDispatched(BlockWasCreated::class);
    }

    public function test_update_menu()
    {
        Event::fake();

        $repo = new MenuRepository();
        $repo->create([
            'title' => 'Cazy'
        ]);


        $this->withoutExceptionHandling();
        $this->put('/backend/block/1', [
            'title' => 'Crazy Menu',
        ])
            ->assertRedirect('/backend/block');

        $this->assertDatabaseHas('al_blocks', [
            'title' => 'Crazy Menu',
        ]);

        Event::assertDispatched(BlockWasUpdated::class);
    }

    public function test_destroy_menu()
    {
        Event::fake();

        $repo = new MenuRepository();
        $repo->create([
            'title' => 'Demo Menu'
        ]);

        $this->assertDatabaseHas('al_blocks', [
            'title' => 'Demo Menu',
        ]);

        $this->withoutExceptionHandling();
        $this->delete('/backend/block/1')
            ->assertRedirect('/backend/block');

        $this->assertDatabaseMissing('al_blocks', [
            'title' => 'Demo Menu',
        ]);

        Event::assertDispatched(BlockWasDeleted::class);
    }

}