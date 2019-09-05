<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BenefitType;
use App\FundInformation;

class BenefitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('officer');
    }

    public function index()
    {
        $fund = FundInformation::find(1);
        $btypes = BenefitType::all();

        return view('benefit.benefit_type_manage',compact('btypes','fund'));
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
        $this->validate($request,['type_bname' => 'required']);
        $bentype = new BenefitType(['type_bname' => $request->get('type_bname')]);
        $bentype->save();
        return redirect('/btype')->with('status', 'save');
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
    public function update(Request $request, $id)
    {
        $bentype = BenefitType::where('type_bid', '=', $request->type_bid)->first();
        $bentype->type_bname = $request->type_bname;
        $bentype->save();
        return redirect('btype')->with('status', 'update');
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
