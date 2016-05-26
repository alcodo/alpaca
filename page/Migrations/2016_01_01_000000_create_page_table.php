<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');

            // seo
            $table->string('html_title');
            $table->string('meta_robots');
            $table->string('meta_description');

            // user
            $table->integer('user_id')->unsigned()->index();
//            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');

            // category
            $table->integer('category_id')->unsigned()->index();
//            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::drop('pages');
    }

}
