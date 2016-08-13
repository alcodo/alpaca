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
use Alpaca\Page\Utilities\CategoryUrlBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

class CategoryBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('page::category.category');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('page::category.categories');
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
                'label'      => trans('crud::crud.title'),
                'css'        => 'col-md-3',
                'modelValue' => 'title',
            ],
            [
                'label'      => trans('crud::crud.slug'),
                'css'        => 'col-md-3',
                'modelValue' => 'slug',
            ],
            [
                'label'      => trans('crud::crud.updated'),
                'css'        => 'col-md-2',
                'modelValue' => 'getUpdated',
            ],
        ];
    }

    /**
     * Formbuilder.
     *
     * @param null                                     $form
     * @param \Illuminate\Database\Eloquent\Model|null $entry
     *
     * @return mixed
     */
    public function getForm($form = null, Model $entry = null)
    {
        $formFields = [
            'id'     => $form->hidden('id'),
            'title'  => $form->text(trans('crud::crud.title'), 'title'),
            'slug'   => $form->text(trans('crud::crud.slug'), 'slug'),
            'body'   => $form->textarea(trans('crud::crud.body'), 'body')->addClass('is-summernote'),
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
        return Category::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('category-index', 'category-show', 'category-create', 'category-edit', 'category-delete');
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
            'body'  => 'required|string',
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
            'body'  => 'required|string',
        ];
    }

    /**
     * Return a url builder helper class.
     *
     * @return \Alpaca\Crud\Utilities\UrlBuilder
     */
    public function getUrlBuilderClass($parameters = [])
    {
        return new CategoryUrlBuilder($this, $parameters);
    }
}
