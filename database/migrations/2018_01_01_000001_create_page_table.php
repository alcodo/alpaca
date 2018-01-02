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
        Schema::create('al_pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('active');

            $table->string('path')->unique();
            $table->string('title');
            $table->text('teaser');
            $table->text('content');

            // user
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            // category
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('page_categories');

            // seo
            $table->string('html_title')->nullable();
            $table->string('meta_robots')->nullable();
            $table->string('meta_description')->nullable();

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
