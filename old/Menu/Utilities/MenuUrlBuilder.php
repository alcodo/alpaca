<?php

namespace Alpaca\Menu\Utilities;

use Alpaca\Menu\Models\Menu;
use Alpaca\Crud\Utilities\UrlBuilder;

class MenuUrlBuilder extends UrlBuilder
{
    public function getUrlShow($id)
    {
        return route('backend.menu.{menuId}.item.index', $id);
    }
}
