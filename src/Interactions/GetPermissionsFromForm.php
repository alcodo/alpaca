<?php

namespace Alpaca\Interactions;

use Alpaca\Repositories\PermissionRepository;

class GetPermissionsFromForm
{
    protected $permissions = array();

    public function __construct()
    {
        $this->repo = new PermissionRepository();
    }

    /**
     * Transform formdata to module with permission key
     * Example: page.create_page
     *
     * @param $formData
     * @return $this
     */
    public function handle($formData)
    {

        foreach ($formData as $moduleName => $data) {

            if (is_array($data)) {


                foreach ($data as $permissionSlug => $value) {

                    $permissionKey = $moduleName . '.' . $permissionSlug;
                    $this->permissions[$permissionKey] = $value;

                }


            }

        }

        return $this;
    }

    /**
     * Return only active permssions
     *
     * @return mixed
     */
    public function getActivePermissions()
    {
        return collect($this->permissions)
            ->filter()
            ->map(function ($value, $permissionName) {

                return $this->repo->findOrCreate(['name' => $permissionName]);

            })
            ->all();
    }
}
