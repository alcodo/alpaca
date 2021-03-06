<?php

namespace Tests\Feature;

use Alpaca\Models\Block;
use Tests\IntegrationTest;
use Illuminate\Support\Facades\Event;
use Alpaca\Events\Block\BlockWasCreated;
use Alpaca\Events\Block\BlockWasDeleted;
use Alpaca\Events\Block\BlockWasUpdated;
use Alpaca\Repositories\BlockRepository;

class BlockTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loginAsAdmin();
    }

    public function test_index_block()
    {
        $this->withoutExceptionHandling();
        $this->get('/backend/block')
            ->assertSuccessful()
            ->assertSee('Create block');
    }

    public function test_store_block()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->post('/backend/block', [
            'title' => 'Frontblock',
            'area' => 'left',
            'active' => true,
            'position' => 0,
            'exception_rule' => true,
        ])
            ->assertRedirect('/backend/block');

        $this->assertDatabaseHas('blocks', [
            'title' => 'Frontblock',
        ]);

        Event::assertDispatched(BlockWasCreated::class);
    }

    public function test_update_block()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->createBlock();

        $this->put('/backend/block/1', [
            'title' => 'Crazy block',
            'area' => 'right',
            'active' => false,
            'position' => 1,
            'exception_rule' => false,
        ])
            ->assertRedirect('/backend/block');

        $this->assertDatabaseHas('blocks', [
            'title' => 'Crazy block',
        ]);

        Event::assertDispatched(BlockWasUpdated::class);
    }

    public function test_destroy_block()
    {
        Event::fake();

        $this->withoutExceptionHandling();
        $this->assertEquals(1, Block::count());

        $this->delete('/backend/block/1')
            ->assertRedirect('/backend/block');

        $this->assertEquals(0, Block::count());

        Event::assertDispatched(BlockWasDeleted::class);
    }

    private function createBlock()
    {
        $repo = new BlockRepository();
        $repo->create([
            'title' => 'Test',
            'area' => 'left',
            'active' => true,
            'position' => 0,
            'exception_rule' => true,
        ]);
    }
}
