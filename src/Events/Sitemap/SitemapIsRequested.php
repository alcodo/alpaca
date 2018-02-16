<?php

namespace Alpaca\Events\Sitemap;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SitemapIsRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Page $page
     * @param User|null $user
     */
    public function __construct()
    {
    }
}
