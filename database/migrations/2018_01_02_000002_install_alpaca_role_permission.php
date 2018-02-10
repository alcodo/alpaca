<?php

use Alpaca\Models\Role;
use Illuminate\Database\Migrations\Migration;

class InstallAlpacaRolePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $repo = new \Alpaca\Repositories\RoleRepository();
        $repo->create(['name' => 'Guest']);
        $repo->create(['name' => 'Registered user']);
        $adminRole = $repo->create(['name' => 'Administrator']);

        // create all possible permissions
        $permissions = event(new \Alpaca\Events\Permission\PermissionsIsRequested());
        $check = new \Alpaca\Interactions\CheckAllPermissionsExists();
        $allPermissions = $check->handle($permissions);

        // attach all permissions the admin role
        $ids = collect($allPermissions)->pluck('id')->all();
        $adminRole->permissions()->sync($ids);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
    }
}
