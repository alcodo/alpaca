<?php

namespace Alpaca\Repositories;


use Alpaca\Events\Category\CategoryWasCreated;
use Alpaca\Events\Category\CategoryWasDeleted;
use Alpaca\Events\Category\CategoryWasUpdated;
use Alpaca\Models\Category;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Auth;
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

        event(new CategoryWasCreated($category, Auth::user()));

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

        event(new CategoryWasUpdated($category, Auth::user()));

        return $category;
    }

    /**
     * @param Category $category
     * @return bool
     * @throws \Exception
     */
    public function delete(Category $category)
    {
        $category->delete();

        event(new CategoryWasDeleted($category, Auth::user()));

        return true;
    }
}