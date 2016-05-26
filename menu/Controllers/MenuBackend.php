<?php namespace Alcodo\Menu\Controllers;

use Alcodo\Crud\Controllers\ControllerTrait;
use Alcodo\Crud\Controllers\DependencyTrait;
use Alcodo\Crud\Controllers\ModelTrait;
use Alcodo\Crud\Controllers\TextTrait;
use Alcodo\Crud\Controllers\ViewTrait;
use Alcodo\Crud\Permission\Permission;
use Alcodo\Menu\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Alcodo\Crud\Controllers\CrudContract;

class MenuBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('menu::menu.menu');
    }

    /**
     * Modelname as plural
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('menu::menu.menus');
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
            'title' => $form->text(trans('crud::crud.name'), 'title'),
            'class' => $form->text(trans('crud::crud.class'), 'class'),
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
        return Menu::class;
    }

    /**
     * Return a permession class
     *
     * @return \Alcodo\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('menu-index', 'menu-show', 'menu-create', 'menu-edit', 'menu-delete');
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
        ];
    }

    /**
     * Return rules for update validation
     *
     * @return array
     */
    public function getValidationUpdate()
    {
        return $this->getValidationCreate();
    }

}