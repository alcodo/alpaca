<?php

namespace Alpaca\User\Controllers;

use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Controllers\DependencyTrait;
use Alpaca\Crud\Controllers\ModelTrait;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission as AccessPermission;
use Alpaca\User\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller as BaseController;

class PermissionBackend extends BaseController implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('user::permission.permission');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('user::permission.permissions');
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
                'label'      => trans('user::role.display-name'),
                'css'        => 'col-md-3',
                'modelValue' => 'display_name',
            ],
            [
                'label'      => trans('user::role.description'),
                'css'        => 'col-md-3',
                'modelValue' => 'description',
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
            'id'           => $form->hidden('id'),
            'name'         => $form->text(trans('user::role.name'), 'name'),
            'display_name' => $form->text(trans('user::role.display-name'), 'display_name'),
            'description'  => $form->text(trans('user::role.description'), 'description'),
            'submit'       => $form->submit(trans('crud::crud.save')),
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
        return Permission::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new AccessPermission('permission-index', 'permission-show', 'permission-create', 'permission-edit', 'permission-delete');
    }

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'name'         => 'required|unique:permissions',
            'display_name' => 'required',
        ];
    }

    /**
     * Return rules for update validation.
     *
     * @return array
     */
    public function getValidationUpdate()
    {
        $data = request()->all();

        return [
            'name'         => 'required|unique:permissions,name,'.$data['id'],
            'display_name' => 'required',
        ];
    }
}
