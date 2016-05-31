<?php

namespace Alpaca\Crud\Permission;

interface PermissionContract
{
    /**
     * Check permission for index.
     *
     * @return bool
     */
    public function canIndex();

    /**
     * Check permission for show.
     *
     * @return bool
     */
    public function canShow();

    /**
     * Check permission for create.
     *
     * @return bool
     */
    public function canCreate();

    /**
     * Check permission for edit.
     *
     * @return bool
     */
    public function canEdit();

    /**
     * Check permission for destroy.
     *
     * @return bool
     */
    public function canDestroy();

    /**
     * Return a array with booleans about all permissions.
     *
     * @return array
     */
    public function getAllPermissions();

    /**
     * Check permission for index or fail.
     *
     * @return bool
     */
    public function canIndexOrFail();

    /**
     * Check permission for show or fail.
     *
     * @return bool
     */
    public function canShowOrFail();

    /**
     * Check permission for create or fail.
     *
     * @return bool
     */
    public function canCreateOrFail();

    /**
     * Check permission for edit or fail.
     *
     * @return bool
     */
    public function canEditOrFail();

    /**
     * Check permission for destroy or fail.
     *
     * @return bool
     */
    public function canDestroyOrFail();
}
