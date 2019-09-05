<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupAcc;
use App\FundInformation;

class GroupAccController extends Controller
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
        $gcs = GroupAcc::all();

        return view('account.group_acc_manage',compact('gcs','fund'));
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
        $this->validate($request,['group_acname' => 'required']);
        $this->validate($request,['type_acc' => 'required']);
        $gc = new GroupAcc(
            [
                'group_acname' => $request->get('group_acname'),
                'type_acc' => $request->get('type_acc')
            ]);
        $gc->save();
        return redirect('/gc')->with('status', 'save');
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
        $gc = GroupAcc::where('group_acid', '=', $request->group_acid)->first();
        $gc->group_acname = $request->group_acname;
        $gc->type_acc = $request->type_acc;
        $gc->save();
        return redirect('gc')->with('status', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GroupAcc::where('group_acid',"=",$id)->delete();
        return redirect('gc')->with('status', 'delete');
    }
}
