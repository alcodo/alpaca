<?php

namespace Alpaca\Events\Permission;

use Alpaca\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PermissionWasCreated
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
