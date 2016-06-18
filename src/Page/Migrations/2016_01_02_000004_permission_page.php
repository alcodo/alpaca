<?php

use Alpaca\Crud\Utilities\PermissionCreator;
use Alpaca\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class PermissionPage extends Migration
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

        // page
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Page', $type);
            $adminRole->attachPermission($permission);
        }

        // topic
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Topic', $type);
            $adminRole->attachPermission($permission);
        }

        // category
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Category', $type);
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
