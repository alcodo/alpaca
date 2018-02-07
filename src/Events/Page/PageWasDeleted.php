<?php

namespace Alpaca\Events\Page;

use Alpaca\Models\Page;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class PageWasDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Page
     */
    private $page;
    /**
     * @var User|null
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->user = Auth::user();
        $this->page = $page;
    }
}
