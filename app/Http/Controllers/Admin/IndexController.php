<?php

namespace App\Http\Controllers\Admin;

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
        if(!empty($request->all()))
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if(Sentinel::authenticate($credentials))
            {
                //return redirect($this->redirect);
            }
        }
        return view('admin.index.login');
    }
}
