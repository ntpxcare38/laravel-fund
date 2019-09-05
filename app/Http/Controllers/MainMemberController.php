<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundInformation;

class MainMemberController extends Controller
{
    public function __construct(){
        $this->middleware('member');
    }

    public function mMember()
    {
        $fund = FundInformation::find(1);

        return view('main.main_member',compact('fund'));
    }
}
