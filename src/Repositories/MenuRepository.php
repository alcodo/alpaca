<?php

namespace Alpaca\Repositories;

use Alpaca\Models\Menu;
use Alpaca\Models\Category;
use Alpaca\Events\Menu\MenuWasCreated;
use Alpaca\Events\Menu\MenuWasDeleted;
use Alpaca\Events\Menu\MenuWasUpdated;
use Illuminate\Support\Facades\Validator;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;

class MenuRepository
{
    /**
     * Create a page.
     *
     * @param array $data
     * @return Menu
     */
    public function create(array $data): Menu
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'class' => 'nullable|string',
        ])->validate();

        $data['slug'] = SlugifyFacade::slugify($data['title']);

        $menu = Menu::create($data);

        event(new MenuWasCreated($menu));

        return $menu;
    }

    public function update(Menu $menu, array $data): Menu
    {
        Validator::make($data, [
            'title' => 'required|string|max:255',
            'class' => 'nullable|string',
        ])->validate();

        $data['slug'] = SlugifyFacade::slugify($data['title']);

        $menu->update($data);

        event(new MenuWasUpdated($menu));

        return $menu;
    }

    /**
     * @param Category $category
     * @return bool
     * @throws \Exception
     */
    public function delete(Menu $menu): bool
    {
        $menu->delete();

        event(new MenuWasDeleted($menu));

        return true;
    }
}
