<?php

namespace Alpaca\Support\Block;

use Alpaca\Events\Block\BlockIsRequested;
use Alpaca\Models\Block;
use Alpaca\Support\Block\Roles\Exception;
use Alpaca\Support\Block\Roles\Html;

/**
 * This class gets all blocks.
 * It sorted, filtered and than returned the html for each area.
 */
class BlockBuilder
{

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $blocks;

    /**
     * Load all blocks from database and events.
     * Blocks collection will stored in this class.
     *
     * return void
     */
    private function initBlocks()
    {
        // get block
        $databaseBlocks = Block::with(['menu', 'menu.links'])->orderBy('position', 'asc')->get();
        $eventBlocks = event(BlockIsRequested::class); // TODO maybe use here the filter function

        // merge event blocks
        foreach ($eventBlocks as $eventBlock) {
            if (is_null($eventBlock)) {
                continue;
            }

            if ($eventBlock->active == false) {
                // not active
                continue;
            }

            $databaseBlocks->push($eventBlock);
        }

        // group by area
        $this->blocks = $databaseBlocks
            ->filter(function ($block) {
                if (is_null($block)) {
                    return false;
                }
                // check exception rule
                $ex = new Exception($block);

                return $ex->isViewable();
            })
            ->sortBy('position')
            ->groupBy('area');
    }

    /**
     * Returns all blocks.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllBlocks()
    {
        if (is_null($this->blocks)) {
            $this->initBlocks();
        }

        return $this->blocks;
    }


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

            return $html->getHtml();

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

        if (isset($allBlocks[$area]) && $allBlocks[$area]->isNotEmpty()) {
            return $allBlocks[$area];
        }

        return null;
    }
}