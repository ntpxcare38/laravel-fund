<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundInformation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $fund = FundInformation::find(1);
        return $fund;
        //return view('home',compact('fund'));
    }
}
