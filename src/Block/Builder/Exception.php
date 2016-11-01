<?php
/**
 * Created by PhpStorm.
 * User: approach
 * Date: 01.11.16
 * Time: 17:14.
 */
namespace Alpaca\Block\Builder;

use Alpaca\Block\Models\Block;

class Exception
{
    /**
     * @var Block
     */
    private $block;

    /**
     * WhiteList constructor.
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function isUsable(Block $block)
    {
        if (empty($block->exception)) {
            return false;
        }

        if ($block->exception_rule) {
            return $this->hasNotAccess();
        } else {
            return $this->hasOnlyAcces();
        }
    }

    private function hasNotAccess()
    {
        return true;
    }

    private function hasOnlyAcces()
    {
        return true;
    }
}
