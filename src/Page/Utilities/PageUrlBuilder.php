<?php

namespace Alpaca\Page\Utilities;

use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\Page\Models\Page;

class PageUrlBuilder extends UrlBuilder
{
    public function getUrlShow($id)
    {
        $page = Page::findOrFail($id);

        if (!is_null($page->topic_id)) {
            // page with a topic
            return route('page.show.topic', [$page->topic->slug, $page->slug]);
        }

        if (empty($page->slug)) {
            // frontpage
            return route('page.frontpage');
        }

        // page without a topic
        return route('page.show', [$page->slug]);
    }

}
