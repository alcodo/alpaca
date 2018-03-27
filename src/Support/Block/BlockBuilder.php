<?php

namespace Alpaca\Support\Block;

use Alpaca\Models\Block;
use Alpaca\Support\Block\Roles\Html;
use Alpaca\Events\Block\BlockIsRequested;
use Alpaca\Support\Block\Roles\Exception;

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
    private function initBlocksAndParse()
    {
        // db
        $blocks = BlockCache::get();

        // event
        $eventBlocks = event(BlockIsRequested::class);
        if (! empty($eventBlocks)) {
            $blocks = $blocks->merge($eventBlocks);
        }

        return $blocks
            ->filter(function ($block) {
                if (is_null($block)) {
                    return false;
                }

                // active
                if ($block->active == false) {
                    return false;
                }

                // exception
                return (new Exception($block))->isViewable();
            })
            ->sortBy('position')
            ->groupBy('area'); // group by area
    }

    /**
     * Returns all blocks.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllBlocks()
    {
        if (is_null($this->blocks)) {
            $this->blocks = $this->initBlocksAndParse();
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
        $areaBlocks = $this->getBlockByArea($area);

        if (is_null($areaBlocks)) {
            return;
        }

        return $areaBlocks->map(function (Block $block, $key) {
            return (new Html($block))->getHtml();
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
        $blocks = $this->getBlockByArea($area);

        return ! is_null($blocks);
    }

    /**
     * Return all blocks for this area.
     *
     * @param $area
     * @return mixed
     */
    protected function getBlockByArea($area)
    {
        $allBlocks = $this->getAllBlocks();

        if (isset($allBlocks[$area]) && $allBlocks[$area]->isNotEmpty()) {
            return $allBlocks[$area];
        }
    }

    public function getMobileMenuBlocks()
    {
        $blocks = $this->getAllBlocks();

        return $blocks->collapse()
            ->sortBy('position')
            ->map(function (Block $block, $key) {
                return (new Html($block))->getMobileHtmlMenu();
            })->implode('');
    }

    public function isMenuActive($block)
    {
        if (is_null($block->menu)) {
            return false;
        }

        foreach ($block->menu->links as $link) {
            if (isActiveUrlExact($link->href)) {
                return true;
            }
        }

        return false;
    }
}
