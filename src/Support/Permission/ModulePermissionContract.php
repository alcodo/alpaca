<?php

namespace Alpaca\Support\Permission;

interface ModulePermissionContract
{
    public static function getModuleName();

    public static function getAllPermissions();
}
