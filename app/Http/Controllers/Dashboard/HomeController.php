<?php

namespace Noah\Http\Controllers\Dashboard;

use Noah\User;
use Noah\Http\Requests;
use Illuminate\Http\Request;
use Noah\Http\Controllers\Controller;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * 显示仪表盘
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Cali
     */
    public function index()
    {
        return view('dashboard.index');
    }

    /**
     * @return mixed
     */
    public function test()
    {
        return User::find(1);
    }

}