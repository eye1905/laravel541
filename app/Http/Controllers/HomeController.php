<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Route;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
       

        if (Route::has('login')) {
            return view('home-admin');
        }
        else{
            return view('home-user');
        }

    }
}
