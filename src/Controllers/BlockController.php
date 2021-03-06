<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Menu;
use Alpaca\Models\Block;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Alpaca\Repositories\BlockRepository;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class BlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:block.administer', ['only' => ['index']]);
        $this->middleware('permission:block.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:block.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:block.delete', ['only' => ['destroy']]);
    }

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

        return view('alpaca::block.index', compact('blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        SEO::setTitle(trans('alpaca::block.create_block'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $menues = Menu::orderBy('title', 'asc')->pluck('title', 'id');
        $menues->prepend(trans('alpaca::menu.no_menu'), '');

        return view('alpaca::block.create', compact('menues'));
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
        $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/block');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Block $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        SEO::setTitle(trans('alpaca::block.edit_block'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $menues = Menu::orderBy('title', 'asc')->pluck('title', 'id');
        $menues->prepend(trans('alpaca::menu.no_menu'), '');

        return view('alpaca::block.edit', compact('block', 'menues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Block $block
     * @param BlockRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block, BlockRepository $repo)
    {
        $repo->update($block, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/block');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Block $block
     * @param BlockRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block, BlockRepository $repo)
    {
        $repo->delete($block);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/block');
    }
}
