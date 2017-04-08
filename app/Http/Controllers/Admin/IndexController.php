<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FormLoginRequest;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $redirect = 'home';
    protected $login = 'login';

    public function __construct()
    {

    }

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
    public function loginProcess(FormLoginRequest $request)
    {
        try{

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'remember' => $request->remember
            ];

            if(Sentinel::authenticateAndRemember($credentials))
            {
                return redirect()->route($this->redirect);
            }else{
                return redirect()->back()->withErrors(['msg' => 'Please check your email or password']);
            }

        }catch (ThrottlingException $e){
            return redirect()->back()->withErrors(['msg' => 'Your account has been locked in '.$e->getDelay()]);
        }
    }

    /**
     * Home page
     * @author SonNA
     * @return resource/views/admin/index/home.blade
     */
    public function home()
    {
        return view('admin.index.home');
    }

    /**
     * Logout process
     * @author SonNA
     * @return boolean
     */
    public function logout()
    {
        Sentinel::logout();
        return redirect()->route($this->login)->withErrors(['msg' => 'you have successfully logged out']);
    }
}
