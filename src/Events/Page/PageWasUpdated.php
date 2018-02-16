<?php

namespace Alpaca\Events\Page;

use Alpaca\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PageWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Page
     */
    public $page;
    /**
     * @var User|null
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Page $page
     * @param User|null $user
     */
    public function __construct(Page $page)
    {
        $this->user = Auth::user();
        $this->page = $page;
    }
}
