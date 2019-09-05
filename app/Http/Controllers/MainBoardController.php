<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundInformation;

class MainBoardController extends Controller
{
    public function __construct(){
        $this->middleware('board');
    }

    public function mBoard()
    {
        $fund = FundInformation::find(1);

        return view('main.main_board',compact('fund'));
    }
}
