<?php

use Alpaca\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class InstallRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name'         => 'user',
            'display_name' => 'User',
            'description'  => 'Registered users',
        ]);

        Role::create([
            'name'         => 'admin',
            'display_name' => 'Admin',
            'description'  => 'Administration users',
        ]);
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
