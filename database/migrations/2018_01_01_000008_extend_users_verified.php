<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtendUsersVerified extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // TODO
//        if (!Schema::hasTable('users')) {
//
//            Schema::create('users', function (Blueprint $table) {
//                $table->increments('id');
//                $table->string('username')->unique();
//                $table->string('email')->unique();
//                $table->string('password');
//                $table->rememberToken();
//
//                // email verification
//                $table->tinyInteger('verified')->default(0);
//                $table->string('email_token', 18)->nullable();
//
//                $table->timestamps();
//            });
//
//        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('users');
    }
}
