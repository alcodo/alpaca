<?php

namespace Alpaca\Listeners\User;

use Alpaca\Exceptions\UserIsNotVerified;
use Alpaca\Repositories\UserRepository;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\PasswordReset;

class VerifyUser
{
    /**
     * Handle the event.
     *
     * @param PasswordReset $event
     * @return void
     * @throws UserIsNotVerified
     */
    public function handle($event)
    {
        if ($event->user->verified === false || $event->user->verified === 0) {
            $repo = new UserRepository();
            $repo->verifyUser($event->user);
        }
    }
}
