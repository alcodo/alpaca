<?php

use Illuminate\Database\Migrations\Migration;

class InstallCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        alpacaFactory(\Alpaca\Page\Models\Category::class, 3)->create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->delete();
    }
}
