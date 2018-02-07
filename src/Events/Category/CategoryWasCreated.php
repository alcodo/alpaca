<?php

namespace Alpaca\Events\Category;

use Alpaca\Models\Category;
use Alpaca\Models\Page;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class CategoryWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var Category
     */
    private $category;

    /**
     * Create a new event instance.
     *
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->user = Auth::user();
        $this->category = $category;
    }

}
