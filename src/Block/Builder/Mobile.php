<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Builder\Roles\Html;
use Alpaca\Block\Builder\Roles\Repository;
use Alpaca\Block\Models\Block;

/**
 * This class gets all blocks.
 * It sorted, filtered and than returned the html for each area.
 */
class Mobile
{
    /**
     * Return a html block list.
     *
     * @return string
     */
    public function getMobileBlocks()
    {
        // get
        $catcher = new Repository();
        $allBlocks = $catcher->getAllBlocks();

        return $allBlocks->map(function ($area, $key) {
            // each area

            return $area->map(function (Block $block, $key) {
                // each block

                if (is_null($block) || !$block->mobile_view) {
                    return '';
                }

                // generate html
                $html = new Html($block);
                return $html->getMobileHtml();

            })->implode('');
        })->implode('');
    }

}
