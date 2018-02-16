<?php

namespace Alpaca\Events\Block;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BlockIsRequested
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
