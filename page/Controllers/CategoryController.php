<?php namespace Alcodo\Page\Controllers;

use Alcodo\Page\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * List all pictures
     *
     * @return Response
     */
    public function index()
    {
        $entries = Category::orderBy('name', 'ASC')->get();
        return view('page::category.list', compact('entries'));
    }

    /**
     * Create form
     *
     * @return Response
     */
    public function create()
    {
        return view('page::category.form');
    }

    /**
     * Not implementet
     *
     * @return Response
     */
    public function show($slug)
    {
        $entry = Category::getCategoryOrFail($slug);

        $pages = $entry->page()->get();
//        dd($entry->page);
//        dd($entry->page()->get());


//        $pages = $entry->page;
        return view('page::category.show', compact('entry', 'pages'));
    }

    /**
     * Save image
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $result = Category::create($request->all());
        flashCreate($result, trans('page::category.category'));

        return redirect(route('category.index'));
    }

    /**
     * Edit form
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $entry = Category::findOrFail($id);
        return view('page::category.form', compact('entry'));
    }

    /**
     * Update
     *
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $entry = Category::findOrFail($id);
        $result = $entry->update($request->all());
        flashUpdate($result, trans('page::category.category'));

        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $result = Category::destroy($id);
        flashDelete($result, trans('page::category.category'));

        return redirect(route('category.index'));
    }

}


