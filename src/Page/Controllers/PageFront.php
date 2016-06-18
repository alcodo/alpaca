<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Page\Models\Page;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class PageFront extends Controller
{
    public function show($pageSlug)
    {
        $page = Page::findBySlugOrFail($pageSlug);

        return $this->viewPage($page);
    }

    public function showTopic($topicSlug, $pageSlug)
    {
        $page = Page::findBySlugOrFail($pageSlug);

        return $this->viewPage($page);
    }

    public function showFrontPage()
    {
        $page = Page::findBySlugOrFail('');

        return $this->viewPage($page);
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
