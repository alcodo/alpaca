<?php

namespace Alpaca\Events\User;

use Alpaca\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class UserWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var User
     */
    private $authUser;

    /**
     * Create a new event instance.
     *
     * @param User|null $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->authUser = Auth::user();
    }
}
