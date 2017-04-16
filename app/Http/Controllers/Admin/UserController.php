<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FormAddUserRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Sentinel::getUserRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $record_per_page = Config::get('contains.record_per_page');

        $limit = $request->get('limit');

        if(!$limit){
            $limit = Config::get('contains.limit');
        }

        $users = $this->user->latest()->paginate($limit);

        return view('admin.user.index',compact('users','record_per_page','limit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormAddUserRequest $request)
    {
        Sentinel::registerAndActivate($request->all());

        $record_per_page = Config::get('contains.record_per_page');

        $limit = Config::get('contains.limit');

        $users = $this->user->paginate($limit);

        return redirect()->route('users')->with(compact('users','record_per_page','limit','page'));
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
        $user = Sentinel::findById($id);

        return view('admin.user.edit',compact('user'));
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

        $record_per_page = Config::get('contains.record_per_page');

        $limit = Config::get('contains.limit');

        $users = $this->user->paginate($limit);

        $user = Sentinel::findById( $id );

        Sentinel::update($user, $request->all());

        return redirect()->route('users')->with(compact('users','record_per_page','limit','page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Sentinel::findById($id);
        $user->delete();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function builform(Request $request)
    {
        $datausername = $request->get('datausername');
        $user_id = $request->get('user_id');

        return response()->json(['body' => view('admin.user.formdelete', compact('content','user_id','datausername'))->render()]);
    }
}
