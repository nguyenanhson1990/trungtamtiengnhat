<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AddContentsFormRequest;
use App\Models\Contents;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ContentsRepositoryInterface;
use App\Support\functions;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $trashed = Config::get('contains.trashed');
        $actions = Config::get('contains.actions');
        $content_type = $request->get('content_type');

        if(empty($content_type))
        {
            $content_type = Config::get('contains.content_type');
        }

        if(empty($limit))
        {
            $limit = Config::get('contains.limit');
        }

        if($request->get('trashed') == 1) {
            /*$contents = $this->contents->getAll()
                ->when($category_id, function($query) use ($category_id){
                    $query->whereHas('categories', function($q) use ($category_id){
                        $q->where('id', '=', $category_id);
                    });
                })
                ->when($status_id, function($query) use ($status_id){
                    $query->where('status', $status_id);
                })->latest()->paginate($limit);*/
        }
        return view('admin.contents.page_index',compact('record_per_page','limit','contents','categories','status','status_id','trashed','actions','content_type'));
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
        $content_type = Config::get('contains.content_type');

        return view('admin.contents.create',compact('type','categories','status','content_type'));
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
            'content_type'  => $request->content_type
        ];

        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');
            $destination = 'uploads/contents/thumbnail/';
            $file_name = $request->slug.'_'.random_int(0,12).'_'.$thumbnail->getClientOriginalName();
            $upload = functions::upload_file($thumbnail,$destination,$file_name);

            if($upload)
            {
                $datas['thumbnail'] = $destination.$file_name;
            }else{
                Session::flash("flash_notify",[
                    'level' => 'error',
                    'message' => __('admin.contents.messages.fail_upload')
                ]);
                return redirect()->back()->withInput();
            }
        }

        $user_id = $this->user->findByCredentials(session()->get('loged_credentials'))->id;

        $datas['user_id']  = $user_id;

        //insert and get last insert id
        $last_inserted_id = $this->contents->create($datas);

        //if not empty category id array then find and attach to pivot table
        if($request->category_id)
        {
            $inserted_content = Contents::find($last_inserted_id);
            $inserted_content->categories()->attach($request->category_id);
        }

        //if has return last insert id , check if last insert id is existed then display success else display error and
        //return back
        if($last_inserted_id)
        {
            Session::flash("flash_notify",[
                'level' => 'success',
                'message' => __('admin.contents.messages.success_add')
            ]);

            return redirect()->route('contents_page')->withInput($request->all());
        }else{
            Session::flash("flash_notify",[
                'level' => 'error',
                'message' => __('admin.contents.messages.error_add')
            ]);

            return redirect()->back();
        }
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
        $contents = $this->contents->findById($id)->first();
        $categories  = $this->categories->get(['id','parent_id','name'])->toArray();
        $status = Config::get('contains.status');
        $contents_categories_id = [];
        $content_type = Config::get('contains.content_type');

        foreach($contents->categories->toArray() as $key => $value)
        {
             array_push($contents_categories_id,$value['id']);
        }

        return view('admin.contents.edit',compact('contents','categories','status','contents_categories_id','id','content_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddContentsFormRequest $request, $id)
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
            'user_id'  => $request->user_id,
            'content_type'  => $request->content_type
        ];

        if($request->hasFile('thumbnail'))
        {
            $thumbnail = $request->file('thumbnail');
            $destination = 'uploads/contents/thumbnail/';
            $file_name = $request->slug.'_'.random_int(0,12).'_'.$thumbnail->getClientOriginalName();
            $exits_thumbnail = $this->contents->findById($id)->value('thumbnail');
            if(Storage::exists($exits_thumbnail))
            {
                Storage::delete($exits_thumbnail);
            }

            $upload = functions::upload_file($thumbnail,$destination,$file_name);

            if($upload)
            {
                $datas['thumbnail'] = $destination.$file_name;
            }else{
                Session::flash("flash_notify",[
                    'level' => 'danger',
                    'message' => __('admin.contents.messages.fail_upload')
                ]);
                return redirect()->back()->withInput();
            }
        }

         $update = $this->contents->update($datas,$id);

        //if not empty category id array then find and attach to pivot table
        if($request->category_id)
        {
            $inserted_content = Contents::find($id);
            $inserted_content->categories()->sync($request->category_id);
        }

        //if has return last insert id , check if last insert id is existed then display success else display error and
        //return back
        if($update)
        {
            Session::flash("flash_notify",[
                'level' => 'success',
                'message' => __('admin.contents.messages.success_edit')
            ]);

            return redirect()->route('contents_page')->withInput($request->all());
        }else {
            Session::flash("flash_notify", [
                'level' => 'danger',
                'message' => __('admin.contents.messages.error_add')
            ]);
            return redirect()->route('contents_page')->withInput($request->all());
        }
    }

    /**
     * Handler action delete, change status, move to trash, restore
     */
    public function action(Request $request)
    {
        if(!empty(json_decode($request->ids)))
        {
            if($request->actions == 1){// move to trash
                foreach(json_decode($request->ids) as $item)
                {
                    $this->contents->update(['status' => 1],$item);
                    $this->contents->delete($item);
                }
                Session::flash('flash_notify',[
                    'level' => 'success',
                    'message' => __('admin.contents.messages.success_move_trash')
                ]);
            }

            if($request->actions == 2){ //delete
                foreach(json_decode($request->ids) as $item) {
                    $thumbnail = $this->contents->findById($item)->withTrashed()->value('thumbnail');
                    if(Storage::exists($thumbnail))
                    {
                        Storage::delete($thumbnail);
                    }
                    $this->contents->deletePermanently($item);
                }
                Session::flash('flash_notify',[
                    'level' => 'danger',
                    'message' => __('admin.contents.messages.success_delete')
                ]);
            }

            if($request->actions == 3){ //restore
                foreach(json_decode($request->ids) as $item) {
                    $this->contents->restore($item);
                }
                Session::flash('flash_notify',[
                    'level' => 'success',
                    'message' => __('admin.contents.messages.success_restore')
                ]);
            }

            if($request->actions == 4){ //change status

                foreach(json_decode($request->ids) as $item) {

                    $status = $this->contents->findById($item)->value('status');
                    $this->contents->update(['status' => $status == 1 ? 2 : 1], $item);
                }
                Session::flash('flash_notify',[
                    'level' => 'success',
                    'message' => __('admin.contents.messages.success_change_status')
                ]);
            }

        }

        return redirect()->back();
    }

    /**
     * Change status
     */
    public function changestatus(Request $request)
    {
        $this->contents->update(['status' => $request->status],$request->id);

        Session::flash('flash_notify',[
           'level' => 'success',
            'message' => __('admin.contents.messages.success_change_status')
        ]);

        return redirect()->back();
    }
}
