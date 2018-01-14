<?php

namespace Alpaca\Support\Permission;


class PagePermission implements ModulePermissionContract
{
    // name
    const MODULE = 'page';

    // fronted
    const VIEW = 'view_page';

    // backend
    const ADMINISTER = 'administer_page';
    const CREATE = 'create_page';
    const UPDATE = 'update_page';
    const DELETE = 'delete_page';

    static public function getModuleName()
    {
        return self::MODULE;
    }

    static public function getAllPermissions()
    {
        return [
            self::VIEW,
            self::ADMINISTER,
            self::CREATE,
            self::UPDATE,
            self::DELETE,
        ];
    }
}