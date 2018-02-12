<?php

namespace Alpaca\Controllers;

use Alpaca\Events\Permission\PermissionsIsRequested;
use Alpaca\Interactions\CheckAllPermissionsExists;
use Alpaca\Interactions\GetPermissionsFromForm;
use Alpaca\Models\Role;
use Alpaca\Repositories\PermissionRepository;
use Alpaca\Repositories\UserRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:permission.administer', ['only' => ['index']]);
        $this->middleware('permission:permission.edit', ['only' => ['store',]]);
    }

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
     * @param PermissionRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PermissionRepository $repo)
    {
        // prepare form
        $transform = new GetPermissionsFromForm();
        $syncPermissions = $transform->handle($request->all())->getActivePermissions();

        $role = Role::find($request->get('role_id'));
        $repo->attachPermissionsToRole($role, $syncPermissions);

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/permission');
    }
}
