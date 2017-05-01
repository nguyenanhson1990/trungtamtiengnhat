<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddContentsFormRequest;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ContentsRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $contents;
    protected $categories;

    public function __construct(ContentsRepositoryInterface $contents, CategoryRepositoryInterface $categories )
    {
        $this->contents = $contents;
        $this->categories = $categories;
    }
    public function page_index(Request $request)
    {
        $record_per_page = Config::get('contains.record_per_page');
        $limit = $request->get('limit');

        if(empty($limit))
        {
            $limit = Config::get('contains.limit');
        }

        $contents = $this->contents->getAll(1)->paginate($limit);

        return view('admin.contents.page_index',compact('record_per_page','limit','contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->type;

        $categories  = $this->categories->get(['id','parent_id','name'])->toArray();
        $status = Config::get('contains.status');
        return view('admin.contents.create',compact('type','categories','status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddContentsFormRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Buildform delete contents
     */
    public function builform()
    {

    }
}
