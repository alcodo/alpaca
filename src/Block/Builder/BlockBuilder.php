<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Models\Block;
use Illuminate\Support\Facades\Request;

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
                if (is_null($block) || ! $block->ismobile) {
                    return '';
                }

                // each block
                return $this->getHtmlBlock($block, true);
            })->implode('');
        })->implode('');
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
        $this->blocks = $databaseBlocks->sortBy('range')->groupBy('area');
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
        if (is_null($block) || $this->isException($block)) {
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
