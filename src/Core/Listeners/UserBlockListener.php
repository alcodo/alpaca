<?php

namespace Alpaca\Core\Listeners;

use Alpaca\Block\Models\Block;
use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Support\Facades\Auth;
use Response;

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
                'html' => Response::view('core::userblock')->getContent(),
            ]);
        }
    }
}
