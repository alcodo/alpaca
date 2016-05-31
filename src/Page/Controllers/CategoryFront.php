<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Page\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CategoryFront extends Controller
{

    /**
     * Not implementet.
     *
     * @return Response
     */
    public function show($slug)
    {
        $category = Category::getCategoryOrFail($slug);
//        dd($category);
        $pages = $category->page()->get();
//        dd($pages);

        return view('page::category.show', compact('category', 'pages'));
    }
}