<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Builder\Roles\Html;
use Alpaca\Block\Builder\Roles\Repository;
use Alpaca\Block\Models\Block;

/**
 * This class gets all blocks.
 * It sorted, filtered and than returned the html for each area.
 */
class Desktop
{

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $blocks;

    /**
     * Returns a html with all blocks for the area.
     *
     * @param $area
     * @return mixed
     */
    public function getBlocks($area)
    {
        $areaBlocks = $this->getDesktopBlockByArea($area);

        if (is_null($areaBlocks)) {
            return;
        }

        return $areaBlocks->map(function (Block $block, $key) {
            // each block
            $html = new Html($block);
            return $html->getDesktopHtml();
        })->implode('');
    }

    /**
     * Check if any block exists for the area.
     *
     * @param $area
     * @return bool
     */
    public function existsBlocks($area)
    {
        $blocks = $this->getDesktopBlockByArea($area);

        return !is_null($blocks);
    }

    /**
     * Return all blocks for this area.
     *
     * @param $area
     * @return mixed
     */
    protected function getDesktopBlockByArea($area)
    {
        $catcher = new Repository();
        $allBlocks = $catcher->getAllBlocks();

        if (isset($allBlocks[$area])) {
            $allBlocks[$area]->filter(function (Block $block) {

                // filter just desktop block
                if ($block->desktop_view === 0 ||
                    $block->mobile_view === 0 && $block->mobile_view_on_desktop === 1
                ) {
                    return false;
                }

                return true;
            });

            return $allBlocks[$area];
        }
    }
}
