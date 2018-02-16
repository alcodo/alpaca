<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Menu;
use Laracasts\Flash\Flash;
use Alpaca\Models\MenuLink;
use Illuminate\Http\Request;
use Alpaca\Repositories\MenuLinkRepository;

class MenuLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu.add_link', ['only' => ['store']]);
        $this->middleware('permission:menu.edit_link', ['only' => ['update']]);
        $this->middleware('permission:menu.delete_link', ['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param MenuLinkRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuLinkRepository $repo, Menu $menu)
    {
        $repo->create($menu, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/menu');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Menu $menu
     * @param MenuLinkRepository $repo
     * @param MenuLink $link
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, MenuLinkRepository $repo, MenuLink $link)
    {
        $repo->update($menu, $link, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @param MenuLinkRepository $repo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Menu $menu, MenuLinkRepository $repo, MenuLink $link)
    {
        $repo->delete($menu, $link);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/menu');
    }
}
