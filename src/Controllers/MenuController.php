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

        $menus = Menu::with(['links' => function ($query) {
            $query->orderBy('position', 'ASC');
        }])
            ->orderBy('updated_at', 'DESC')->get();

        return view('alpaca::menu.index', compact('menus'));
    }

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

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/menu');
    }

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
        $repo->update($menu, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

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

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/menu');
    }
}
