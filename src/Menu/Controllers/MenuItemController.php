<?php

namespace Alpaca\Menu\Controllers;

use Alpaca\Menu\Models\Item;
use Alpaca\Menu\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuItemController extends Controller
{
    public function create($slug)
    {
        return view('menu::item.form', compact('slug'));
    }

    public function store($slug, Request $request)
    {
        $validator = Validator::make($request->all(), Item::$validation);

        if ($validator->fails()) {
            return redirect(route('menu.item.create', $slug))
                ->withErrors($validator)
                ->withInput();
        }

        $menu = Menu::getSlugOrFail($slug);
        $item = $menu->items()->create($request->all());

        flashCreate($item, trans('menu::menu.menuitem'));

        return redirect(route('menu.show', $slug));
    }

    public function edit($slug, $id)
    {
        $menu = Menu::getSlugOrFail($slug);
        $item = $menu->items()->where('id', '=', $id)->first();
        $slug = $menu->slug;

        return view('menu::item.form', compact('item', 'slug'));
    }

    public function update($slug, $id, Request $request)
    {
        $validator = Validator::make($request->all(), Item::$validation);

        if ($validator->fails()) {
            return redirect(route('menu.item.edit', [$slug, $id]))
                ->withErrors($validator)
                ->withInput();
        }

        $menu = Menu::getSlugOrFail($slug);
        $item = $menu->items()->where('id', '=', $id)->first();

        $result = $item->update($request->all());

        flashUpdate($result, trans('menu::menu.menuitem'));

        return redirect(route('menu.show', $slug));
    }

    public function destroy($slug, $id)
    {
        $menu = Menu::getSlugOrFail($slug);
        $result = $menu->items()->destroy($id);

        flashDelete($result, trans('menu::menu.menuitem'));

        return redirect(route('menu.show', $slug));
    }
}
