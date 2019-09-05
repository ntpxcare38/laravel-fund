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

class PdfExportAdminOfficerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin-officer');
    }

    public function pdfmem($id)
    {
        $mem = Member::where('mem_id','=',$id)->first();
        $bens = Benefit::where('mem_id','=',$mem->mem_id)->orderBy('benefit_id', 'ASC')->get();
        $btypes = BenefitType::all();
        $vils = Village::all();
        $mtypes = MemberType::all();
        $fund = FundInformation::find(1);
        $sumBen = Benefit::selectRaw("SUM(benefit_price) as benefit_total")
                        ->where('mem_id','=',$mem->mem_id)->get();

        $pdf= PDF::loadView('pdf.pdf_member', compact('mem', 'bens','btypes','vils','mtypes','fund','sumBen'))->setPaper('a4','portrait');
        return $pdf->stream($mem->mem_no.'.pdf');

    }
}
