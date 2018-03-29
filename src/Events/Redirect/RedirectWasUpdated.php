<?php

namespace Alpaca\Events\Redirect;

use Alpaca\Models\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RedirectWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Redirect
     */
    public $redirect;
    /**
     * @var User|null
     */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param Redirect $redirect
     */
    public function __construct(Redirect $redirect)
    {
        $this->user = Auth::user();
        $this->redirect = $redirect;
    }
}
