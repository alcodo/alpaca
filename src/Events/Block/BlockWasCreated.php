<?php

namespace Alpaca\Events\Block;

use Alpaca\Models\Block;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class BlockWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var Block
     */
    private $block;

    /**
     * Create a new event instance.
     *
     * @param Block $block
     */
    public function __construct(Block $block)
    {
        $this->user = Auth::user();
        $this->block = $block;
    }

}
