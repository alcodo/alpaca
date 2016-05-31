<?php

use Alpaca\Crud\Utilities\PermissionCreator;
use Alpaca\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class PermissionBlock extends Migration
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

        // block
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Block', $type);
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
