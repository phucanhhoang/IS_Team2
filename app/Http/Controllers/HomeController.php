<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pros = Product::take(10)->get();
        return view('pages.home', compact('pros'));
    }

    //-------------------Admin zone------------------------//

    public function adminHomePage()
    {
        return view('admin.home');
    }
}
