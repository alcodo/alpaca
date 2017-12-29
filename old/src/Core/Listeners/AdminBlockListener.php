<?php

namespace Alpaca\Core\Listeners;

use Alpaca\Block\Models\Block;
use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Support\Facades\Auth;

class AdminBlockListener
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
     * @param  sitemap $event
     * @return void
     */
    public function handle()
    {
        if (Auth::check() && Auth::user() && Auth::user()->hasRole('admin')) {
            return new Block([
                'active' => 1,
                'name' => 'Administration',
                'title' => 'Administration',
                'area' => 'right',
                'exception' => '',
                'range' => 1,
                'mobile_view' => 1,
                'desktop_view' => 1,
                'desktop_view_force' => 1,
                'html' => view('core::adminblock')->render(),
            ]);
        }
    }
}