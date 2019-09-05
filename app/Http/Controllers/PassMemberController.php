<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Member;
use App\FundInformation;

class PassMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('member');
    }

    public function index()
    {
        $fund = FundInformation::find(1);

        return view('member.pass_mem', compact('fund'));
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

        $mem = Member::where('mem_id', '=', $id)->first();
        $pw = $mem->password;

        if (password_verify($request->old_password, $pw)) {
            if(password_verify($request->new_password, $pw)){
                return back()->withErrors(['new_password' => 'รหัสผ่านซ้ำกับรหัสผ่านเดิม']);
            }else{
                $mem->password = bcrypt($request->new_password);
                $mem->save();
                return redirect('mMember')->with('status','changepass');
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
