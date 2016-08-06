<?php

namespace Alpaca\Core\Listeners;

use Alpaca\Block\Models\Block;
use Alpaca\Sitemap\Models\Sitemap;
use Illuminate\Support\Facades\Auth;
use Response;

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
                'range' => 0,
                'html' => Response::view('core::adminblock')->getContent()
            ]);

        }
    }
}
