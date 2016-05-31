<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->foreign('user_id')->references('id')->on('users');

            // category
            $table->string('category_slug')->unique()->nullable();
            $table->foreign('category_slug')->references('slug')->on('categories');

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
