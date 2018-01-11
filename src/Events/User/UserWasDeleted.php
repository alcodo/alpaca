<?php

namespace Alpaca\Events\User;

use Alpaca\User\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserWasDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var User
     */
    private $userWhichWasChanged;

    /**
     * Create a new event instance.
     *
     * @param User $userWhichWasChanged
     * @param User|null $user
     */
    public function __construct(User $userWhichWasChanged, User $user = null)
    {
        $this->user = $user;
        $this->userWhichWasChanged = $userWhichWasChanged;
    }
}
