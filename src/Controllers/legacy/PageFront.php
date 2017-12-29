<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Page\Models\Page;
use Alpaca\Page\Models\Topic;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Alpaca\Core\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PageFront extends Controller
{
    public function show($pageSlug)
    {
        $page = $this->getPage($pageSlug);

        return $this->viewPage($page);
    }

    public function showTopic($topicSlug, $pageSlug)
    {
        $page = $this->getPage($pageSlug, $topicSlug);

        return $this->viewPage($page);
    }

    public function showFrontPage()
    {
        $page = $this->getPage('');

        return $this->viewPage($page);
    }

    protected function getPage($pageSlug, $topicSlug = null)
    {
        if (is_null($topicSlug)) {
            $query = Page::whereSlug($pageSlug);
        } else {
            $query = Topic::slug($topicSlug)->firstOrFail()->pages()->whereSlug($pageSlug);
        }

        if (Auth::check() === false || Auth::user()->hasRole('admin') === false) {
            $query->whereActive(true);
        }

        $page = $query->get()->first();

        if (is_null($page)) {
            throw (new ModelNotFoundException())->setModel(Page::class);
        }

        return $page;
    }

    protected function viewPage($page)
    {
        if (! empty($page->meta_robots)) {
            SEO::metatags()->addMeta('robots', $page->meta_robots);
        }

        if (empty($page->html_title)) {
            SEO::setTitle($page->title);
        } else {
            SEO::setTitle($page->html_title);
        }

        SEO::setDescription($page->meta_description);

        $releated = $this->getReleatedPages($page);

        return view('page::show', compact('page', 'releated'));
    }

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