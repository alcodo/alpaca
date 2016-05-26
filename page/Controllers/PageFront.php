<?php namespace Alcodo\Page\Controllers;

use Alcodo\Page\Models\Category;
use Alcodo\Page\Models\Page;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageFront extends Controller
{

    public function show($path)
    {
        if ($path != '/') {
            // it is not a frontpage
            $path = '/' . $path;
        }

        $page = Page::findBySlugOrFail($path);

        if ($page->meta_robots == 'noindex') {
            SEOMeta::addMeta('robots', 'noindex, nofollow');
        }

        if (is_null($page->html_title) || empty($page->html_title)) {
            $title = $page->title;
        } else {
            $title = $page->html_title;
        }

        // Meta
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($page->meta_description);
        SEOMeta::addMeta('article:published_time', $page->created_at->toW3CString(), 'property');

        // Schema.org markup for Google+
        SEOMeta::addMeta('name', $title, 'itemprop');
        // SEOMeta::addMeta('image', $imageurl, 'itemprop');

        // OpenGraph
        OpenGraph::setDescription($page->meta_description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(\Request::url());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'de_DE');

        return view('page::show', compact('page'));
    }

}