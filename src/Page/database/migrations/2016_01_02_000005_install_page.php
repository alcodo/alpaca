<?php

use Alpaca\Page\Models\Page;
use Illuminate\Database\Migrations\Migration;

class InstallPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Page::create([
            'title' => 'Frontpage',
            'slug' => '',
            'body' => '<p>Let us start to create a LaravelCMF...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'active' => 1,
        ]);
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
