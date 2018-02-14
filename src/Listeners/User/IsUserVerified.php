<?php

namespace Alpaca\Listeners\User;

use Alpaca\Exceptions\UserIsNotVerified;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        if ($event->user->verified === false) {

            throw new UserIsNotVerified();

        }
    }
}
