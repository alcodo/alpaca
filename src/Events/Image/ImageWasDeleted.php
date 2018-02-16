<?php

namespace Alpaca\Events\Image;

use Alpaca\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ImageWasDeleted
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
