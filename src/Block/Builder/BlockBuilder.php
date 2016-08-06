<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Models\Block;
use Alpaca\Menu\Models\Menu;
use Illuminate\Support\Facades\Request;
use Response;

class BlockBuilder
{
    protected $blocks;

    public function __construct()
    {
        // get block
        $databaseBlocks = Block::with(['menu', 'menu.items'])->orderBy('range', 'asc')->get();
        $eventBlocks = event('loadEventBlocks');

        // merge
        foreach ($eventBlocks as $eventBlock) {
            $databaseBlocks->push($eventBlock);
        }

        // group by area
        $this->blocks = $databaseBlocks->groupBy('area');

    }

    public function getBlock($area)
    {
        $areaBlocks = $this->getBlockByArea($area);

        return $areaBlocks->map(function ($block, $key) {

            if ($this->isException($block)) {
                return null;
            }

            if (is_null($block->menu_id) === false) {
                // menu
                return $block->menu->getHtml();
            }

            // block
            return Response::view('block::block', ['block' => $block])->getContent();

        })->implode('');
    }

    public function existsBlock($area)
    {
        $blocks = $this->getBlockByArea($area);

        return !is_null($blocks);
    }

    private function str_replace_last($string, $search, $replace)
    {
        if ((($string_len = strlen($string)) == 0) || (($search_len = strlen($search)) == 0)) {
            return $string;
        }
        $pos = strrpos($string, $search);
        if ($pos > 0) {
            return substr($string, 0, $pos) . $replace . substr($string, $pos + $search_len, max(0, $string_len - ($pos + $search_len)));
        }

        return $string;
    }

    private function setActiveLink($html)
    {
        $path = Request::path();
        if ($path == '/') {
            // front page
            return $html;
        } else {
            $searchURL = '"><a href="/' . $path;
            $replaceActive = ' active' . $searchURL;

            return $this->str_replace_last($html, $searchURL, $replaceActive);
        }
    }

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

        $regexpPatter = '/^(' . preg_replace($to_replace, $replacements, $patterns_quoted) . ')$/';

        return (bool)preg_match($regexpPatter, Request::path());
    }

    public function getAreaChoice()
    {
        // copy values to keys
        $areas = array_flip(Block::AREAS);

        foreach ($areas as $area => $value) {
            // set value
            $areas[$area] = $this->getAreaTranslation($area);
        }

        return $areas;
    }

    public function getAreaTranslation($areaId)
    {
        return trans('block::block.' . $areaId);
    }

    protected function getBlockTemplate($block)
    {
        $output = '';
        if (!empty($block->title)) {
            $output .= '<p class="block-title">' . $block->title . '</p>';
        }
        $output .= $block->html;
        return $output;
    }

    protected function getBlockByArea($area)
    {
        if(isset($this->blocks[$area])){
            return $this->blocks[$area];
        }
    }
}
