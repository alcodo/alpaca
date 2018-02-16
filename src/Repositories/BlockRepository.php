<?php

namespace Alpaca\Repositories;

use Alpaca\Models\Block;
use Alpaca\Events\Block\BlockWasCreated;
use Alpaca\Events\Block\BlockWasDeleted;
use Alpaca\Events\Block\BlockWasUpdated;
use Illuminate\Support\Facades\Validator;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;

class BlockRepository
{
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

        event(new BlockWasCreated($block));

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

        event(new BlockWasUpdated($block));

        return $block;
    }

    public function delete(Block $block): bool
    {
        $block->delete();

        event(new BlockWasDeleted($block));

        return true;
    }
}
