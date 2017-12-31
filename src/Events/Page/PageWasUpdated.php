<?php

namespace Alpaca\Events\Page;

use Alpaca\Models\Page;
use Alpaca\User\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PageWasUpdated
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
     * @param User|null $user
     */
    public function __construct(Page $page, User $user = null)
    {
        $this->page = $page;
        $this->user = $user;
    }
}
