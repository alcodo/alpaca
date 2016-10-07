<?php

namespace Alpaca\Gallery\Controllers;

use Alcodo\PowerImage\Jobs\CreateImage;
use Alcodo\PowerImage\Jobs\DeleteImage;
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

    protected $multipart = true;

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
//            'file' => 'image', TODO file validationimage
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
     * @return string
     */
    public function getViewIndex()
    {
        return 'gallery::list';
    }

    /**
     * Multipart enable.
     *
     * @return bool
     */
    protected function getMultipart()
    {
        return true;
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

        // create image
        $createImage = new CreateImage($data['file'], $data['filename'], 'gallery/');
        $data['filepath'] = $createImage->handle();

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
        $entry = $this->getEntry($id);

        if (!empty($data['file'])) {
            // update image

            $deleteImage = new DeleteImage($entry->filepath);
            $deleteImage->handle();

            $createImage = new CreateImage($data['file'], $data['filename'], 'gallery/');
            $data['filepath'] = $createImage->handle();
        }

        $status = $entry->update($data);

        return $status;
    }

    /**
     * Destryo a entry.
     *
     * @param $id
     *
     * @return bool|int
     */
    public function destroyEntry($id)
    {
        $entry = $this->getEntry($id);

        // delete image
        $deleteImage = new DeleteImage($entry->filepath);
        $deleteImage->handle();

        $status = $entry->delete();

        return $status;
    }
}
