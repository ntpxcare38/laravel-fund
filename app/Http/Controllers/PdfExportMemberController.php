<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Village;
use App\MemberType;
use App\Benefit;
use App\BenefitType;
use App\FundInformation;
use PDF;

class PdfExportMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('member');
    }


    public function pdfProMem($id)
    {
        $mem = Member::where('mem_id','=',$id)->first();
        $vils = Village::all();
        $mtypes = MemberType::all();
        $fund = FundInformation::find(1);

        $pdf= PDF::loadView('pdf.pdf_pro_member', compact('mem','vils','mtypes','fund'))->setPaper('a4','portrait');
        return $pdf->stream($mem->mem_no.'.pdf');

    }

    public function pdfBenMem($id)
    {
        $mem = Member::where('mem_id','=',$id)->first();
        $bens = Benefit::where('mem_id','=',$mem->mem_id)
                            ->orderBy('benefit_date', 'ASC')
                            ->get();
        $btypes = BenefitType::all();
        $sumBen = Benefit::selectRaw("SUM(benefit_price) as benefit_total")
                        ->where('mem_id','=',$mem->mem_id)->get();

        $pdf= PDF::loadView('pdf.pdf_ben_member', compact('mem', 'bens','btypes','sumBen'))->setPaper('a4','portrait');
        return $pdf->stream('benefit_'.$mem->mem_no.'.pdf');
    }

}
