<?php

use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->string('filepath');

            $table->string('copyright_simple')->nullable();

            $table->string('copyright_author')->nullable();
            $table->string('copyright_title')->nullable();
            $table->string('copyright_source_url')->nullable();
            $table->string('copyright_license_url')->nullable();
            $table->string('copyright_license_tag')->nullable();
            $table->string('copyright_modification')->nullable();

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
        Schema::drop('images');
    }
}
