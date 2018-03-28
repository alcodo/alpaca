<?php

namespace Alpaca\Listeners\User;

use Alpaca\Exceptions\UserIsNotVerified;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\PasswordReset;

class IsUserVerified
{
    /**
     * Handle the event.
     *
     * @param Authenticated|PasswordReset $event
     * @return void
     * @throws UserIsNotVerified
     */
    public function handle($event)
    {
        if ($event->user->verified === false || $event->user->verified === 0) {
            throw new UserIsNotVerified();
        }
    }
}
