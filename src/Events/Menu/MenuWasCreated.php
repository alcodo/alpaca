<?php

namespace Alpaca\Events\Menu;

use Alpaca\Models\Menu;
use Alpaca\User\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MenuWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var Menu
     */
    private $menu;

    /**
     * Create a new event instance.
     *
     * @param Menu $menu
     * @param User|null $user
     */
    public function __construct(Menu $menu, User $user = null)
    {
        $this->user = $user;
        $this->menu = $menu;
    }

}
