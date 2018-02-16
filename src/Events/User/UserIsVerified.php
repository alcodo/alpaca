<?php

namespace Alpaca\Events\User;

use Alpaca\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserIsVerified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User|null $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
