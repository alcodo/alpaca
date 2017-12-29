<?php

use Alpaca\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class AddDefaultRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        dump(Role::count());
//        Role::create([
//            'name'         => 'user',
//            'display_name' => 'User',
//            'description'  => 'Registered users',
//        ]);
//
//        Role::create([
//            'name'         => 'admin',
//            'display_name' => 'Admin',
//            'description'  => 'Administration users',
//        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        dump(Role::count());
//        DB::table('users')->delete();
//        Role::deleting();
        dump(Role::count());
    }
}
