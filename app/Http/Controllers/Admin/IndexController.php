<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FormLoginRequest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $redirect = '/index';
    /**
     * Display login entry point
     * @author SonNA
     * @return resource/views/admin/index/login.blade.php
     */

    public function index()
    {
        return view('admin.index.login');
    }

    /**
     * Login process handler
     * @author SonNA
     * @return boolean
     */
    public function loginProcess(FormLoginRequest $request){
        if(!empty($request->all()))
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if(Sentinel::authenticate($credentials))
            {
                return redirect($this->redirect);
            }

        }
    }
}
