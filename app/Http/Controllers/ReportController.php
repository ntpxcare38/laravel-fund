<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Village;
use App\MemberType;
use App\FundInformation;
use App\Benefit;
use App\BenefitType;
use App\Account;
use App\GroupAcc;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('officer-board');
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

        $yearMem = Member::selectRaw("COUNT(*) yearMem, DATE_FORMAT(register_date, '%Y') year")
                        ->groupBy('register_date')
                        ->where('mem_status','=',1)
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
            'yearMem'
        ));
    }

    public function reBenMonth()
    {
        $fund = FundInformation::find(1);
        return view('report.report_benefit_month',compact('fund'));
    }

    public function reBenefit(Request $request)
    {
        $fund = FundInformation::find(1);
        $mems = Member::all();
        $bens = Benefit::all();
        $btypes = BenefitType::all();

        $benAll = Benefit::selectRaw("COUNT(DISTINCT mem_id) as benCount, type_bid")
                            ->groupBy('type_bid')
                            ->get();
        $sumBen = Benefit::selectRaw("SUM(benefit_price) as totalBen, type_bid")
                            ->groupBy('type_bid')
                            ->get();

        $benYear = Benefit::selectRaw("COUNT(DISTINCT mem_id) as benCount, type_bid")
                            ->groupBy('type_bid')
                            ->whereBetween('benefit_date', ["0000-00-00", "0000-00-00"])
                            ->get();
        $sumBenYear = Benefit::selectRaw("SUM(benefit_price) as totalBen, type_bid")
                            ->groupBy('type_bid')
                            ->whereBetween('benefit_date', ["0000-00-00", "0000-00-00"])
                            ->get();

        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        if($startDate !='' && $endDate != ''){
            $benYear = Benefit::selectRaw("COUNT(DISTINCT mem_id) as benCount, type_bid")
                            ->groupBy('type_bid')
                            ->whereBetween('benefit_date', [$startDate, $endDate])
                            ->get();
            $sumBenYear = Benefit::selectRaw("SUM(benefit_price) as totalBen, type_bid")
                            ->groupBy('type_bid')
                            ->whereBetween('benefit_date', [$startDate, $endDate])
                            ->get();
         }

        return view('report.report_benefit',compact(
            'fund',
            'mems',
            'bens',
            'btypes',
            'benAll',
            'sumBen',
            'benYear',
            'sumBenYear'

        ));
    }

    public function reAccount(Request $request)
    {
        $fund = FundInformation::find(1);
        $bens = Benefit::all();
        $gacs = GroupAcc::all();
        $btypes = BenefitType::all();

        $sumAcc = Account::selectRaw("SUM(acc_total) as totalAcc, group_acid")
                            ->groupBy('group_acid')
                            ->get();

        $sumBen = Benefit::selectRaw("SUM(benefit_price) as totalBen")
                            ->get();

        $sumAccFil = Account::selectRaw("SUM(acc_total) as totalAcc, group_acid")
                            ->groupBy('group_acid')
                            ->whereBetween('acc_date', ["0000-00-00", "0000-00-00"])
                            ->get();

        $sumBenFil = Benefit::selectRaw("SUM(benefit_price) as totalBen")
                            ->whereBetween('benefit_date', ["0000-00-00", "0000-00-00"])
                            ->get();

        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        if($startDate !='' && $endDate != ''){
            $sumAccFil = Account::selectRaw("SUM(acc_total) as totalAcc, group_acid")
                        ->groupBy('group_acid')
                        ->whereBetween('acc_date', [$startDate, $endDate])
                        ->get();

            $sumBenFil = Benefit::selectRaw("SUM(benefit_price) as totalBen")
                        ->whereBetween('benefit_date', [$startDate, $endDate])
                        ->get();
        }

        return view('report.report_account',compact(
            'fund',
            'bens',
            'sumBen',
            'sumAcc',
            'sumBen',
            'sumAccFil',
            'sumBenFil',
            'gacs',
            'btypes'


        ));
    }
}
