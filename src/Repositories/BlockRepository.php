<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Block\BlockWasCreated;
use Alpaca\Events\Block\BlockWasDeleted;
use Alpaca\Events\Block\BlockWasUpdated;
use Alpaca\Models\Block;
use Alpaca\Models\Menu;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BlockRepository
{

    /**
     * Create a page
     *
     * @param array $data
     * @return Menu
     */
    public function create(array $data): Block
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'html' => 'nullable|string',

            // options
            'area' => 'required|string|max:255',
            'active' => 'required|boolean',
            'position' => 'required|integer',
            'exception_rule' => 'required|boolean',
            'exception' => 'nullable|string',

            // reference
            'user_id' => 'nullable|integer',
            'menu_id' => 'nullable|integer',
        ])->validate();

        $data['slug'] = SlugifyFacade::slugify($data['title']);

        $block = Block::create($data);

        event(new BlockWasCreated($block, Auth::user()));

        return $block;
    }

    public function update(Block $block, array $data): Block
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'html' => 'nullable|string',

            // options
            'area' => 'required|string|max:255',
            'active' => 'required|boolean',
            'position' => 'required|integer',
            'exception_rule' => 'required|boolean',
            'exception' => 'nullable|string',

            // reference
            'user_id' => 'nullable|integer',
            'menu_id' => 'nullable|integer',
        ])->validate();

        $data['slug'] = SlugifyFacade::slugify($data['title']);

        $block->update($data);

        event(new BlockWasUpdated($block, Auth::user()));

        return $block;
    }

    /**
     * @param Block $block
     * @return bool
     * @throws \Exception
     */
    public function delete(Block $block): bool
    {
        $block->delete();

        event(new BlockWasDeleted($block, Auth::user()));

        return true;
    }
}