<?php

namespace Alpaca\Listeners;

use Alpaca\Models\Menu;
use Alpaca\Models\Block;
use Alpaca\Models\MenuLink;
use Illuminate\Support\Facades\Auth;

class AlpacaBlockListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @return Block
     */
    public function handle()
    {
        // user is not logged in
        if (Auth::check() === false) {
            return;
        }

        $block = new Block([
            'title' => 'Alpaca administration',
            'slug' => 'alpaca-administration',
            'html' => '',

            // options
            'area' => 'right',
            'active' => true,
            'position' => 1,
            'exception_rule' => true,
            'exception' => '',

            'menu_id' => null,
            'user_id' => null,
        ]);

        $block->menu = new Menu([
            'title' => 'nav',
        ]);
        $block->menu->links = collect();

        /**
         * Add permission links.
         */
        $user = Auth::user();
        if ($user->can('user.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Page', 'title' => 'Page administration', 'href' => '/backend/page'])
            );
        }

        if ($user->can('category.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Category', 'title' => 'Category administration', 'href' => '/backend/category'])
            );
        }

        if ($user->can('menu.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Menu', 'title' => 'Menu administration', 'href' => '/backend/menu'])
            );
        }

        if ($user->can('block.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Block', 'title' => 'Block administration', 'href' => '/backend/block'])
            );
        }

        if ($user->can('user.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'User', 'title' => 'User administration', 'href' => '/backend/user'])
            );
        }

        if ($user->can('role.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Roles', 'title' => 'Roles administration', 'href' => '/backend/role'])
            );
        }

        if ($user->can('permission.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Permission', 'title' => 'Permission administration', 'href' => '/backend/permission'])
            );
        }

        if ($user->can('image.administer')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'Image', 'title' => 'Image administration', 'href' => '/backend/image'])
            );
        }

        if ($user->can('emailtemplate.show_template')) {
            $block->menu->links->push(
                new MenuLink(['text' => 'E-Mail Templates', 'title' => 'E-Mail Templates', 'href' => '/backend/email-template'])
            );
        }

        if ($block->menu->links->isEmpty()) {
            return;
        }

        return $block;
    }
}
