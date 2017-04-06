<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display login entry point
     * @author SonNA
     * @return resource/views/admin/index/login.blade.php
     */

    public function index()
    {
        return view('admin.index.login');
    }
}
