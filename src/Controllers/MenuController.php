<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Menu;
use Alpaca\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::menu.menu_index'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $menus = Menu::all();

        return view('alpaca::menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function create()
//    {
//        SEO::setTitle(trans('alpaca::menu.create_menu'));
//        SEO::metatags()->addMeta('robots', 'noindex,nofollow');
//
//        return view('alpaca::menu.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param MenuRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuRepository $repo)
    {
        $page = $repo->create($request->all());

        Flash::success(trans('alpaca::menu.menu_successfully_created'));

        return redirect('/backend/menu');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     * @return \Illuminate\Http\Response
     */
//    public function edit(Menu $menu)
//    {
//        SEO::setTitle(trans('alpaca::menu.edit_menu'));
//        SEO::metatags()->addMeta('robots', 'noindex,nofollow');
//
//        return view('alpaca::menu.edit', compact('menu'));
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Menu $menu
     * @param MenuRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, MenuRepository $repo)
    {
        $menu = $repo->update($menu, $request->all());


        Flash::success(trans('alpaca::menu.menu_successfully_updated'));

        return redirect('/backend/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @param MenuRepository $repo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Menu $menu, MenuRepository $repo)
    {
        $repo->delete($menu);

        Flash::success(trans('alpaca::menu.menu_successfully_deleted'));

        return redirect('/backend/menu');
    }
}
