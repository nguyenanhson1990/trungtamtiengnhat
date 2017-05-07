<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddContentsFormRequest;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ContentsRepositoryInterface;
use App\Support\functions;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $contents;
    protected $categories;
    protected $user;

    public function __construct(ContentsRepositoryInterface $contents, CategoryRepositoryInterface $categories )
    {
        $this->contents = $contents;
        $this->categories = $categories;
        $this->user = Sentinel::getUserRepository();
    }
    public function page_index(Request $request)
    {
        $record_per_page = Config::get('contains.record_per_page');
        $limit = $request->get('limit');
        $categories  = $this->categories->get(['id','parent_id','name'])->toArray();
        $category_id = $request->get('category_id');
        $status = Config::get('contains.status');
        $status_id = $request->get('status_id');

        if(empty($limit))
        {
            $limit = Config::get('contains.limit');
        }

        $contents = $this->contents->getAll(1)->latest()
                    ->when($category_id, function($query) use ($category_id){
                        $query->where('category_id', $category_id);
                    })
                    ->when($status_id, function($query) use ($status_id){
                        $query->where('status', $status_id);
                    })
                    ->paginate($limit);

        return view('admin.contents.page_index',compact('record_per_page','limit','contents','categories','status','status_id'));
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
        $datas = [
            'title' => $request->title,
            'slug' => !empty($request->slug) ? $request->slug : str_slug($request->title),
            'content_type' => $request->content_type,
            'short_content' => $request->short_content,
            'content' => $request->main_content,
            'status' => $request->status,
            'end_date' => functions::to_date_mysql($request->end_date),
            'og_keyword' => $request->og_keyword,
            'og_desc' => $request->og_desc,
            'category_id' => $request->category_id
        ];


        if($request->hasFile('thumbnail'))
        {
            $thumbnail =$request->file('thumbnail');
            $path = $thumbnail->storeAs('public/uploads/contents', date('Y-m-d').'_'.random_int(0,12).'_'.$thumbnail->getClientOriginalName());

            if($request->file('thumbnail')->isValid())
            {
                $datas['thumbnail'] = $path;
            }else{
                Session::flash("flash_notify",[
                    'level' => 'error',
                    'message' => __('admin.contents.messages.fail_upload')
                ]);

                return redirect()->back();
            }
        }

        $user_id = $this->user->findByCredentials(session()->get('loged_credentials'))->id;

        $datas['user_id']  = $user_id;

        $this->contents->create($datas);

        Session::flash("flash_notify",[
            'level' => 'success',
            'message' => __('admin.contents.messages.success_add')
        ]);

        return redirect()->route('contents_page');

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

    /**
     * Change status
     */
    public function changestatus(Request $request)
    {
        $this->contents->update(['status' => $request->status],$request->id);

        return redirect()->back();
    }
}
