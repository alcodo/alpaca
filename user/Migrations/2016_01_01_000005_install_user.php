<?php

use Alcodo\User\Models\Role;
use Alcodo\User\Models\User;
use Illuminate\Database\Migrations\Migration;

class InstallUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::create([
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => 'admin',
        ]);


        // add admin role
        $adminRole = Role::where('name', 'admin')->first();
        $user->attachRole($adminRole);
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
