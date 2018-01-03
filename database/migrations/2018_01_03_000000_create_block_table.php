<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('al_blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active');
            $table->string('area', 20)->index();

            $table->string('name');
            $table->string('title')->nullable();
            $table->tinyInteger('range')->unsigned();
            $table->boolean('mobile_view')->default(1);
            $table->boolean('desktop_view')->default(1);
            $table->boolean('desktop_view_force')->default(0);

            $table->text('html');
            $table->boolean('exception_rule');
            $table->mediumText('exception');

            $table->integer('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')->references('id')->on('al_menus')->onDelete('cascade');

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
        Schema::drop('al_blocks');
    }
}
