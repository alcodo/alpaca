<?php

namespace Alpaca\Events\Role;

use Alpaca\Models\Role;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class RoleWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Role
     */
    private $role;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new event instance.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->user = Auth::user();
        $this->role = $role;
    }

}
