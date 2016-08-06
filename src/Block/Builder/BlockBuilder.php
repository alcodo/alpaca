<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Models\Block;
use Illuminate\Support\Facades\Request;
use Response;

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

        return $areaBlocks->map(function ($block, $key) {
            if ($this->isException($block)) {
                return;
            }

            if (is_null($block->menu_id) === false) {
                // menu
                return $block->menu->getHtml();
            }

            // block
            return Response::view('block::block', ['block' => $block])->getContent();
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
     * Check if block is a exception.
     *
     * @param $block
     * @return bool
     */
    private function isException($block)
    {
        if (empty($block->exception)) {
            return false;
        }

        $patterns_quoted = preg_quote($block->exception, '/');
        $to_replace = [
            '/(\r\n?|\n)/', // newlines
            '/\\\\\*/',     // wildcard
        ];
        $replacements = [
            '|',
            '.*',
        ];

        $regexpPatter = '/^('.preg_replace($to_replace, $replacements, $patterns_quoted).')$/';

        return (bool) preg_match($regexpPatter, Request::path());
    }

    /**
     * Return all blocks for this area.
     *
     * @param $area
     * @return mixed
     */
    protected function getBlockByArea($area)
    {
        if (is_null($this->blocks)) {
            $this->initBlocks();
        }

        if (isset($this->blocks[$area])) {
            return $this->blocks[$area];
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
        $this->blocks = $databaseBlocks->sortBy('range')->groupBy('area');
    }
}
