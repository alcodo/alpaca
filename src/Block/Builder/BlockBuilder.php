<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Models\Block;

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

        return $areaBlocks->map(function ($block, $key) {
            // each block
            return $this->getHtmlBlock($block, false);
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
     * Return a html block list.
     *
     * @return string
     */
    public function getMobileBlocks()
    {
        $allBlocks = $this->getAllBlocks();

        return $allBlocks->map(function ($area, $key) {
            // each area

            return $area->map(function ($block, $key) {
                if (is_null($block) || ! $block->mobile_view) {
                    return '';
                }

                // each block
                return $this->getHtmlBlock($block, true);
            })->implode('');
        })->implode('');
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

        if (isset($allBlocks[$area])) {
            return $allBlocks[$area];
        }
    }

    /**
     * Load all blocks from database and events.
     * Blocks collection will stored in this class.
     *
     * return void
     */
    public function initBlocks()
    {
        // get block
        $databaseBlocks = Block::with(['menu', 'menu.items'])->orderBy('range', 'asc')->get();
        $eventBlocks = event('loadEventBlocks');

        // merge
        foreach ($eventBlocks as $eventBlock) {
            $databaseBlocks->push($eventBlock);
        }

        // group by area
        $this->blocks = $databaseBlocks
            ->filter(function ($block) {
                // check exception rule
                $ex = new Exception($block);

                return $ex->isViewable();
            })
            ->sortBy('range')
            ->groupBy('area');
    }

    /**
     * Returns all blocks.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getAllBlocks()
    {
        if (is_null($this->blocks)) {
            $this->initBlocks();
        }

        return $this->blocks;
    }

    private function getHtmlBlock($block, $isMobileView)
    {
        if (is_null($block)) {
            return;
        }

        // menu
        if (is_null($block->menu_id) === false) {
            $template = $isMobileView ? 'menu::menuMobile' : 'menu::menu';

            return view($template, [
                'menu' => $block->menu,
                'isMobileView' => $isMobileView,
            ])->render();
        }

        // block
        $template = $isMobileView ? 'block::blockMobile' : 'block::block';

        return view($template, [
            'block' => $block,
            'isMobileView' => $isMobileView,
        ])->render();
    }
}
