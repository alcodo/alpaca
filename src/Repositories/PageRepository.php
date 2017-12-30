<?php

namespace Alpaca\Repositories;

use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Alpaca\Models\Page;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;

class PageRepository
{
    use ValidatesRequests;

    /**
     * Create a page
     *
     * @param array $data
     * @return Page
     */
    public function create(array $data): Page
    {
//        $validatedData = $request->validate([
        $validatedData = $this->validateWith([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string',
            'active' => 'required|boolean',
            // ref
            'user_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            // seo
            'html_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ]);

//        dd($validatedData);

        if (!isset($validatedData['teaser']) || empty($validatedData['teaser'])) {
            $validatedData['teaser'] = ''; // TODO
        }

        if (!isset($validatedData['path']) || empty($validatedData['path'])) {
            $validatedData['path'] = '/' . SlugifyFacade::slugify($validatedData['title']);
        }

        // TODO user id ?

        $page = Page::create($validatedData);

        return $page;
    }

    public function update(Page $page, array $data): Page
    {
        $validatedData = $this->validateWith([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'string',
            'active' => 'required|boolean',
            // ref
            'user_id' => 'nullable|integer',
            'category_id' => 'nullable|integer',
            // seo
            'html_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_robots' => 'nullable|string',
        ]);

        if (!isset($validatedData['teaser']) || empty($validatedData['teaser'])) {
            $validatedData['teaser'] = ''; // TODO
        }

        if (!isset($validatedData['path']) || empty($validatedData['path'])) {
            $validatedData['path'] = '/' . SlugifyFacade::slugify($validatedData['title']);
        }

        $page->update($validatedData);

        return $page;
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