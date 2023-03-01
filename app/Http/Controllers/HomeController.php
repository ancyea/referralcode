<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminHome()
    { 
        $users =  DB::table('users')
        ->select('users.name','referral.points')
        ->join('referral', 'users.id', '=', 'referral.user_id')
        ->where('users.type',0)
        ->get();
        return view('adminHome')->with('users', $users);
    }
}
