<?php

namespace Alpaca\Gallery\Controllers;

use Alpaca\Crud\Controllers\ControllerTrait;
use Alpaca\Crud\Controllers\DependencyTrait;
use Alpaca\Crud\Controllers\ModelTrait;
use Alpaca\Crud\Controllers\TextTrait;
use Alpaca\Crud\Controllers\ViewTrait;
use Alpaca\Crud\Permission\Permission;
use Alpaca\Gallery\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;
use Alpaca\Crud\Controllers\CrudContract;

class GalleryBackend extends Controller implements CrudContract
{
    use ControllerTrait, ViewTrait, ModelTrait, TextTrait, DependencyTrait;

    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName()
    {
        return trans('gallery::gallery.gallery');
    }

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName()
    {
        return trans('gallery::gallery.gallery');
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
                'label' => trans('crud::crud.title'),
                'css' => 'col-md-3',
                'modelValue' => 'title',
            ],
        ];
    }

    /**
     * Formbuilder.
     *
     * @param null $form
     * @param \Illuminate\Database\Eloquent\Model|null $entry
     * @return mixed
     */
    public function getForm($form = null, Model $entry = null)
    {
        $formFields = [
            'file' => $form->file(trans('crud::crud.file'), 'file'),
            'filename' => $form->text(trans('crud::crud.filename'), 'filename'),
            'title' => $form->text(trans('crud::crud.title'), 'title'),
            'alt' => $form->text(trans('crud::crud.alt'), 'alt'),
            'copyright_simple' => $form->text(trans('gallery::gallery.copyright_simple'), 'copyright_simple'),

            'ccc' => $form->label('Copyright Creative Commons'),
            'copyright_author' => $form->text(trans('gallery::gallery.copyright_author'), 'copyright_author'),
            'copyright_title' => $form->text(trans('gallery::gallery.copyright_title'), 'copyright_title'),
            'copyright_source_url' => $form->text(trans('gallery::gallery.copyright_source_url'), 'copyright_source_url'),
            'copyright_license_url' => $form->text(trans('gallery::gallery.copyright_license_url'), 'copyright_license_url'),
            'copyright_license_tag' => $form->text(trans('gallery::gallery.copyright_license_tag'), 'copyright_license_tag'),
            'copyright_modification' => $form->text(trans('gallery::gallery.copyright_modification'), 'copyright_modification'),
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
        return Image::class;
    }

    /**
     * Return a permession class.
     *
     * @return \Alpaca\Crud\Permission\Permission
     */
    public function getPermissionClass()
    {
        return new Permission('gallery-index', 'gallery-show', 'gallery-create', 'gallery-edit', 'gallery-delete');
    }

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate()
    {
        return [
            'file' => 'required',
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
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->getPermissionClass()->canCreateOrFail();

        $parameters = func_get_args();
        $urlBuilder = $this->getUrlBuilderClass($parameters);

        /** @var HorizontalFormBuilder $form */
        $form = app('bootform.horizontal');
        $form->setColumnSizes($this->getColumnSizes());

        /** @var FormOpen $formStart */
        $formStart = $form->open()->multipart();
        $formStart->action($urlBuilder->getUrlStore());

        $formFields = $this->getForm($form, null, $parameters);

        /** @var FormBuilder $formClose */
        $formClose = $form->close();

        $title = $this->getUrlCreateText();

        return view($this->getViewCreate(), compact('title', 'formStart', 'formClose', 'formFields'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $parameters = func_get_args();
        $id = end($parameters);

        $this->getPermissionClass()->canEditOrFail();
        $entry = $this->getEntry($id);

        $urlBuilder = $this->getUrlBuilderClass($parameters);

        /** @var HorizontalFormBuilder $form */
        $form = app('bootform.horizontal');
        $form->setColumnSizes($this->getColumnSizes());
        $form->bind($entry);

        /** @var FormOpen $formStart */
        $formStart = $form->open()->multipart();
        $formStart->action($urlBuilder->getUrlUpdate($entry->getKey()));
        $formStart->put();

        $formFields = $this->getForm($form, $entry);

        /** @var FormBuilder $formClose */
        $formClose = $form->close();
        $title = $this->getUrlEditText();

        return view($this->getViewEdit(), compact('title', 'formStart', 'formClose', 'formFields'));
    }

    /**
     * @return string
     */
    public function getViewIndex()
    {
        return 'gallery::list';
    }
}