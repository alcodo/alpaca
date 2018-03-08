<?php

namespace Alpaca\Support\Page;

use Alpaca\Models\Page;
use Alpaca\Traits\AlpacaModelCache;

class PageTeaser
{
    const BREAK_TAG = '<!--break-->';

    public static function getHtml(Page $page)
    {
        if (! empty($page->teaser)) {
            return $page->teaser;
        }

        // break tag
        if (strpos($page->content,self::BREAK_TAG) !== false) {
            return strstr($page->content, self::BREAK_TAG, true);
        }

        // split
        $htmlPBlocks = explode('</p>', $page->content, 2);
        if(isset($htmlPBlocks[0])){
            return $htmlPBlocks[0] . '</p>';
        }

        return $page->content;
    }
}
