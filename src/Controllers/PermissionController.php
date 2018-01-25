<?php

namespace Alpaca\Controllers;

use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Interactions\CheckAllPermissionsExists;
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

        // check that all keys exists
        $check = new CheckAllPermissionsExists();
        $check->handle($permissions);

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
        $role->syncPermissions($syncPermissions);


        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/permission');
    }
}
