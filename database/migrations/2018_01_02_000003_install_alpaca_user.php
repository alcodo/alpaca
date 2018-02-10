<?php

use Alpaca\Models\Role;
use Illuminate\Database\Migrations\Migration;

class InstallAlpacaUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $repo = new \Alpaca\Repositories\UserRepository();
        $user = $repo->create([
            'name' => 'alpaca',
            'email' => 'admin@alpaca.com',
            'password' => 'alpaca',
            'password_confirmation' => 'alpaca',
        ]);
        $adminRole = Role::whereSlug('administrator')->first();
        $adminRole->users()->sync($user);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->truncate();
    }
}
