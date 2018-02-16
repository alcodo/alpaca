<?php

namespace Alpaca\Events\Role;

use Alpaca\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RoleWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Role
     */
    public $role;
    /**
     * @var User
     */
    public $user;

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
