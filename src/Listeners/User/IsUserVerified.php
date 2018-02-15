<?php

namespace Alpaca\Listeners\User;

use Alpaca\Exceptions\UserIsNotVerified;
use Illuminate\Auth\Events\Authenticated;

class IsUserVerified
{
    /**
     * Handle the event.
     *
     * @param Authenticated $event
     * @return void
     * @throws UserIsNotVerified
     */
    public function handle(Authenticated $event)
    {

        if ($event->user->verified === false || $event->user->verified === 0) {

            throw new UserIsNotVerified();

        }

    }
}
