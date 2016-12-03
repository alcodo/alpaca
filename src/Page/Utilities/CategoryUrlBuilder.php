<?php

namespace Alpaca\Page\Utilities;

use Alpaca\Page\Models\Category;
use Alpaca\Crud\Utilities\UrlBuilder;

class CategoryUrlBuilder extends UrlBuilder
{
    public function getUrlShow($id)
    {
        $category = Category::findOrFail($id);

        return route('category.show', $category->slug);
    }
}
