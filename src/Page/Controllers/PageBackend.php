<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Controllers\DependencyTrait;
use Alpaca\Crud\Controllers\ModelTrait;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission;
use Alpaca\Page\Models\Category;
use Alpaca\Page\Models\Page;
use Alpaca\Page\Utilities\PageUrlBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PageBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('page::page.page');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('page::page.pages');
    }

    /**
     *  Columns for the index page.
     *
     * @return array
     */
    public function getIndexColumns()
    {
        return [
            [
                'label' => trans('crud::crud.title'),
                'css' => 'col-md-3',
                'modelValue' => 'title',
            ],
            [
                'label' => trans('crud::crud.slug'),
                'css' => 'col-md-3',
                'modelValue' => 'slug',
            ],
            [
                'label' => trans('crud::crud.created'),
                'css' => 'col-md-2',
                'modelValue' => 'getCreated',
            ],
            [
                'label' => trans('crud::crud.updated'),
                'css' => 'col-md-2',
                'modelValue' => 'getUpdated',
            ],
        ];
    }

    /**
     * Formbuilder.
     *
     * @param null $form
     * @param \Illuminate\Database\Eloquent\Model|null $entry
     *
     * @return mixed
     */
    public function getForm($form = null, Model $entry = null)
    {
        $selectedCategory = '';

        if (!empty($entry->category_id)) {
            // only for edit
            $selectedCategory = $entry->category_id;
        }

        $categories = Category::orderBy('title', 'asc')->lists('title', 'id');
        $categories->prepend(trans('page::category.no_category'), '');

        $formFields = [
            'id' => $form->hidden('id'),
            'title' => $form->text(trans('crud::crud.title'), 'title')->addClass('is-title'),
            'slug' => $form->text(trans('crud::crud.slug'), 'slug')->addClass('is-title-to-slug'),
            'category_id' => $form->select(trans('page::category.category'), 'category_id')
                ->options($categories)
                ->select($selectedCategory),
            'body' => $form->textarea(trans('crud::crud.body'), 'body')->addClass('is-summernote'),
            'html_title' => $form->text(trans('page::page.html_title'), 'html_title'),
            'meta_description' => $form->text(trans('page::page.meta_description'), 'meta_description'),
            'meta_robots' => $form->text(trans('page::page.meta_robots'), 'meta_robots'),
            'active' => $form->checkbox(trans('page::page.active'), 'active')->defaultToChecked(),
            'submit' => $form->submit(trans('crud::crud.save')),
        ];

        return $formFields;
    }

    /**
     * Return a model classname.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModelClass()
    {
        return Page::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('page-index', 'page-show', 'page-create', 'page-edit', 'page-delete');
    }

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
        ];
    }

    /**
     * Return rules for update validation.
     *
     * @return array
     */
    public function getValidationUpdate()
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
        ];
    }

    /**
     * Create a entry and return it.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createEntry(array $data)
    {
        $model = $this->getModelClass();

        $data['user_id'] = Auth::user()->id;
        $data['active'] = (int)$data['active'];
        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }
        if (empty($data['slug'])) {
            $data['slug'] = app('slugify')->slugify($data['title']);
        }

        $entry = $model::create($data);

        return $entry;
    }

    /**
     * Updates a entry.
     *
     * @param $id
     * @param array $data
     *
     * @return bool|int
     */
    public function updateEntry($id, array $data)
    {
        $entry = $this->getEntry($id);

        $data['user_id'] = Auth::user()->id;
        $data['active'] = (int)$data['active'];
        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }
        if (empty($data['slug'])) {
            $data['slug'] = app('slugify')->slugify($data['title']);
        }

        $status = $entry->update($data);

        return $status;
    }

    /**
     * Return a url builder helper class.
     *
     * @return \Alpaca\Crud\Utilities\UrlBuilder
     */
    public function getUrlBuilderClass($parameters = [])
    {
        return new PageUrlBuilder($this, $parameters);
    }
}
