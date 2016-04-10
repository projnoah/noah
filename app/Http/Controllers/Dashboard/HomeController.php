<?php

namespace Noah\Http\Controllers\Dashboard;

use Noah\Blog;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * 显示仪表盘
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @author Cali
     */
    public function home()
    {
        $blogs = Blog::latest()->get();
        $recommended_users = User::latest()->take(5)->get();
        
        return view('dashboard.index', compact('blogs', 'recommended_users'));
    }

    /**
     * @return mixed
     */
    public function test()
    {
        return User::find(1);
    }

    public function search($keyword)
    {
        return $keyword;
    }
}