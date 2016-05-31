<?php

use Alpaca\Crud\Utilities\PermissionCreator;
use Alpaca\User\Models\Permission;
use Alpaca\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class PermissionUser extends Migration
{
    use PermissionCreator;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add permission the admin role
        $adminRole = Role::where('name', 'admin')->first();

        // user
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('User', $type);
            $adminRole->attachPermission($permission);
        }

        // role
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Role', $type);
            $adminRole->attachPermission($permission);
        }

        // Permission
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Permission', $type);
            $adminRole->attachPermission($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
