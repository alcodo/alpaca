<?php

namespace Alpaca\Menu\Utilities;

use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\Menu\Models\Menu;
use Alpaca\Page\Models\Category;

class MenuUrlBuilder extends UrlBuilder
{
    public function getUrlShow($id)
    {
        return route('backend.menu.{menuId}.item.index', $id);
    }

}