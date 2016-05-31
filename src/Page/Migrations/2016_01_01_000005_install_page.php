<?php

use Alpaca\Page\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class InstallPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Page::create(array(
            'title' => 'Frontpage',
            'slug' => '',
            'body' => '<p>Let us start to create a LaravelCMF...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'user_id' => '',
            'active' => 1,
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('pages')->truncate();
    }
}
