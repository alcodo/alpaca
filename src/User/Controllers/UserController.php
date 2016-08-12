<?php

namespace Alpaca\User\Controllers;

use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Controllers\DependencyTrait;
use Alpaca\Crud\Controllers\ModelTrait;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission;
use Alpaca\User\Models\Role;
use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('user::user.user');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('user::user.users');
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
                'label'      => trans('user::user.username'),
                'css'        => 'col-md-3',
                'modelValue' => 'name',
            ],
            [
                'label'      => trans('user::user.email'),
                'css'        => 'col-md-4',
                'modelValue' => 'email',
            ],
            [
                'label'      => trans('user::role.roles'),
                'css'        => 'col-md-4',
                'modelValue' => 'getRoles',
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
     * @param null       $form
     * @param Model|null $entry
     *
     * @return array
     */
    public function getForm($form = null, Model $entry = null)
    {
        $selectedRoles = null;

        if (! is_null($entry)) {
            // only for edit
            $selectedRoles = $entry->roles->pluck('id')->toArray();
        }

        $formFields = [
            'id'                    => $form->hidden('id'),
            'user_id'               => $form->hidden('user_id'),
            'username'              => $form->text(trans('user::user.username'), 'username'),
            'email'                 => $form->text(trans('user::user.email'), 'email'),
            'password'              => $form->password(trans('user::user.password'), 'password'),
            'password_confirmation' => $form->password(trans('user::user.password_confirm'), 'password_confirmation'),
            'user.roles'            => $form->select(trans('user::role.roles'), 'roles')
                ->options(Role::lists('display_name', 'id'))
                ->multiple()
                ->select($selectedRoles),
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
        return User::class;
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
        $entry = $model::with('roles')->findOrFail($id);

        return $entry;
    }

    /**
     * Returns a collections of entries.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEntries()
    {
        $model = $this->getModelClass();
        $entries = $model::with('roles')->get();

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
        if (isset($data['roles'])) {
            $entry->attachRoles($data['roles']);
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
        $entry->detachRoles();
        if (isset($data['roles'])) {
            $entry->attachRoles($data['roles']);
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
        return new Permission('user-index', 'user-show', 'user-create', 'user-edit', 'user-delete');
    }

    /**
     * Returns rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'username' => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * Returns rules for update validation.
     *
     * @return array
     */
    public function getValidationUpdate()
    {
        $data = request()->all();

        return [
            'username' => 'max:255',
            'email'    => 'email|max:255|unique:users,email,'.$data['id'],
            'password' => 'confirmed|min:6',
        ];
    }
}
