<?php

namespace Alcodo\Crud\Controllers;

use Illuminate\Database\Eloquent\Model;

interface CrudContract
{
    /**
     * Modelname as singular.
     *
     * @return string
     */
    public function getSingularModelName();

    /**
     * Modelname as plural.
     *
     * @return string
     */
    public function getPluralModelName();

    /**
     * Title for the index page.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Description for the index page.
     *
     * @return string
     */
    public function getDescription();

    /**
     *  Columns for the index page.
     *
     * @return array
     */
    public function getIndexColumns();

    /**
     * Formbuilder.
     *
     * @return mixed
     */

    /**
     * Formbuilder.
     *
     * @param null                                     $form
     * @param \Illuminate\Database\Eloquent\Model|null $entry
     *
     * @return mixed
     */
    public function getForm($form = null, Model $entry = null);

    /**
     * Return a model classname.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModelClass();

    /**
     * Return a notification helper class.
     *
     * @return \Alcodo\Crud\Notification\Notification
     */
    public function getNotificationClass();

    /**
     * Return a url builder helper class.
     *
     * @return \Alcodo\Crud\Utilities\UrlBuilder
     */
    public function getUrlBuilderClass();

    /**
     * Return a permession class.
     *
     * @return \Alcodo\Crud\Permission\Permission
     */
    public function getPermissionClass();

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index();

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create();

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store();

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show();

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit();

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update();

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy();

    /**
     * Return view name.
     *
     * @return string
     */
    public function getViewIndex();

    public function getViewShow();

    public function getViewCreate();

    public function getViewEdit();

    /**
     * Return a array with form sizes.
     *
     * @return array
     */
    public function getColumnSizes();

    /**
     * Return a entry.
     *
     * @param $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntry($id);

    /**
     * Return a collections of entries.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllEntries();

    /**
     * Return rules for create validation.
     *
     * @return array
     */
    public function getValidationCreate();

    /**
     * Return rules for update validation.
     *
     * @return array
     */
    public function getValidationUpdate();
}
