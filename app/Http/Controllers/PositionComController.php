<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PositionCom;
use App\FundInformation;

class PositionComController extends Controller
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
        $pcoms = PositionCom::all();

        return view('personnel.pos_com_manage',compact('pcoms','fund'));
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
        $this->validate($request,['position_cname' => 'required']);
        $PsCom = new PositionCom(['position_cname' => $request->get('position_cname')]);
        $PsCom->save();
        return redirect('/poscom')->with('status', 'save');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PositionCom  $positionCom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PositionCom  $positionCom
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
     * @param  \App\PositionCom  $positionCom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $pcom = PositionCom::where('position_cid', '=', $request->position_cid)->first();
        $pcom->position_cname = $request->position_cname;
        $pcom->save();
        return redirect('poscom')->with('status', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PositionCom  $positionCom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PositionCom::where('position_cid',"=",$id)->delete();
        return redirect('poscom')->with('status', 'delete');
    }
}
