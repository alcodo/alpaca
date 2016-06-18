<?php

namespace Alpaca\Page\Utilities;

use Alpaca\Crud\Utilities\UrlBuilder;
use Alpaca\Page\Models\Category;

class CategoryUrlBuilder extends UrlBuilder
{
    public function getUrlShow($id)
    {
        $category = Category::findOrFail($id);

        return route('category.show', $category->slug);
    }
}
