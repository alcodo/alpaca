<?php

namespace Alpaca\Controllers;

use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Models\Role;
use Alpaca\Repositories\PermissionRepository;
use Alpaca\Repositories\UserRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::user.permissions'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $permissions = event(new PermissionsIsRequested());
        $roles = Role::get();
//        dd($permissions);
//        $permissions = Permission::get();

        return view('alpaca::permission.index', compact('permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param UserRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PermissionRepository $repo)
    {
        $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/permission');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Permission $permission
     * @param PermissionRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission, PermissionRepository $repo)
    {
        $repo->update($permission, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @param PermissionRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, PermissionRepository $repo)
    {
        $repo->delete($permission);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/permission');
    }
}
