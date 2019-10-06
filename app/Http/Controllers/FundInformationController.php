<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FundInformation;
use App\Personnel;

class FundInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->edit(1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('officer');
    }
    public function edit($id)
    {
        $fund = FundInformation::select('fund_information.*','personnels.p_id','personnels.p_fname', 'personnels.p_lname')
                                ->join('personnels', 'fund_information.p_id', '=', 'personnels.p_id')
                                ->where('fund_id','=',$id)
                                ->first();
        return view('fund.fund_edit',compact('fund'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'fund_name' => 'required',
            'fund_no' => 'required',
            'fund_village' => 'required',
            'fund_moo' => 'required',
            'fund_soi' => 'required',
            'fund_road' => 'required',
            'fund_tumbol' => 'required',
            'fund_district' => 'required',
            'fund_province' => 'required',
            'fund_zipcode' => 'required',
            'fund_tel' => 'required',
            'fund_tel_m' => 'required',
            'fund_fax' => 'required',
            'fund_email' => 'required',
            'fund_web' => 'required',
            'fund_name_h' => 'required',
            'fund_name_c' => 'required',
            'fund_habitant' => 'required'

        ]);

        $fund = FundInformation::where('fund_id','=',$id)->first();
        $fund->fund_name = $request->fund_name;
        $fund->fund_no = $request->fund_no;
        $fund->fund_village = $request->fund_village;
        $fund->fund_moo = $request->fund_moo;
        $fund->fund_soi = $request->fund_soi;
        $fund->fund_road = $request->fund_road;
        $fund->fund_tumbol = $request->fund_tumbol;
        $fund->fund_district = $request->fund_district;
        $fund->fund_province = $request->fund_province;
        $fund->fund_zipcode = $request->fund_zipcode;
        $fund->fund_tel = $request->fund_tel;
        $fund->fund_tel_m = $request->fund_tel_m;
        $fund->fund_fax = $request->fund_fax;
        $fund->fund_email = $request->fund_email;
        $fund->fund_web = $request->fund_web;
        $fund->fund_name_h = $request->fund_name_h;
        $fund->fund_name_c = $request->fund_name_c;
        $fund->fund_habitant = $request->fund_habitant;
        $fund->p_id = $request->p_id;
        $fund->fund_edit_time = $request->fund_edit_time;
        $fund->save();
        return redirect('/fund')->with('status', 'update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
