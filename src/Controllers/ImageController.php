<?php

namespace Alpaca\Controllers;

use Alpaca\Models\Image;
use Alpaca\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools as SEO;
use Laracasts\Flash\Flash;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle(trans('alpaca::image.images'));
        SEO::metatags()->addMeta('robots', 'noindex,nofollow');

        $images = Image::get();

        return view('alpaca::image.index', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ImageRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ImageRepository $repo)
    {
        $repo->create($request->all());

        Flash::success(trans('alpaca::alpaca.successfully_created'));

        return redirect('/backend/image');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Image $image
     * @param ImageRepository $repo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image, ImageRepository $repo)
    {
        $repo->update($image, $request->all());

        Flash::success(trans('alpaca::alpaca.successfully_updated'));

        return redirect('/backend/image');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @param ImageRepository $repo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Image $image, ImageRepository $repo)
    {
        $repo->delete($image);

        Flash::success(trans('alpaca::alpaca.successfully_deleted'));

        return redirect('/backend/image');
    }
}
