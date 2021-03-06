<?php

use Alpaca\Models\Block;
use Illuminate\Database\Migrations\Migration;

class InstallAlpacaMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $menuRepo = new \Alpaca\Repositories\MenuRepository();

        // menu
        $menu = $menuRepo->create(['title' => 'Navigation']);

        // links
        $linkRepo = new \Alpaca\Repositories\MenuLinkRepository();
        $linkRepo->create($menu, [
            'text' => 'Home',
            'position' => 0,
            'href' => '/',
        ]);
        $linkRepo->create($menu, [
            'text' => 'Sitemap',
            'position' => 10,
            'href' => '/sitemap',
        ]);
        $linkRepo->create($menu, [
            'text' => 'Contact',
            'position' => 11,
            'href' => '/contact',
        ]);

        // block
        Block::create([
            'title' => 'Navigation',
            'slug' => 'navigation',
            'html' => '',

            // options
            'area' => 'right',
            'active' => true,
            'position' => 1,
            'exception_rule' => Block::EXCEPTION_EXCLUDE,
            'exception' => 'login
register
password/reset',

            'menu_id' => $menu->id,
            'user_id' => null,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('menus')->truncate();
        DB::table('menu_links')->truncate();
        DB::table('blocks')->truncate();
    }
}
