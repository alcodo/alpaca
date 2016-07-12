<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Page\Models\Page;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class PageFront extends Controller
{
    public function show($pageSlug)
    {
        $page = $this->getPage($pageSlug);

        return $this->viewPage($page);
    }

    public function showTopic($topicSlug, $pageSlug)
    {
        $page = $this->getPage($pageSlug);

        return $this->viewPage($page);
    }

    public function showFrontPage()
    {
        $page = $this->getPage('');

        return $this->viewPage($page);
    }

    protected function getPage($pageSlug)
    {
        $query = Page::whereSlug($pageSlug);

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

        return view('page::show', compact('page'));
    }
}
