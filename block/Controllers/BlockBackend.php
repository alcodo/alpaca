<?php namespace Alcodo\Block\Controllers;

use Alcodo\Block\Models\Block;
use Alcodo\Crud\Controllers\ControllerTrait;
use Alcodo\Crud\Controllers\DependencyTrait;
use Alcodo\Crud\Controllers\ModelTrait;
use Alcodo\Crud\Controllers\TextTrait;
use Alcodo\Crud\Controllers\ViewTrait;
use Alcodo\Crud\Permission\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Alcodo\Crud\Controllers\CrudContract;

class BlockBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('block::block.block');
    }

    /**
     * Modelname as plural
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('block::block.blocks');
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
                'label' => trans('crud::crud.name'),
                'css' => 'col-md-3',
                'modelValue' => 'name'
            ],
            [
                'label' => trans('block::block.area'),
                'css' => 'col-md-3',
                'modelValue' => 'area'
            ],
            [
                'label' => trans('block::block.range'),
                'css' => 'col-md-3',
                'modelValue' => 'range'
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
        $selectedArea = null;
        $selectedRange = null;

        if (!is_null($entry)) {
            // only for edit
            $selectedArea = $entry->area;
            $selectedRange = $entry->range;
        }

        $formFields = array(
            'id' => $form->hidden('id'),

            'name' => $form->text(trans('crud::crud.name'), 'name'),
            'active' => $form->checkbox(trans('page::page.active'), 'active')->defaultToChecked(),
            'area' => $form->select(trans('block::block.area'), 'area')
                ->options(Block::getAreaChoice())
                ->select($selectedArea),
            'range' => $form->select(trans('block::block.range'), 'range')
                ->options(Block::RANGES)
                ->select($selectedRange),
            'html' => $form->textarea(trans('crud::crud.body'), 'html')->addClass('is-summernote'),
            'exception' => $form->textarea(trans('block::block.exception'), 'exception'),

//            'menu_id' => $form->textarea(trans('block::block.menu'), 'menu_id'),
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
        return Block::class;
    }

    /**
     * Return a permession class
     *
     * @return \Alcodo\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('block-index', 'block-show', 'block-create', 'block-edit', 'block-delete');
    }

    /**
     * Return rules for create validation
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
     * Return rules for update validation
     *
     * @return array
     */
    public function getValidationUpdate()
    {
        return $this->getValidationCreate();
    }

}