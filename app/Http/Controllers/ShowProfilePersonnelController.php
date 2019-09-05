<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Personnel;
use App\PositionFund;
use App\PositionCom;
use App\FundInformation;

class ShowProfilePersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin-officer-board');
    }

    public function index($id)
    {
        $fund = FundInformation::find(1);
        $pfunds = PositionFund::all();
        $pcoms = PositionCom::all();
        $per = Personnel::where('p_id','=',$id)->first();

        return view('show.show_profile_per', compact('per', 'pcoms','pfunds','fund'));

    }
}
