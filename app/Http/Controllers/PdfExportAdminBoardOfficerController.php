<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personnel;
use App\PositionFund;
use App\PositionCom;
use App\Member;
use App\Village;
use App\MemberType;
use App\FundInformation;
use PDF;

use Carbon\Carbon;

class PdfExportAdminBoardOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin-officer-board');
    }

    public function pdfper()
    {
        $pfunds = PositionFund::all();
        $pcoms = PositionCom::all();
        $pers = Personnel::orderBy('position_fid', 'ASC')->where('type_pid','=',2)->get();
        $fund = FundInformation::find(1);

        $pdf= PDF::loadView('pdf.pdf_personnel', compact('pers', 'pcoms','pfunds','fund'))->setPaper('a4','landscape');
        return $pdf->stream('personnel.pdf');
    }

    public function pdfmemall()
    {
        $mems = Member::all();
        $vils = Village::all();
        $mtypes = MemberType::all();
        $fund = FundInformation::find(1);

        $pdf= PDF::loadView('pdf.pdf_memberAll', compact('mems','vils','mtypes','fund'))->setPaper('a4','landscape');
        return $pdf->stream('member.pdf');
    }

    public function pdfoldmem(Request $request)
    {
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $dateObj = ("$year-$month-$day");

        $expDate = Carbon::parse($dateObj)->subYear((60));

        $yearOldMem = $request->year_omem;
        $mems = Member::whereDate('mem_birthdate', '<',$expDate)
                            ->where('mem_status','=',1)
                            ->where('register_date','like','%'.$yearOldMem.'%')
                            ->get();

        //$mems = Member::all();
        $vils = Village::all();
        $mtypes = MemberType::all();
        $fund = FundInformation::find(1);

        $pdf= PDF::loadView('pdf.pdf_old_member', compact('yearOldMem','mems','vils','mtypes','fund'))->setPaper('a4','landscape');
        return $pdf->stream('old_member_'.$yearOldMem.'.pdf');
    }

    public function pdfreportmemall()
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

        $pdf= PDF::loadView('pdf.pdf_report_all_member', compact('fund',
                                                        'mems',
                                                        'mtypes',
                                                        'vils',
                                                        'countMem',
                                                        'countMemOn',
                                                        'countMemOff',
                                                        'firstMem',
                                                        'year'))->setPaper('a4','landscape');
        return $pdf->stream('reportmember.pdf');
    }
}
