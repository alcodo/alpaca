<?php

namespace Alpaca\Events\Image;

use Alpaca\Models\Image;
use Alpaca\User\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ImageWasDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    private $user;
    /**
     * @var Image
     */
    private $image;

    /**
     * Create a new event instance.
     *
     * @param Image $image
     * @param User|null $user
     */
    public function __construct(Image $image, User $user = null)
    {
        $this->image = $image;
        $this->user = $user;
    }
}
