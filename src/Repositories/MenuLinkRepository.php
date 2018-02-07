<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Menu\MenuLinkWasCreated;
use Alpaca\Events\Menu\MenuLinkWasDeleted;
use Alpaca\Events\Menu\MenuLinkWasUpdated;
use Alpaca\Models\Category;
use Alpaca\Models\Menu;
use Alpaca\Models\MenuLink;
use Illuminate\Support\Facades\Validator;

class MenuLinkRepository
{

    /**
     * Create a page
     *
     * @param array $data
     * @return MenuLink
     */
    public function create(Menu $menu, array $data): MenuLink
    {
        Validator::make($data, [
            'text' => 'required|string|max:255',
            'position' => 'required|integer',
            'href' => 'required|string',
            'title' => 'nullable|string',
            'rel' => 'nullable|string',
            'target' => 'nullable|string',
        ])->validate();

        $link = $menu->links()->create($data);

        event(new MenuLinkWasCreated($menu, $link));

        return $link;
    }

    public function update(Menu $menu, MenuLink $link, array $data): MenuLink
    {
        Validator::make($data, [
            'text' => 'required|string|max:255',
            'position' => 'required|integer',
            'href' => 'required|string',
            'title' => 'nullable|string',
            'rel' => 'nullable|string',
            'target' => 'nullable|string',
        ])->validate();

        $link->update($data);

        event(new MenuLinkWasUpdated($menu, $link));

        return $link;
    }

    /**
     * @param Category $category
     * @return bool
     * @throws \Exception
     */
    public function delete(Menu $menu, MenuLink $link): bool
    {
        $link->delete();

        event(new MenuLinkWasDeleted($menu, $link));

        return true;
    }
}