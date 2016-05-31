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
        return route('page.show', $page->slug);
    }

}
