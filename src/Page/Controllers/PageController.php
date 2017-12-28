<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Page\Models\Category;
use Illuminate\Http\Request;
use Alpaca\Page\Models\Page;
use Alpaca\Page\Models\Topic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Alpaca\Core\Controllers\Controller;
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
        return view('page::page.list', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        $categories->prepend(trans('page::category.no_category'), '');

        return view('page::page.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Alpaca\Page\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        $releated = $this->getReleatedPages($page);

        return view('page::page.show', compact('page', 'releated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Alpaca\Page\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Alpaca\Page\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Alpaca\Page\Models\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
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

    /**
     * Get releated pages from same category.
     *
     * @param Page $page
     * @return Collection
     */
    protected function getReleatedPages(Page $page)
    {
        $category = $page->category;
        if (is_null($category)) {
            return;
        }

        /** @var Collection $releated */
        $releated = $category->pages;

        $releated = $releated->filter(function ($releatedPage, $key) use ($page) {
            return $releatedPage->id !== $page->id;
        })->shuffle();
        $releated = $releated->take(5);

        return $releated;
    }
}
