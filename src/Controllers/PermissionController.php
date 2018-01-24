<?php

namespace Alpaca\Controllers;

use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Repositories\PermissionRepository;
use Alpaca\Repositories\UserRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $input = $request->all();


        // transform
        $permissions = collect($input)
            ->filter(function ($value, $key) { // extract only permissions array
                return is_array($value);
            })
            ->map(function ($permissions, $module) { // transform array key

                $modulePerms = array();

                foreach ($permissions as $permissionName => $value) {

                    $modulePerms[$module . '.' . $permissionName] = $value;

                }

                return $modulePerms;
            })
            ->mapWithKeys(function ($item) { // merge array
                return $item;
            });

        // save
        $syncPermissions = $permissions->map(function ($value, $permissionName) use ($repo) {

            $permissionModel = $repo->findOrCreate(['name' => $permissionName]);

            if ($value == 0) {
                return null;
            }

            return $permissionModel;
        })->filter()
            ->values();

        // sync with role
        $role = Role::find($input['role_id']);
//        dd($syncPermissions);
//        $role->attachPermissions([1,2,3]);
        $role->syncPermissions($syncPermissions);
//        $role->attachPermissions($syncPermissions);
//        $role->attachPermission('page.edit_page');
//        $role->savePermissions($syncPermissions);


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
