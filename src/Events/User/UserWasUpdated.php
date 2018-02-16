<?php

namespace Alpaca\Events\User;

use Alpaca\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    public $user;
    /**
     * @var User
     */
    public $authUser;

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
