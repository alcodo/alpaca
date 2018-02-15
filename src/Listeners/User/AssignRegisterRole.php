<?php

namespace Alpaca\Listeners\User;

use Alpaca\Models\User;
use Illuminate\Auth\Events\Registered;
use Alpaca\Notifications\VerifyAccount;
use Illuminate\Support\Facades\Notification;
use Alpaca\Repositories\RoleRepository;

class AssignRegisterRole
{

    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     */
    public function handle($event)
    {

        /** @var User $user */
        $user = $event->user;

        $repo = new RoleRepository();
        $repo->syncRole('registered', $user);

    }
}
