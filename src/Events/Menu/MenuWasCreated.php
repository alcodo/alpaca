<?php

namespace Alpaca\Events\Menu;

use Alpaca\Models\Menu;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class MenuWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    public $user;
    /**
     * @var Menu
     */
    public $menu;

    /**
     * Create a new event instance.
     *
     * @param Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->user = Auth::user();
        $this->menu = $menu;
    }

}
