<?php

namespace Alpaca\Controllers;

use Alpaca\Models\User;
use Alpaca\Repositories\UserRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::user.roles'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $roles = User::paginate(50);

        return view('alpaca::roles.index', compact('roles'));
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
