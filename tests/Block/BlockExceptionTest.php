<?php

use Alpaca\Block\Models\Block;
use Alpaca\Block\Builder\Roles\Exception;

/**
 * Block testing with menu.
 */
class BlockExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_viewable_without_exception_rules()
    {
        $block = factory(\Alpaca\Block\Models\Block::class)->make();

        $ex = new Exception($block);
        $this->assertTrue($ex->isViewable());
    }

    /**
     * @test
     */
    public function it_has_no_access_on()
    {
        $block = factory(\Alpaca\Block\Models\Block::class)->make([
            'exception_rule' => Block::EXCEPTION_EXCLUDE,
            'exception' => 'video/*',
        ]);

        $this->get('demo');
        $ex = new Exception($block);
        $this->assertTrue($ex->isViewable());

        $this->get('video/alpaca');
        $ex = new Exception($block);
        $this->assertFalse($ex->isViewable());
    }

    /**
     * @test
     */
    public function it_has_only_access_on()
    {
        $block = factory(\Alpaca\Block\Models\Block::class)->make([
            'exception_rule' => Block::EXCEPTION_ONLY,
            'exception' => 'blog/*',
        ]);

        $this->get('demo');
        $ex = new Exception($block);
        $this->assertFalse($ex->isViewable());

        $this->get('blog/alpaca');
        $ex = new Exception($block);
        $this->assertTrue($ex->isViewable());
    }
}
