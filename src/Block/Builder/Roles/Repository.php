<?php

namespace Alpaca\Block\Builder\Roles;

use Alpaca\Block\Models\Block;

/**
 * This class gets all blocks.
 * It sorted, filtered and than returned the html for each area.
 */
class Repository
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
//        $databaseBlocks = Block::with(['menu', 'menu.items'])->whereActive(true)->orderBy('range', 'asc')->get();
        $databaseBlocks = Block::with(['menu', 'menu.items'])->orderBy('range', 'asc')->get();
        $eventBlocks = event('loadEventBlocks'); // TODO maybe use here the filter function

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
            ->sortBy('range')
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

}
