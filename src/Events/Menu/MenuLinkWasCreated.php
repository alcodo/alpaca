<?php

namespace Alpaca\Events\Menu;

use Alpaca\Models\Menu;
use Alpaca\Models\MenuLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class MenuLinkWasCreated
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
     * @var MenuLink
     */
    public $link;

    /**
     * Create a new event instance.
     *
     * @param Menu $menu
     * @param MenuLink $link
     */
    public function __construct(Menu $menu, MenuLink $link)
    {
        $this->user = Auth::user();
        $this->menu = $menu;
        $this->link = $link;
    }
}
