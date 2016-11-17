<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Builder\Roles\Html;
use Alpaca\Block\Models\Block;

/**
 * This class gets all blocks.
 * It sorted, filtered and than returned the html for each area.
 */
trait Mobile
{
    /**
     * Return a html block list.
     *
     * @return string
     */
    public function getMobileBlocks()
    {
        $allBlocks = $this->getAllBlocks();

        return $allBlocks->map(function ($area, $key) {
            // each area

            return $area->map(function (Block $block, $key) {
                // each block

                if (is_null($block) ||
                    $block->active == false ||
                    $block->mobile_view == false) {
                    return '';
                }

                // generate html
                $html = new Html($block);

                return $html->getMobileHtml();
            })->implode('');
        })->implode('');
    }
}
