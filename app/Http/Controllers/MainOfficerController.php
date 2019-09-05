<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundInformation;

class MainOfficerController extends Controller
{
    public function __construct(){
        $this->middleware('officer');
    }

    public function mOfficer()
    {
        $fund = FundInformation::find(1);

        return view('main.main_officer',compact('fund'));
    }
}
