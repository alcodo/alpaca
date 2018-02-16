<?php

namespace Alpaca\Events\Category;

use Alpaca\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CategoryWasUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User|null
     */
    public $user;
    /**
     * @var Category
     */
    public $category;

    /**
     * Create a new event instance.
     *
     * @param Category $category
     * @param User|null $user
     */
    public function __construct(Category $category)
    {
        $this->user = Auth::user();
        $this->category = $category;
    }
}
