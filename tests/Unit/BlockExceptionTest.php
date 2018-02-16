<?php

namespace Tests\Unit;

use Tests\UnitTest;
use Alpaca\Models\Block;
use Alpaca\Support\Block\Roles\Exception;

class BlockExceptionTest extends UnitTest
{
    /**
     * @test
     */
    public function it_viewable_without_exception_rules()
    {
        $block = new Block([
            'exception' => '',
        ]);

        $ex = new Exception($block);
        $this->assertTrue($ex->isViewable());
    }

    /**
     * @test
     */
    public function it_has_no_access_on()
    {
        $block = new Block([
            'exception_rule' => Block::EXCEPTION_EXCLUDE,
            'exception' => 'video/*',
        ]);

        $ex = new Exception($block);
        $this->assertTrue($ex->isViewable('demo'));

        $ex = new Exception($block);
        $this->assertFalse($ex->isViewable('video/alpaca'));
    }

    /**
     * @test
     */
    public function it_has_only_access_on()
    {
        $block = new Block([
            'exception_rule' => Block::EXCEPTION_ONLY,
            'exception' => 'blog/*',
        ]);

        $ex = new Exception($block);
        $this->assertFalse($ex->isViewable('demo'));

        $ex = new Exception($block);
        $this->assertTrue($ex->isViewable('blog/alpaca'));
    }
}
