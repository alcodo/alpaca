<?php

use Illuminate\Database\Migrations\Migration;

class CreateMenuItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_menu_links', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('text');
            $table->integer('position');
            $table->string('href');
            $table->string('title');
            $table->string('rel');
            $table->string('target');

            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
