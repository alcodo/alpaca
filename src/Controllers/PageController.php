<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Category;
use Alpaca\Repositories\PageRepository;
use Illuminate\Http\Request;
use Alpaca\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Alpaca\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(20);
        return view('alpaca::page.list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $releated = $repo->getRelatedPages($page);

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
        return redirect('/backend/page');
    }

//
//    public function showTopic($topicSlug, $pageSlug)
//    {
//        $page = $this->getPage($pageSlug, $topicSlug);
//
//        return $this->viewPage($page);
//    }
//
//    public function showFrontPage()
//    {
//        $page = $this->getPage('');
//
//        return $this->viewPage($page);
//    }
//
//    protected function getPage($pageSlug, $topicSlug = null)
//    {
//        if (is_null($topicSlug)) {
//            $query = Page::whereSlug($pageSlug);
//        } else {
//            $query = Topic::slug($topicSlug)->firstOrFail()->pages()->whereSlug($pageSlug);
//        }
//
//        if (Auth::check() === false || Auth::user()->hasRole('admin') === false) {
//            $query->whereActive(true);
//        }
//
//        $page = $query->get()->first();
//
//        if (is_null($page)) {
//            throw (new ModelNotFoundException())->setModel(Page::class);
//        }
//
//        return $page;
//    }
//
//    protected function viewPage($page)
//    {
//        if (! empty($page->meta_robots)) {
//            SEO::metatags()->addMeta('robots', $page->meta_robots);
//        }
//
//        if (empty($page->html_title)) {
//            SEO::setTitle($page->title);
//        } else {
//            SEO::setTitle($page->html_title);
//        }
//
//        SEO::setDescription($page->meta_description);
//
//        $releated = $this->getReleatedPages($page);
//
//        return view('page::show', compact('page', 'releated'));
//    }
}
