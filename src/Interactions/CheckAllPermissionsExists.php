<?php

namespace Alpaca\Interactions;

use Alpaca\Repositories\PermissionRepository;

class CheckAllPermissionsExists
{
    protected $allPermissions = array();

    public function __construct()
    {
        $this->repo = new PermissionRepository();
    }

    /**
     * Check that every permission exists
     *
     * @param $data
     */
    public function handle($data)
    {

        foreach ($data as $permissionModule) {

            foreach ($permissionModule->permissions as $permission) {

                $this->allPermissions[] = $this->repo->findOrCreate([
                    'name' => $permission->name,
                    'slug' => $permissionModule->slug . '.' . $permission->slug,
                ]);

            }

        }

        return $this->allPermissions;

    }
}
