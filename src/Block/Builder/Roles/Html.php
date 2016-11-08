<?php

namespace Alpaca\Block\Builder\Roles;

use Alpaca\Block\Models\Block;

/**
 * Generate html for a block
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

    public function getDesktopHtml()
    {
        return $this->getHtml(false);
    }

    public function getMobileHtml()
    {
        return $this->getHtml(true);
    }

    private function isMenu()
    {
        return is_null($this->block->menu_id) === false;
    }

    private function getHtml($isMobileView)
    {
        // menu
        if ($this->isMenu()) {
            $template = $isMobileView ? 'menu::menuMobile' : 'menu::menu';

            return view($template, [
                'menu' => $this->blocks->menu,
                'isMobileView' => $isMobileView,
            ])->render();
        }

        // block
        $template = $isMobileView ? 'block::blockMobile' : 'block::block';

        return view($template, [
            'block' => $this->blocks,
            'isMobileView' => $isMobileView,
        ])->render();
    }

}
