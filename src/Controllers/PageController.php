<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Category;
use Alpaca\Repositories\PageRepository;
use Illuminate\Http\Request;
use Alpaca\Models\Page;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::page.page_index'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $pages = Page::paginate(20);

        return view('alpaca::page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        SEO::setTitle(trans('alpaca::page.create_page'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        $categories->prepend(trans('alpaca::category.no_category'), '');

        return view('alpaca::page.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param PageRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PageRepository $repo)
    {
        $page = $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect($page->path);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Alpaca\Models\Page $page
     * @param PageRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $repo = new PageRepository();

        // TODO check is active
        //        if (Auth::check() === false || Auth::user()->hasRole('admin') === false) {
//            $query->whereActive(true);
//        }

        $releated = $repo->getRelatedPages($page);

        if (!empty($page->meta_robots)) {
            SEO::metatags()->addMeta('robots', $page->meta_robots);
        }

        if (empty($page->html_title)) {
            SEO::setTitle($page->title);
        } else {
            SEO::setTitle($page->html_title);
        }

        SEO::setDescription($page->meta_description);

        return view('alpaca::page.show', compact('page', 'releated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Alpaca\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        SEO::setTitle(trans('alpaca::page.edit_page'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        $categories->prepend(trans('alpaca::category.no_category'), '');

        return view('alpaca::page.edit', compact('page', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Alpaca\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page, PageRepository $repo)
    {
        $page = $repo->update($page, $request->all());


        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect($page->path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Alpaca\Models\Page $page
     * @param PageRepository $repo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Page $page, PageRepository $repo)
    {
        $repo->delete($page);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/page');
    }
}
