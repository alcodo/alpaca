<?php

namespace Alpaca\Block\Controllers;

use Alpaca\Block\Models\Block;
use Alpaca\Menu\Models\Menu;
use Alpaca\Core\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlockController extends Controller
{
    /**
     * Display all block.
     *
     * @return Response
     */
    public function index()
    {
        $blocks = Block::orderBy('updated_at', 'DESC')->get();

        return view('block::list', compact('blocks'));
    }

    /**
     * Create a block.
     *
     * @return Response
     */
    public function create()
    {
        $menus = Menu::select();

        return view('block::form', compact('menus'));
    }

    /**
     * Store a block.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Block::$validation);

        if ($validator->fails()) {
            return redirect(route('block.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $values = $request->all();
        $values['range'] = (int) $values['range'];

        $block = Block::create($values);

        flashCreate($block, trans('block::block.block'));

        return redirect(route('block.index'));
    }

    /**
     * Show a block.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        abort(501);
    }

    /**
     * Edit a block.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $block = Block::findOrFail($id);
        $menus = Menu::select();

        return view('block::form', compact('block', 'menus'));
    }

    /**
     * Update a block.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), Block::$validation);

        if ($validator->fails()) {
            return redirect(route('block.edit'))
                ->withErrors($validator)
                ->withInput();
        }

        $values = $request->all();
        $values['range'] = (int) $values['range'];

        $block = Block::findOrFail($id);
        $result = $block->update($values);

        flashUpdate($result, trans('block::block.block'));

        return redirect(route('block.index'));
    }

    /**
     * Remove a block.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $result = Block::destroy($id);
        flashDelete($result, trans('block::block.block'));

        return redirect(route('block.index'));
    }
}
