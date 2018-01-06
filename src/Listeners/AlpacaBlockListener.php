<?php

namespace Alpaca\Listeners;

use Alpaca\Models\Block;
use Alpaca\Models\Menu;
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
//        if (Auth::check() && Auth::user() && Auth::user()->hasRole('admin')) {
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
            'title' => 'fodsfsfo',
        ]);

        $block->menu->links = collect([
            new MenuLink(['text' => 'Page', 'title' => 'Page administration', 'href' => '/backend/page',]),
            new MenuLink(['text' => 'Category', 'title' => 'Category administration', 'href' => '/backend/category',]),
            new MenuLink(['text' => 'Menu', 'title' => 'Menu administration', 'href' => '/backend/menu',]),
            new MenuLink(['text' => 'Block', 'title' => 'Block administration', 'href' => '/backend/block',]),
            new MenuLink(['text' => 'E-Mail Templates', 'title' => 'E-Mail Templates', 'href' => '/backend/email-template',]),
            new MenuLink(['text' => 'Contact', 'title' => 'Contact', 'href' => '/contact',]),
        ]);

        return $block;
//        }
    }
}
