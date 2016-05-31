<?php

namespace Alpaca\Block\Builder;

use Alpaca\Block\Models\Block;
use Alpaca\Menu\Models\Menu;
use Illuminate\Support\Facades\Request;

class BlockBuilder
{
    public function createBlock($area)
    {
        $blocks = Block::area($area)->orderBy('range', 'asc')->get();

        if ($blocks->isEmpty()) {
            // no blocks in this area
            return;
        }

        $output = null;
        foreach ($blocks as $block) {
            if ($this->isException($block)) {
                if (empty($block->menu_id)) {
                    // normal html block
                    $output .= $this->setActiveLink($block->html);
                } else {
                    // menu block
                    $menu = Menu::findOrFail($block->menu_id);
                    $output .= $menu->getHtml();
                }
            }
        }

        return $output;
    }

    private function str_replace_last($string, $search, $replace)
    {
        if ((($string_len = strlen($string)) == 0) || (($search_len = strlen($search)) == 0)) {
            return $string;
        }
        $pos = strrpos($string, $search);
        if ($pos > 0) {
            return substr($string, 0, $pos).$replace.substr($string, $pos + $search_len, max(0, $string_len - ($pos + $search_len)));
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
            $searchURL = '"><a href="/'.$path;
            $replaceActive = ' active'.$searchURL;

            return $this->str_replace_last($html, $searchURL, $replaceActive);
        }
    }

    private function isException($menu)
    {
        if (empty($menu->exception)) {
            return true;
        }

        $patterns_quoted = preg_quote($menu->exception, '/');
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
        return trans('block::block.'.$areaId);
    }
}
