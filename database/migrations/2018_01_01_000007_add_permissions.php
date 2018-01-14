<?php

use Alpaca\Support\Permission\PagePermission;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create(['name' => 'Registered user']);
        $adminRole = Role::create(['name' => 'Administrator']);

        // page
        foreach (PagePermission::getAllPermissions() as $name) {
            $perm = Permission::create([
                'name' => PagePermission::getModuleName() . '.' . $name,
//                'guard_name' => PagePermission::getModuleName(),
            ]);
            $adminRole->givePermissionTo($perm);
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
