<?php

namespace Alpaca\Page\Controllers;

use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Controllers\DependencyTrait;
use Alpaca\Crud\Controllers\ModelTrait;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission;
use Alpaca\Page\Models\Page;
use Alpaca\Page\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

class TopicBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('page::topic.topic');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('page::topic.topics');
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
                'label'      => trans('crud::crud.created'),
                'css'        => 'col-md-2',
                'modelValue' => 'getCreated',
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
        return Topic::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('topic-index', 'topic-show', 'topic-create', 'topic-edit', 'topic-delete');
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
        ];
    }

    /*
     * Return a url builder helper class.
     *
     * @return \Alpaca\Crud\Utilities\UrlBuilder
     */
//    public function getUrlBuilderClass($parameters = [])
//    {
//        return new CategoryUrlBuilder($this, $parameters);
//    }
}
