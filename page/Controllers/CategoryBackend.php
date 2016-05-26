<?php namespace Alcodo\Page\Controllers;

use Alcodo\Crud\Controllers\ControllerTrait;
use Alcodo\Crud\Controllers\DependencyTrait;
use Alcodo\Crud\Controllers\ModelTrait;
use Alcodo\Crud\Controllers\TextTrait;
use Alcodo\Crud\Controllers\ViewTrait;
use Alcodo\Crud\Permission\Permission;
use Alcodo\Page\Models\Category;
use Alcodo\Page\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Alcodo\Crud\Controllers\CrudContract;
use Illuminate\Support\Facades\Auth;

class CategoryBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('page::category.category');
    }

    /**
     * Modelname as plural
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('page::category.categories');
    }

    /**
     *  Columns for the index page
     *
     * @return array
     */
    public function getIndexColumns()
    {
        return array(
            [
                'label' => trans('crud::crud.title'),
                'css' => 'col-md-3',
                'modelValue' => 'title'
            ],
            [
                'label' => trans('crud::crud.slug'),
                'css' => 'col-md-3',
                'modelValue' => 'slug'
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
            ]
        );
    }

    /**
     * Formbuilder
     *
     * @param null $form
     * @param \Illuminate\Database\Eloquent\Model|null $entry
     * @return mixed
     */
    public function getForm($form = null, Model $entry = null)
    {
        $formFields = array(
            'id' => $form->hidden('id'),
            'title' => $form->text(trans('crud::crud.title'), 'title'),
            'slug' => $form->text(trans('crud::crud.slug'), 'slug'),
            'body' => $form->textarea(trans('crud::crud.body'), 'body')->addClass('is-summernote'),
            'active' => $form->checkbox(trans('page::page.active'), 'active')->defaultToChecked(),
            'submit' => $form->submit(trans('crud::crud.save')),
        );
        return $formFields;
    }

    /**
     * Return a model classname
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModelClass()
    {
        return Category::class;
    }

    /**
     * Return a permession class
     *
     * @return \Alcodo\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('category-index', 'category-show', 'category-create', 'category-edit', 'category-delete');
    }

    /**
     * Return rules for create validation
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
     * Return rules for update validation
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
}