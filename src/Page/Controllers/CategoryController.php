<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Page\Models\Category;

//use Alpaca\Core\Controllers\Controller;
//use Illuminate\Support\Facades\Response;
//use Artesaos\SEOTools\Facades\SEOTools as SEO;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Not implementet.
     *
     * @return Response
     */
    public function show(Category $category)
    {
//        dd($category);
//        return 3433;
//        dd(34);
//        $category = Category::with(['pages' => function ($query) {
//            $query->orderBy('title', 'asc');
//        }])->Slug($categorySlug)->firstOrFail();
//
//        SEO::setTitle($category->title);
//
        return view('page::category.show', compact('category'));
    }

}
