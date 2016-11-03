<?php

use Alpaca\Block\Models\Block;
use Alpaca\Menu\Models\Menu;
use Alpaca\User\Models\User;

/**
 * Block testing with menu.
 */
class BlockExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_has_no_access_on()
    {
        $block = factory(\Alpaca\Block\Models\Block::class)->make([
            'exception_rule' => Block::EXCEPTION_EXCLUDE,
        ]);
    }

    /**
     * @test
     */
    public function it_has_only_access_on()
    {
        $block = factory(\Alpaca\Block\Models\Block::class)->make([
            'exception_rule' => Block::EXCEPTION_ONLY,
        ]);
    }
}
