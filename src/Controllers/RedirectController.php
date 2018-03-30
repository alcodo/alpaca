<?php

namespace Alpaca\Controllers;

use Laracasts\Flash\Flash;
use Alpaca\Models\Redirect;
use Illuminate\Http\Request;
use Alpaca\Repositories\RedirectRepository;
use Artesaos\SEOTools\Facades\SEOTools as SEO;

class RedirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:redirect.administer', ['only' => ['index']]);
        $this->middleware('permission:redirect.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:redirect.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:redirect.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::redirect.redirect_index'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $redirects = Redirect::orderBy('updated_at', 'desc')->paginate(20);

        return view('alpaca::redirect.index', compact('redirects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param RedirectRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, RedirectRepository $repo)
    {
        $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/redirect');
    }

    /**
     * Display the specified resource.
     *
     * @param Redirect $redirect
     * @return void
     */
    public function show($redirectId)
    {
        $redirect = Redirect::findOrFail($redirectId);

        $repo = new RedirectRepository();
        $repo->addHit($redirect);

        return redirect($redirect->to, $redirect->code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Redirect $redirect
     * @param RedirectRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Redirect $redirect, RedirectRepository $repo)
    {
        $repo->update($redirect, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/redirect');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Redirect $redirect
     * @param RedirectRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Redirect $redirect, RedirectRepository $repo)
    {
        $repo->delete($redirect);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/redirect');
    }
}
