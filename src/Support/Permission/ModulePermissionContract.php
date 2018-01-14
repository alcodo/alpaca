<?php

namespace Alpaca\Support\Permission;

interface ModulePermissionContract
{

    static public function getModuleName();

    static public function getAllPermissions();

}