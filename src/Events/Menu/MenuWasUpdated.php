<?php

namespace Alpaca\Events\Menu;

use Alpaca\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class MenuWasUpdated
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
