<?php

namespace Alpaca\Support\Block\Roles;

use Alpaca\Models\Block;

/**
 * Generate html for a block.
 */
class Html
{
    protected $block;

    /**
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    public function getHtml()
    {
        return view('alpaca::block.show', ['block' => $this->block])->render();
    }
}
