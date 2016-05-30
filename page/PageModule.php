<?php

use Alcodo\Crud\Permission\Permission;
use Alcodo\User\Models\Role;
use Alcodo\User\Models\User;
use Illuminate\Support\Facades\DB;

class PageModule
{
    /**
     * Install module
     *
     * @return void
     */
    public function install()
    {
        // Category
        alpacaFactory(\Alcodo\Page\Models\Category::class, 5)->create();

        // Page
        Page::create(array(
            'title' => 'Frontpage',
            'slug' => '/',
            'body' => '<p>Let us start to create a LaravelCMF...</p>',
            'html_title' => '',
            'meta_robots' => '',
            'meta_description' => '',
            'user_id' => '',
            'active' => 1,
        ));
    }

    /**
     * Remove module
     *
     * @return void
     */
    public function remove()
    {
        DB::table('categories')->delete();
        DB::table('pages')->delete();
    }
}