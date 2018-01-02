<?php

namespace Alpaca\Events\Menu;

use Alpaca\Models\Menu;
use Alpaca\Models\MenuLink;
use Alpaca\User\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MenuLinkWasUpdated
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
     * @var MenuLink
     */
    private $link;

    /**
     * Create a new event instance.
     *
     * @param Menu $menu
     * @param MenuLink $link
     * @param User|null $user
     */
    public function __construct(Menu $menu, MenuLink $link, User $user = null)
    {
        $this->menu = $menu;
        $this->link = $link;
        $this->user = $user;
    }
}
