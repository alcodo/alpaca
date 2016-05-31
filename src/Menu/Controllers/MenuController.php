<?php

namespace Alcodo\Menu\Controllers;

use Alcodo\Menu\Models\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        //        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $menus = Menu::orderBy('updated_at', 'DESC')->get();

        return view('menu::list', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('menu::form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Menu::$validation);

        if ($validator->fails()) {
            return redirect(route('menu.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $block = Menu::create($request->all());

        flashCreate($block, trans('menu::menu.menu'));

        return redirect(route('menu.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug)
    {
        $menu = Menu::getSlugOrFail($slug);

        return view('menu::show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('menu::form', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), Menu::$validation);

        if ($validator->fails()) {
            return redirect(route('menu.edit'))
                ->withErrors($validator)
                ->withInput();
        }

        $block = Menu::findOrFail($id);
        $result = $block->update($request->all());

        flashUpdate($result, trans('menu::menu.menu'));

        return redirect(route('menu.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $result = Menu::destroy($id);
        flashDelete($result, trans('menu::menu.menu'));

        return redirect(route('menu.index'));
    }
}
