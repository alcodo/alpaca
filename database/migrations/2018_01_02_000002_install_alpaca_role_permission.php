<?php

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
        $repo->create(['name' => 'Registered user', 'slug' => 'registered']);
        $repo->create(['name' => 'Administrator']);

        // sync permission
        \Illuminate\Support\Facades\Artisan::call('alpaca:sync_permission');
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
        DB::table('permission_role')->truncate();
    }
}
