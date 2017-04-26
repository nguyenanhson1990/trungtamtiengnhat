<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Categories;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    protected $category;

    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $record_per_page =  Config::get('contains.record_per_page');

        $limit = $request->get('limit');

        if(!$limit){
            $limit = Config::get('contains.limit');
        }
        $categories = $this->category->all($limit);

        return view('admin.categories.index',compact('categories','record_per_page','limit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cat = $this->category->get(['id','parent_id','name'])->toArray();

        return view('admin.categories.create',compact('parent_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {

        $record_per_page =  Config::get('contains.record_per_page');

        $limit = $request->get('limit');

        if(!$limit){
            $limit = Config::get('contains.limit');
        }

        $categories = $this->category->all($limit);
        $datas = $request->except(['_token']);
        $datas['slug'] = str_slug($request->name,'-');

        $this->category->add($datas);

        Session::flash("flash_notify",[
            'level' => 'success',
            'message' => __('admin.category.messages.success_add')
        ]);

        return redirect()->route('categories')->with(compact('categories','record_per_page','limit','page'));
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
        $category = $this->category->find($id)->first();
        $parent_cat = $this->category->get(['id','parent_id','name'])->toArray();

        return view('admin.categories.edit',compact('category','parent_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, $id)
    {
        $this->category->update($id,$request->except('_token'));

        Session::flash('flash_notify',[
            'level' => 'success',
            'message' => __('admin.category.messages.success_edit')
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->category->delete($request->get('category_id'));

        Session::flash('flash_notify',[
            'level' => 'danger',
            'message' => __('admin.category.messages.success_delete')
        ]);

        return redirect()->back();
    }

    public function builform(Request $request)
    {
        $category_id = $request->get('cat_id');
        $category_name = $request->get('cat_name');
        return response()->json(['body' => view('admin.categories.formdelete', compact('category_id','category_name'))->render()]);
    }
}
