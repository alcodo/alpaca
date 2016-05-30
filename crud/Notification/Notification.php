<?php

namespace Alcodo\Crud\Notification;

use Alcodo\Crud\Controllers\CrudContract;
use Laracasts\Flash\Flash;

class Notification implements NotificationContract
{
    protected $crudController;

    public function __construct(CrudContract $controller)
    {
        $this->crudController = $controller;
    }

    /**
     * Creates a store alert.
     *
     * @param bool $status
     *
     * @return void
     */
    public function store(bool $status)
    {
        $type = $this->crudController->getSingularModelName();

        if ($status) {
            $msg = trans('crud::crud.created_successful', ['type' => $type]);
            Flash::success($msg);
        } else {
            $msg = trans('crud::crud.created_error', ['type' => $type]);
            Flash::error($msg);
        }
    }

    /**
     * Creates a updated alert.
     *
     * @param bool $status
     *
     * @return void
     */
    public function updated(bool $status)
    {
        $type = $this->crudController->getSingularModelName();

        if ($status) {
            $msg = trans('crud::crud.updated_successful', ['type' => $type]);
            Flash::success($msg);
        } else {
            $msg = trans('crud::crud.updated_error', ['type' => $type]);
            Flash::error($msg);
        }
    }

    /**
     * Creates a destroy alert.
     *
     * @param bool $status
     *
     * @return void
     */
    public function destroy(bool $status)
    {
        $type = $this->crudController->getSingularModelName();

        if ($status) {
            $msg = trans('crud::crud.destroyed_successful', ['type' => $type]);
            Flash::success($msg);
        } else {
            $msg = trans('crud::crud.destroyed_error', ['type' => $type]);
            Flash::error($msg);
        }
    }
}
