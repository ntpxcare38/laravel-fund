<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BenefitType;
use App\Benefit;
use App\Member;
use App\FundInformation;

class BenefitMemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('member');
    }
    public function index($id)
    {
        $fund = FundInformation::find(1);
        $mem = Member::where('mem_id','=',$id)->first();
        $bens = Benefit::where('mem_id','=',$mem->mem_id)->get();
        $bensCount = Benefit::where('mem_id','=',$mem->mem_id)->count();
        $btypes = BenefitType::all();
        $sumBen = Benefit::selectRaw("SUM(benefit_price) as benefit_total")
                        ->where('mem_id','=',$mem->mem_id)->get();

        return view('benefit.benefit_show_mem', compact('bens','sumBen','bensCount','mem','btypes','fund'));
    }
}
