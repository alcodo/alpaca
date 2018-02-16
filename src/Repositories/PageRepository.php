<?php

namespace Alpaca\Repositories;

use Alpaca\Models\Page;
use Illuminate\Support\Collection;
use Alpaca\Events\Page\PageWasCreated;
use Alpaca\Events\Page\PageWasDeleted;
use Alpaca\Events\Page\PageWasUpdated;
use Illuminate\Support\Facades\Validator;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PageRepository
{
    use ValidatesRequests;

    /**
     * Create a page.
     *
     * @param array $data
     * @return Page
     */
    public function create(array $data): Page
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string|unique:pages,path',
            'active' => 'required|boolean',
            // ref
            'user_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            // seo
            'html_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ])->validate();

        if (! isset($data['teaser']) || empty($data['teaser'])) {
            $data['teaser'] = ''; // TODO
        }

        if (! isset($data['path']) || empty($data['path'])) {
            $data['path'] = '/'.SlugifyFacade::slugify($data['title']);
        }

        // TODO user id ?

        $page = Page::create($data);

        event(new PageWasCreated($page));

        return $page;
    }

    public function update(Page $page, array $data): Page
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string|unique:pages,path,'.$page->id.',id',
            'active' => 'required|boolean',
            // ref
            'user_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            // seo
            'html_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ])->validate();

        if (! isset($data['teaser']) || empty($data['teaser'])) {
            $data['teaser'] = ''; // TODO
        }

        if (! isset($data['path']) || empty($data['path'])) {
            $data['path'] = '/'.SlugifyFacade::slugify($data['title']);
        }

        $page->update($data);

        event(new PageWasUpdated($page));

        return $page;
    }

    /**
     * @param Page $page
     * @return bool
     * @throws \Exception
     */
    public function delete(Page $page) : bool
    {
        $page->delete();

        event(new PageWasDeleted($page));

        return true;
    }

    public function getRelatedPages(Page $page): Collection
    {
        $category = $page->category;
        if (is_null($category)) {
            return collect();
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
