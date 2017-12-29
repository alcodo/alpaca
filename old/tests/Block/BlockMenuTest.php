<?php

use Alpaca\Menu\Models\Menu;
use Alpaca\User\Models\User;
use Alpaca\Block\Models\Block;

/**
 * Block testing with menu.
 */
class BlockMenuTest extends TestCase
{
    /**
     * @test
     */
    public function it_allows_change_menu()
    {
        // create menus
        $firstMenu = factory(Menu::class)->create();
        $secondMenu = factory(Menu::class)->create();

        // login
        $adminUser = User::first();
        $this->actingAs($adminUser);

        // create a block
        $this->visit('/backend/block/create')
            ->type('Navigation', 'name')
            ->select($firstMenu->id, 'menu_id')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        $block = Block::first();
        $this->assertEquals($firstMenu->id, $block->menu_id);

        // update a block
        $this->visit('/backend/block/1/edit')
            ->select($secondMenu->id, 'menu_id')
            ->press(trans('crud::crud.save'))
            ->see('alert-success');

        $block = Block::first();
        $this->assertEquals($secondMenu->id, $block->menu_id);
    }

    /**
     * @test
     */
    public function check_relation()
    {
        $menu = factory(Menu::class)->create();
        $block = factory(\Alpaca\Block\Models\Block::class)->create([
            'menu_id' => $menu->id,
        ]);

        // check relation
        $this->assertEquals(Menu::first()->block->first()->id, $block->id);
        $this->assertEquals(Block::first()->menu->first()->id, $menu->id);
    }
}
