<?php

namespace Alpaca\Controllers;

use Alpaca\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:role.administer', ['only' => ['index']]);
        $this->middleware('permission:role.create', ['only' => ['store',]]);
        $this->middleware('permission:role.edit', ['only' => ['update',]]);
        $this->middleware('permission:role.delete', ['only' => ['destroy',]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::user.roles'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $roles = Role::get();
//        dd($roles->first()->permissions->count());

        return view('alpaca::role.index', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param RoleRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, RoleRepository $repo)
    {
        $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/role');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Role $role
     * @param RoleRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, RoleRepository $repo)
    {
        $repo->update($role, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @param RoleRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, RoleRepository $repo)
    {
        $repo->delete($role);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/role');
    }
}
