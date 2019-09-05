<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use App\Village;
use App\MemberType;
use App\FundInformation;

class ShowProfileMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('member');
    }

    public function index($id)
    {
        $fund = FundInformation::find(1);
        $mem = Member::where('mem_id','=',$id)->first();
        $vils = Village::all();
        $mtypes = MemberType::all();

        return view('show.show_profile_mem', compact('mem', 'vils','mtypes','fund'));

    }
}
