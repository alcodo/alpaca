<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active');
            $table->string('area', 10)->index();

            $table->string('name');
            $table->tinyInteger('range')->unsigned();

            $table->text('html');
            $table->mediumText('exception');

//            $table->integer('menu_id')->unsigned()->index();
//            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');

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
        Schema::drop('blocks');
    }
}
