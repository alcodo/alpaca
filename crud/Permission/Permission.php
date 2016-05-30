<?php

namespace Alcodo\Crud\Permission;

class Permission implements PermissionContract
{
    /**
     * @var string
     */
    private $index;
    /**
     * @var string
     */
    private $show;
    /**
     * @var string
     */
    private $create;
    /**
     * @var string
     */
    private $edit;
    /**
     * @var string
     */
    private $destroy;
    /**
     * @var string
     */
    private $user;

    /**
     * Permission constructor.
     *
     * @param string $index
     * @param string $show
     * @param string $create
     * @param string $edit
     * @param string $destroy
     */
    public function __construct($index = null,
                                $show = null,
                                $create = null,
                                $edit = null,
                                $destroy = null)
    {
        $this->index = $index;
        $this->show = $show;
        $this->create = $create;
        $this->edit = $edit;
        $this->destroy = $destroy;
        $this->user = request()->user();
    }

    /**
     * Check permission for index.
     *
     * @return bool
     */
    public function canIndex()
    {
        return $this->can($this->index);
    }

    /**
     * Check permission for show.
     *
     * @return bool
     */
    public function canShow()
    {
        return $this->can($this->show);
    }

    /**
     * Check permission for create.
     *
     * @return bool
     */
    public function canCreate()
    {
        return $this->can($this->create);
    }

    /**
     * Check permission for edit.
     *
     * @return bool
     */
    public function canEdit()
    {
        return $this->can($this->edit);
    }

    /**
     * Check permission for destroy.
     *
     * @return bool
     */
    public function canDestroy()
    {
        return $this->can($this->destroy);
    }

    /**
     * Check permission.
     *
     * @return bool
     */
    protected function can($permissionName)
    {
        if (is_null($permissionName)) {
            // everybody have access
            return true;
        }

        if ($this->user === null) {
            return false;
            // user is not loged in
            abort(403, trans('crud::crud.unauthorized_access'));
        }

        if ($this->user->can($permissionName) === false) {
            return false;
            // no permission
            abort(403, trans('crud::crud.unauthorized_access'));
        }

        return true;
    }

    /**
     * Return a array with booleans about all permissions.
     *
     * @return array
     */
    public function getAllPermissions()
    {
        return [
            'index'   => $this->canIndex(),
            'show'    => $this->canShow(),
            'create'  => $this->canCreate(),
            'edit'    => $this->canEdit(),
            'destroy' => $this->canDestroy(),
        ];
    }

    /**
     * Check permission for index or fail.
     *
     * @return bool
     */
    public function canIndexOrFail()
    {
        return $this->isFail(
            $this->canIndex()
        );
    }

    /**
     * Check permission for show or fail.
     *
     * @return bool
     */
    public function canShowOrFail()
    {
        return $this->isFail(
            $this->canShow()
        );
    }

    /**
     * Check permission for create or fail.
     *
     * @return bool
     */
    public function canCreateOrFail()
    {
        return $this->isFail(
            $this->canCreate()
        );
    }

    /**
     * Check permission for edit or fail.
     *
     * @return bool
     */
    public function canEditOrFail()
    {
        return $this->isFail(
            $this->canEdit()
        );
    }

    /**
     * Check permission for destroy or fail.
     *
     * @return bool
     */
    public function canDestroyOrFail()
    {
        return $this->isFail(
            $this->canDestroy()
        );
    }

    /**
     * Fail wrapper.
     *
     * @return bool
     */
    protected function isFail($status)
    {
        if ($status === false) {
            abort(403, trans('crud::crud.unauthorized_access'));
        }

        return true;
    }
}
