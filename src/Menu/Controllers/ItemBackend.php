<?php

namespace Alpaca\Menu\Controllers;

use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Controllers\DependencyTrait;
use Alpaca\Crud\Controllers\ModelTrait;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission;
use Alpaca\Menu\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

class ItemBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('menu::menu.item');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('menu::menu.items');
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
                'label'      => trans('crud::crud.link'),
                'css'        => 'col-md-3',
                'modelValue' => 'getLink',
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
    public function getForm($form = null, Model $entry = null, $parameters = null)
    {
        $formFields = [
            'id'      => $form->hidden('id'),
            'menu_id' => $form->hidden('menu_id')->value($parameters[0]),
            'text'    => $form->text(trans('crud::crud.text'), 'text'),
            'href'    => $form->text(trans('crud::crud.href'), 'href'),
            'title'   => $form->text(trans('crud::crud.title'), 'title'),
            'rel'     => $form->text(trans('crud::crud.rel'), 'rel'),
            'target'  => $form->text(trans('crud::crud.target'), 'target'),
            'submit'  => $form->submit(trans('crud::crud.save')),
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
        return Item::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('menu_item-index', 'menu_item-show', 'menu_item-create', 'menu_item-edit', 'menu_item-delete');
    }

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'text' => 'required|string',
        ];
    }

    /**
     * Return rules for update validation.
     *
     * @return array
     */
    public function getValidationUpdate()
    {
        return $this->getValidationCreate();
    }
}
