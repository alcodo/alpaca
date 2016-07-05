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

            // category
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            // topic
            $table->integer('topic_id')->unsigned()->nullable();
            $table->foreign('topic_id')->references('id')->on('topics');

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
