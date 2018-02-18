<?php

namespace Alpaca\Controllers;

use Laracasts\Flash\Flash;
use Alpaca\Models\Category;
use Illuminate\Http\Request;
use Alpaca\Repositories\CategoryRepository;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category.administer', ['only' => ['index']]);
        $this->middleware('permission:category.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::category.category_index'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $categories = Category::paginate(20);

        return view('alpaca::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        SEO::setTitle(trans('alpaca::category.create_category'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        return view('alpaca::category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param CategoryRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, CategoryRepository $repo)
    {
        $page = $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/category');
    }

    /**
     * Not implementet.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category)
    {
        SEO::setTitle($category->title);

        return view('alpaca::category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        SEO::setTitle(trans('alpaca::category.edit_category'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        return view('alpaca::category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @param CategoryRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, CategoryRepository $repo)
    {
        $category = $repo->update($category, $request->all());

        Flash::success(trans('alpaca::category.alpaca.successfully_updated'));

        return redirect('/backend/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category, CategoryRepository $repo)
    {
        $repo->delete($category);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/category');
    }
}
