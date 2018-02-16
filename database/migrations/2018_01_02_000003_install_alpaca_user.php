<?php

use Alpaca\Repositories\UserRepository;
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
            'verified' => '1',
        ]);

        $repo = new UserRepository();
        $repo->syncRole('administrator', $user);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->truncate();
        DB::table('role_user')->truncate();
    }
}
