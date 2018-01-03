<?php

namespace Alpaca\Events\Block;

use Alpaca\Models\Block;
use Alpaca\User\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BlockWasUpdated
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
     * @param User|null $user
     */
    public function __construct(Block $block, User $user = null)
    {
        $this->user = $user;
        $this->block = $block;
    }
}
