<?php

namespace Alpaca\Crud\Utilities;

use Alpaca\User\Models\Permission;

trait PermissionCreator
{
    public function getPermissionsTypes()
    {
        return [
            'index',
            'show',
            'create',
            'edit',
            'delete',
        ];
    }

    public function createPermission($modulName, $permissionType)
    {
        $slugModule = strtolower($modulName);
        $slugModule = str_replace(' ', '_', $slugModule);
        $slugModule = $slugModule.'-'.$permissionType;

        return Permission::create([
            'name'         => $slugModule,
            'display_name' => $modulName.' '.$permissionType,
            'description'  => '',
        ]);
    }
}
