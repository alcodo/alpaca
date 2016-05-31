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
use Alpaca\User\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller as BaseController;

class RoleController extends BaseController implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('user::role.role');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('user::role.roles');
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
        $selectedPermissions = null;

        if (!is_null($entry)) {
            // only for edit
            $selectedPermissions = $entry->perms->pluck('id')->toArray();
        }

        $formFields = [
            'id'           => $form->hidden('id'),
            'name'         => $form->text(trans('user::role.name'), 'name'),
            'display_name' => $form->text(trans('user::role.display-name'), 'display_name'),
            'description'  => $form->text(trans('user::role.description'), 'description'),
            'permissions'  => $form->select(trans('user::permission.permissions'), 'permissions')
                ->options(Permission::lists('display_name', 'id'))
                ->multiple()
                ->select($selectedPermissions),
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
        return Role::class;
    }

    /**
     * Return a entry.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntry($id)
    {
        $model = $this->getModelClass();
        $entry = $model::with('perms')->findOrFail($id);

        return $entry;
    }

    /**
     * Return a collections of entries.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEntries()
    {
        $model = $this->getModelClass();
        $entries = $model::with('perms')->get();

        return $entries;
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
        $entry = $model::create($data);

        // roles
        if (isset($data['permissions'])) {
            $entry->attachPermissions($data['permissions']);
        }

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
        $status = $entry->update($data);

        // roles
        $entry->detachPermissions($entry->perms()->get());
        if (isset($data['permissions'])) {
            $entry->attachPermissions($data['permissions']);
        }

        return $status;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new AccessPermission('role-index', 'role-show', 'role-create', 'role-edit', 'role-delete');
    }

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'name'         => 'required|unique:roles',
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
            'name'         => 'required|unique:roles,name,'.$data['id'],
            'display_name' => 'required',
        ];
    }
}
