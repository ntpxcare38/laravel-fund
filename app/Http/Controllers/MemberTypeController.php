<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemberType;
use App\FundInformation;

class MemberTypeController extends Controller
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
        $mtypes = MemberType::all();

        return view('member.mem_type_manage',compact('mtypes','fund'));
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
        $this->validate($request,['type_mname' => 'required']);

        $mtype = new MemberType(['type_mname' => $request->get('type_mname')]);
        $mtype->save();
        return redirect('/mtype')->with('status', 'save');
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
    public function update(Request $request)
    {
        $mtype = MemberType::where('type_mid', '=', $request->type_mid)->first();
        $mtype->type_mname = $request->type_mname;
        $mtype->save();
        return redirect('mtype')->with('status', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MemberType::where('type_mid',"=",$id)->delete();
        return redirect('mtype')->with('status', 'delete');
    }
}
