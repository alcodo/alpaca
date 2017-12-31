<?php

namespace Alpaca\Repositories;


use Alpaca\Models\Category;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Validator;

class CategoryRepository
{

    /**
     * Create a page
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'string|unique:page_categories,path',
            'active' => 'required|boolean',
        ])->validate();

        if (!isset($data['path']) || empty($data['path'])) {
            $data['path'] = '/' . SlugifyFacade::slugify($data['title']);
        }

        $category = Category::create($data);

        return $category;
    }

    public function update(Category $category, array $data): Category
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'path' => 'nullable|string|unique:page_categories,path,' . $category->id . ',id',
            'active' => 'required|boolean',
        ])->validate();

        if (!isset($data['path']) || empty($data['path'])) {
            $data['path'] = '/' . SlugifyFacade::slugify($data['title']);
        }

        $category->update($data);

        return $category;
    }

}