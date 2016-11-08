<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Builder\Roles\Html;
use Alpaca\Block\Models\Block;

/**
 * This class gets all blocks.
 * It sorted, filtered and than returned the html for each area.
 */
trait Desktop
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

        return ! is_null($blocks);
    }

    /**
     * Return all blocks for this area.
     *
     * @param $area
     * @return mixed
     */
    protected function getDesktopBlockByArea($area)
    {
        $allBlocks = $this->getAllBlocks();


        if (isset($allBlocks[$area])) {
            $blocks = $allBlocks[$area]->filter(function (Block $block) {
                if ($block->desktop_view === 1) {
                    return true;
                }

                if ($block->mobile_view === 0 && $block->mobile_view_on_desktop === 1) {
                    return true;
                }

//                if ($block->mobile_view === 0) {
//                    return false;
//                }

                return false;
            });

            if ($blocks->isEmpty()) {
                return;
            }

            return $allBlocks[$area];
        }
    }
}
