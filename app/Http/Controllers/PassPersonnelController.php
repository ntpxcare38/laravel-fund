<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Personnel;
use App\FundInformation;

class PassPersonnelController extends Controller
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

    public function index()
    {
        $fund = FundInformation::find(1);
        return view('personnel.pass_per', compact('fund'));
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
    public function update(Request $request, $id)
    {
        $this->validate($request,
        [
            'old_password' => 'required',
            'new_password' => 'required',
            'cnew_password' => 'required'

        ]);

        $per = Personnel::where('p_id', '=', $id)->first();
        $pw = $per->password;

        if (password_verify($request->old_password, $pw)) {
            if(password_verify($request->new_password, $pw)){
                return back()->withErrors(['new_password' => 'รหัสผ่านซ้ำกับรหัสผ่านเดิม']);
            }else{
                $per->password = bcrypt($request->new_password);
                $per->save();
                if($per->type_pid==1){
                    return redirect('mAdmin')->with('status','changepass');
                }else if($per->type_pid==2){
                    return redirect('mBoard')->with('status','changepass');
                }else if($per->type_pid==3){
                    return redirect('mOfficer')->with('status','changepass');
                }

            }
        }else{
            return back()->withErrors(['old_password' => 'กรุณากรอกรหัสผ่านให้ถูกต้อง']);
        }

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
