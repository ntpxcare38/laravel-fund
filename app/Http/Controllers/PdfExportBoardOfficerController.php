<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Benefit;
use App\BenefitType;
use App\FundInformation;
use App\Account;
use App\GroupAcc;
use PDF;

class PdfExportBoardOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('officer-board');
    }

    public function pdfreportBenefit($std ,$end)
    {
        $fund = FundInformation::find(1);
        $mems = Member::all();
        $bens = Benefit::all();
        $btypes = BenefitType::all();

        if($std === "0000-00-00" && $end =="0000-00-00"){
            $dateStart = '0001-01-01';
            $dateEnd = '0001-01-01';
        }else{
            $dateStart = $std;
            $dateEnd = $end;
        }

        $benAll = Benefit::selectRaw("COUNT(DISTINCT mem_id) as benCount, type_bid")
                            ->groupBy('type_bid')
                            ->get();
        $sumBen = Benefit::selectRaw("SUM(benefit_price) as totalBen, type_bid")
                            ->groupBy('type_bid')
                            ->get();

        $benYear = Benefit::selectRaw("COUNT(DISTINCT mem_id) as benCount, type_bid")
                            ->groupBy('type_bid')
                            ->whereBetween('benefit_date', [$dateStart, $dateEnd])
                            ->get();
        $sumBenYear = Benefit::selectRaw("SUM(benefit_price) as totalBen, type_bid")
                            ->groupBy('type_bid')
                            ->whereBetween('benefit_date', [$dateStart, $dateEnd])
                            ->get();

        $pdf= PDF::loadView('pdf.pdf_report_benefit', compact(
                                                                'fund',
                                                                'mems',
                                                                'bens',
                                                                'btypes',
                                                                'benAll',
                                                                'sumBen',
                                                                'benYear',
                                                                'sumBenYear',
                                                                'dateStart',
                                                                'dateEnd'))->setPaper('a4','portrait');
        return $pdf->stream('reportBenefit.pdf');
    }

    public function pdfreportAccount($std ,$end)
    {
        $fund = FundInformation::find(1);
        $bens = Benefit::all();
        $gacs = GroupAcc::all();
        $btypes = BenefitType::all();
        if($std === "0000-00-00" && $end =="0000-00-00"){
            $dateStart = '0001-01-01';
            $dateEnd = '0001-01-01';
        }else{
            $dateStart = $std;
            $dateEnd = $end;
        }


        $sumAcc = Account::selectRaw("SUM(acc_total) as totalAcc, group_acid")
                            ->groupBy('group_acid')
                            ->get();

        $sumBen = Benefit::selectRaw("SUM(benefit_price) as totalBen")
                            ->get();

        $sumAccFil = Account::selectRaw("SUM(acc_total) as totalAcc, group_acid")
                            ->groupBy('group_acid')
                            ->whereBetween('acc_date', [$dateStart, $dateEnd])
                            ->get();

        $sumBenFil = Benefit::selectRaw("SUM(benefit_price) as totalBen")
                            ->whereBetween('benefit_date', [$dateStart, $dateEnd])
                            ->get();

        $pdf= PDF::loadView('pdf.pdf_report_account', compact(
                                                                'fund',
                                                                'bens',
                                                                'sumBen',
                                                                'sumAcc',
                                                                'sumBen',
                                                                'sumAccFil',
                                                                'sumBenFil',
                                                                'gacs',
                                                                'btypes',
                                                                'dateStart',
                                                                'dateEnd'))->setPaper('a4','portrait');
        return $pdf->stream('reportAccount.pdf');
    }

    public function pdfBenMonth(Request $request)
    {
        $status = $request->ben_type;
        $dateStart = $request->get('startDate');
        $dateEnd = $request->get('endDate');

        $fund = FundInformation::find(1);
        $mems = Member::all();
        $btypes = BenefitType::all();
        if($status == 1){
            $msgHead = 'สวัสดิการผู้สูงอายุ';
            $bens = Benefit::orderBy('benefit_id', 'DESC')
                        ->whereBetween('benefit_date', [$dateStart, $dateEnd])
                        ->where('type_bid','=',3)
                        ->get();
        }
        else{
            $msgHead = 'สวัสดิการทั้งหมด (ยกเว้นสวัสดิการผู้สูงอายุ)';
            $bens = Benefit::orderBy('benefit_date', 'DESC')
                        ->whereBetween('benefit_date', [$dateStart, $dateEnd])
                        ->where('type_bid','!=',3)
                        ->get();
        }


        $pdf= PDF::loadView('pdf.pdf_ben_month', compact('bens','msgHead','btypes','fund','mems','dateStart','dateEnd'))->setPaper('a4','landscape');

        return $pdf->stream('Benefit_'.$dateStart.'.pdf');
    }
}
