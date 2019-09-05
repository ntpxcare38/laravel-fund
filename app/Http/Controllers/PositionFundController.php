<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PositionFund;
use App\FundInformation;

class PositionFundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $fund = FundInformation::find(1);
        $pfunds = PositionFund::all();

        return view('personnel.pos_fund_manage',compact('pfunds','fund'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->validate($request,['position_fname' => 'required']);
        $PsFund = new PositionFund(['position_fname' => $request->get('position_fname')]);
        $PsFund->save();
        return redirect('/posfund')->with('status', 'save');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)

    {
        $pfund = PositionFund::where('position_fid', '=', $request->position_fid)->first();
        $pfund->position_fname = $request->position_fname;
        $pfund->save();
        return redirect('posfund')->with('status', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PositionFund::where('position_fid',"=",$id)->delete();
        return redirect('posfund')->with('status', 'delete');
    }
}
