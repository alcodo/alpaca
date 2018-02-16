<?php

namespace Alpaca\Events\Block;

use Alpaca\Models\Block;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BlockWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    public $user;
    /**
     * @var Block
     */
    public $block;

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
