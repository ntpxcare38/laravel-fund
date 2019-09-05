<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundInformation;

class MainAdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function mAdmin()
    {
        $fund = FundInformation::find(1);

        return view('main.main_admin',compact('fund'));
    }
}
