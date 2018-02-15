<?php

namespace Alpaca\Events\Image;

use Alpaca\Models\Image;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class ImageWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    public $user;
    /**
     * @var Image
     */
    public $image;

    /**
     * Create a new event instance.
     *
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->user = Auth::user();
        $this->image = $image;
    }
}
