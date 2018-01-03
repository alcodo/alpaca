<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Block;
use Alpaca\Models\Menu;
use Alpaca\Repositories\BlockRepository;
use Alpaca\Repositories\MenuRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::block.block_index'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $blocks = Block::with(['menu', 'menu.links' => function ($query) {
            $query->orderBy('position', 'ASC');
        }])
            ->orderBy('updated_at', 'DESC')->get();

        return view('alpaca::block.index', compact('block'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param BlockRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BlockRepository $repo)
    {
        $page = $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/block');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Menu $menu
     * @param BlockRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu, BlockRepository $repo)
    {
        $repo->update($menu, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/block');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @param MenuRepository $repo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Menu $menu, BlockRepository $repo)
    {
        $repo->delete($menu);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/block');
    }
}
