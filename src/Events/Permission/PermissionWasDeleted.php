<?php

namespace Alpaca\Events\Permission;

use Alpaca\Models\Permission;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class PermissionWasDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Permission
     */
    public $permission;
    /**
     * @var User
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Permission $permission
     */
    public function __construct(Permission $permission)
    {
        $this->user = Auth::user();
        $this->permission = $permission;
    }

}
