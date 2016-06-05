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

        if (is_null($page->category_id)) {
            return route('page.frontpage');
        }

        return route('page.show', [$page->category->slug, $page->slug]);
    }

}
