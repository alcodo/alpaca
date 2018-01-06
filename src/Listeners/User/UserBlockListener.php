<?php

namespace Alpaca\Listeners\User;

use Response;
use Alpaca\Block\Models\Block;
use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Support\Facades\Auth;

class UserBlockListener
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
        if (Auth::check()) {
            return new Block([
                'active' => 1,
                'name' => 'User',
                'title' => 'User',
                'area' => 'right',
                'exception' => '',
                'range' => 0,
                'mobile_view' => 1,
                'desktop_view' => 1,
                'desktop_view_force' => 0,
                'html' => Response::view('core::userblock')->getContent(),
            ]);
        }
    }
}
