<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Menu\MenuWasCreated;
use Alpaca\Events\Menu\MenuWasDeleted;
use Alpaca\Events\Menu\MenuWasUpdated;
use Alpaca\Models\Category;
use Alpaca\Models\Menu;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuRepository
{

    /**
     * Create a page
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

        event(new MenuWasCreated($menu, Auth::user()));

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

        event(new MenuWasUpdated($menu, Auth::user()));

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

        event(new MenuWasDeleted($menu, Auth::user()));

        return true;
    }
}