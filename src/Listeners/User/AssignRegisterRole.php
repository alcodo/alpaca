<?php

namespace Alpaca\Listeners\User;

use Alpaca\Models\User;
use Alpaca\Repositories\UserRepository;

class AssignRegisterRole
{
    /**
     * Handle the event.
     *
     * @param $event
     * @return void
     * @throws \Exception
     */
    public function handle($event)
    {
        /** @var User $user */
        $user = $event->user;

        $repo = new UserRepository();
        $repo->syncRole('registered', $user);
    }
}
