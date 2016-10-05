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
use Alpaca\Page\Models\Topic;
use Alpaca\Page\Utilities\PageUrlBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

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
//            [
//                'label' => trans('page::topic.topic'),
//                'css' => 'col-md-3',
//                'modelValue' => 'getTopic',
//            ],
//            [
//                'label' => trans('page::category.category'),
//                'css' => 'col-md-3',
//                'modelValue' => 'getCategory',
//            ],
            [
                'label' => trans('crud::crud.active'),
                'css' => 'col-md-1',
                'html' => true,
                'modelValue' => 'getIsActive',
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
        $selectedTopic = '';

        if (!empty($entry->category_id)) {
            // only for edit
            $selectedCategory = $entry->category_id;
        }

        if (!empty($entry->topic_id)) {
            // only for edit
            $selectedTopic = $entry->topic_id;
        }

        if (isLaravelVersion5_1()) {
            $categories = Category::orderBy('title', 'asc')->lists('title', 'id');
        } else {
            $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        }
        $categories->prepend(trans('page::category.no_category'), '');

        if (isLaravelVersion5_1()) {
            $topics = Topic::orderBy('title', 'asc')->lists('title', 'id');
        } else {
            $topics = Topic::orderBy('title', 'asc')->pluck('title', 'id');
        }
        $topics->prepend(trans('page::topic.no_topic'), '');

        $formFields = [
            'id' => $form->hidden('id'),
            'title' => $form->text(trans('crud::crud.title'), 'title')->addClass('is-title'),
            'slug' => $form->text(trans('crud::crud.slug'), 'slug')->addClass('is-title-to-slug'),
            'topic_id' => $form->select(trans('page::topic.topic'), 'topic_id')
                ->options($topics)
                ->select($selectedTopic),
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

        $data['active'] = isset($data['active']);

        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }
        if (empty($data['topic_id'])) {
            $data['topic_id'] = null;
        }
        if (empty($data['slug'])) {
            if (Page::whereSlug('')->first() !== null) {
                // frontpage does not exists
                $data['slug'] = app('slugify')->slugify($data['title']);
            }
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

        $data['active'] = isset($data['active']);

        if (empty($data['category_id'])) {
            $data['category_id'] = null;
        }
        if (empty($data['topic_id'])) {
            $data['topic_id'] = null;
        }
        if (empty($data['slug'])) {
            if (
                !empty($entry->slug) && // updated page is not a frontpage
                Page::whereSlug('')->first() !== null // frontpage does not exists
            ) {
                $data['slug'] = app('slugify')->slugify($data['title']);
            }
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
