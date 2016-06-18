<?php

namespace Alpaca\Menu\Utilities;

use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\Menu\Models\Menu;

class MenuUrlBuilder extends UrlBuilder
{
    public function getUrlShow($id)
    {
        return route('backend.menu.{menuId}.item.index', $id);
    }
}
