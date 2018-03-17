<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Role;
use Alpaca\Models\User;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Alpaca\Repositories\UserRepository;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user.administer', ['only' => ['index']]);
        $this->middleware('permission:user.create', ['only' => ['store']]);
        $this->middleware('permission:user.edit', ['only' => ['update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::user.users'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $users = User::with('roles')->orderByDesc('id')->paginate(30);
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');

        return view('alpaca::user.index', compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param UserRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserRepository $repo)
    {
        $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @param UserRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, UserRepository $repo)
    {
        $repo->update($user, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param UserRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UserRepository $repo)
    {
        $repo->delete($user);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/user');
    }
}
