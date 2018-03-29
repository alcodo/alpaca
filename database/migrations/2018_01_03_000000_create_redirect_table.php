<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedirectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from')->unique();
            $table->string('to');
            $table->smallInteger('code')->unsigned();
            $table->integer('hits')->unsigned()->nullable();

            $table->timestamps();
        });

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
        Schema::drop('redirects');
    }
}
