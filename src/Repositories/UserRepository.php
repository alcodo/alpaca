<?php

namespace Alpaca\Repositories;


class UserRepository
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

    public function delete(Block $block): bool
    {
        $block->delete();

        event(new BlockWasDeleted($block, Auth::user()));

        return true;
    }

}