<?php

use Alpaca\Menu\Models\Item;
use Alpaca\Menu\Models\Menu;

/**
 * Block with item relation testing.
 */
class BlockItemRelationTest extends TestCase
{
    /**
     * @test
     */
    public function check_relation()
    {
        // create
        $menu = alpacaFactory(\Alpaca\Menu\Models\Menu::class)->create();
        $item = alpacaFactory(\Alpaca\Menu\Models\Item::class)->create([
            'menu_id' => $menu->id,
        ]);

        // check relation
        $this->assertEquals(Menu::first()->items->first()->id, $item->id);
        $this->assertEquals(Item::first()->menu->id, $menu->id);
    }
}
