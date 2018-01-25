<?php

namespace Alpaca\Interactions;

use Alpaca\Repositories\PermissionRepository;

class CheckAllPermissionsExists
{

    public function __construct()
    {
        $this->repo = new PermissionRepository();
    }

    public function handle($data)
    {

        foreach ($data as $permissionModule) {

            foreach ($permissionModule->permissions as $permission) {

                $permissionKey = $permissionModule->slug . '.' . $permission->slug;

                $this->repo->findOrCreate(['name' => $permissionKey]);

            }

        }

    }
}
