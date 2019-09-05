<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Village;
use App\MemberType;
use App\FundInformation;

class ReportAllUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin-officer-board');
    }

    public function reAllMem()
    {
        $fund = FundInformation::find(1);
        $mems = Member::all();
        $mtypes = MemberType::all();
        $vils = Village::all();
        $countMem = Member::count();
        $countMemOn = Member::where('mem_status','=',1)->count();
        $countMemOff = Member::where('mem_status','=',2)->count();
        $firstMem = Member::where('register_date','like','%2554%')->count();

        $year = Member::selectRaw("COUNT(*) yearMem, DATE_FORMAT(register_date, '%Y') year")
                        ->groupBy('register_date')
                        ->get();


        return view('report.report_all_member',compact(
            'fund',
            'mems',
            'mtypes',
            'vils',
            'countMem',
            'countMemOn',
            'countMemOff',
            'firstMem',
            'year'
        ));
    }

    public function reOldMem()
    {
        $fund = FundInformation::find(1);
        $oldMems = Member::selectRaw("DATE_FORMAT(register_date, '%Y') year")
                        ->groupBy('register_date')
                        ->get();
        return view('report.report_old_member',compact('fund','oldMems'));
    }


}
