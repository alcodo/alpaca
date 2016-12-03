<?php

namespace Alpaca\Block\Controllers;

use Alpaca\Menu\Models\Menu;
use Alpaca\Block\Models\Block;
use Illuminate\Routing\Controller;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission;
use Alpaca\Crud\Controllers\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Alpaca\Crud\Controllers\CrudContract;
use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\DependencyTrait;

class BlockBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('block::block.block');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('block::block.blocks');
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
                'label' => trans('crud::crud.name'),
                'css' => 'col-md-3',
                'modelValue' => 'name',
            ],
            [
                'label' => trans('block::block.area'),
                'css' => 'col-md-3',
                'modelValue' => 'area',
            ],
            [
                'label' => trans('menu::menu.menu'),
                'css' => 'col-md-3',
                'modelValue' => 'getMenu',
            ],
            [
                'label' => trans('block::block.range'),
                'css' => 'col-md-3',
                'modelValue' => 'range',
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
        $selectedArea = null;
        $selectedRange = null;
        $selectedMenu = null;

        if (! is_null($entry)) {
            // only for edit
            $selectedArea = $entry->area;
            $selectedRange = $entry->range;

            if (! empty($entry->menu->id)) {
                $selectedMenu = $entry->menu->id;
            }
        }

        $menus = Menu::orderBy('title', 'asc')->pluck('title', 'id');
        $menus->prepend(trans('menu::menu.no_menu'), '');

        $formFields = [
            'id' => $form->hidden('id'),
            'name' => $form->text(trans('crud::crud.name'), 'name'),
            'title' => $form->text(trans('crud::crud.title'), 'title'),
            'active' => $form->checkbox(trans('page::page.active'), 'active')->defaultToChecked(),
            'mobile_view' => $form->checkbox(trans('block::block.mobile_view'), 'mobile_view')->defaultToChecked(),
            'desktop_view' => $form->checkbox(trans('block::block.desktop_view'), 'desktop_view')->defaultToChecked(),
            'desktop_view_force' => $form->checkbox(trans('block::block.desktop_view_force'), 'desktop_view_force'),
            'area' => $form->select(trans('block::block.area'), 'area')
                ->options($this->getAreaChoice())
                ->select($selectedArea),
            'range' => $form->select(trans('block::block.range'), 'range')
                ->options(Block::RANGES)
                ->select($selectedRange),
            'menu_id' => $form->select(trans('menu::menu.menu'), 'menu_id')
                ->options($menus)
                ->select($selectedMenu),
            'html' => $form->textarea(trans('crud::crud.body'), 'html')->addClass('is-summernote'),

            // exception
            'exception_rule_exclude' => $form->radio(trans('block::block.exclude_site'), 'exception_rule', Block::EXCEPTION_EXCLUDE)->checked(),
            'exception_rule_only' => $form->radio(trans('block::block.include_site'), 'exception_rule', Block::EXCEPTION_ONLY),
            'exception' => $form->textarea(trans('block::block.exception'), 'exception')
                ->helpBlock(trans('block::block.exception_help_text')),

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
        return Block::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('block-index', 'block-show', 'block-create', 'block-edit', 'block-delete');
    }

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'name' => 'required|string',
            'range' => 'required|integer',
            'area' => 'required',
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

    /**
     * Create a entry and return it.
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createEntry(array $data)
    {
        if (empty($data['menu_id'])) {
            $data['menu_id'] = null;
        }

        $data['active'] = isset($data['active']);
        $data['mobile_view'] = isset($data['mobile_view']);
        $data['desktop_view'] = isset($data['desktop_view']);
        $data['desktop_view_force'] = isset($data['desktop_view_force']);

        $model = $this->getModelClass();
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
        if (empty($data['menu_id'])) {
            $data['menu_id'] = null;
        }

        $data['active'] = isset($data['active']);
        $data['mobile_view'] = isset($data['mobile_view']);
        $data['desktop_view'] = isset($data['desktop_view']);
        $data['desktop_view_force'] = isset($data['desktop_view_force']);

        $entry = $this->getEntry($id);
        $status = $entry->update($data);

        return $status;
    }

    /**
     * Return a choice array for the backend.
     *
     * @return array
     */
    protected function getAreaChoice()
    {
        // copy values to keys
        $areas = array_flip(Block::AREAS);

        foreach ($areas as $area => $value) {
            // set value
            $areas[$area] = trans('block::block.'.$area);
        }

        return $areas;
    }
}
