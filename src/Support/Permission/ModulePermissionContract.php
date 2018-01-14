<?php

namespace Alpaca\Support\Permission;

interface ModulePermissionContract
{

    public function getModuleName();

    public function getAllPermissions();

}