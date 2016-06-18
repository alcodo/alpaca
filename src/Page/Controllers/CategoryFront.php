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
    public function show($categorySlug)
    {
        $category = Category::with(['pages' => function ($query) {
            $query->orderBy('title', 'asc');
        }])->Slug($categorySlug)->firstOrFail();

        return view('page::category.show', compact('category'));
    }
    /**
     * Not implementet.
     *
     * @return Response
     */
    public function showTopic($topicSlug, $categorySlug)
    {
        $category = Category::with(['pages' => function ($query) {
            $query->orderBy('title', 'asc');
        }])->Slug($categorySlug)->firstOrFail();

        return view('page::category.show', compact('category'));
    }
}