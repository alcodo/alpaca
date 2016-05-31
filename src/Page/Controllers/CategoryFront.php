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
        $category = Category::with('pages')->Slug($slug)->firstOrFail();

        return view('page::category.show', compact('category'));
    }
}