<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\Village;
use App\MemberType;
use App\Benefit;
use App\FundInformation;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin-officer');
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $vils = Village::all();
        $mtypes = MemberType::all();
        $bens = Benefit::all();
        $mems = Member::orderBy('mem_id', 'DESC')->paginate($per_page);

        return view('member.member_manage', compact('mems','vils','mtypes','bens','fund'));
    }

    function fetchMem(Request $request){

        $data = Member::all();
        return response()->json($data);

    }

    public function search(Request $request){

        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $vils = Village::all();
        $mtypes = MemberType::all();
        $bens = Benefit::all();

        $search = $request->get('mem_search');
        //$searchDate = $request->get('mem_searchdate');

        if($search !=''){
            $mems= Member::where('mem_id','like','%'.$search.'%')
                            ->orWhere('mem_no','like','%'.$search)
                            ->orWhere('mem_card_id','like','%'.$search.'%')
                            ->orWhere('mem_fname','like','%'.$search.'%')
                            ->orWhere('mem_lname','like','%'.$search.'%')
                            ->orderBy('mem_id', 'DESC')
                            ->paginate($per_page);
        }
        else{
            $mems = Member::orderBy('mem_id', 'DESC')->paginate($per_page);
        }
        // else if($search =='' && $searchDate != ''){
        //     $mems = Member::where('mem_birthdate', '=', $searchDate)
        //                     ->paginate($per_page);
        // }
        // else if($search !='' && $searchDate !=''){
        //     $mems = Member::where(function($query) use ($search) {
        //                         $query->where('mem_id','like','%'.$search.'%')
        //                                 ->orWhere('mem_no','like','%'.$search.'%')
        //                                 ->orWhere('mem_card_id','like','%'.$search.'%')
        //                                 ->orWhere('mem_fname','like','%'.$search.'%')
        //                                 ->orWhere('mem_lname','like','%'.$search.'%');
        //                     })
        //                     ->where('mem_birthdate', '=', $searchDate)
        //                     ->paginate($per_page);
        // }
        return view('member.member_manage',compact('mems','vils','mtypes','bens','fund'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fund = FundInformation::find(1);
        $vils = Village::all();
        $mtypes = MemberType::all();

        return view('member.member_create',compact('vils','mtypes','fund'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'mem_no' => 'required',
            'mem_card_id' => 'required',
            'mem_title' => 'required|integer',
            'mem_fname' => 'required',
            'mem_lname' => 'required',
            'mem_birthdate' => 'required',
            'mem_add_no' => 'required',
            'v_id' => 'required|integer',
            'register_date' => 'required',
            'mem_status' => 'required|integer',
            'password' => 'required',
            'type_mid' => 'required|integer'

        ]);

        $countNo = Member::where('mem_no','=',$request->mem_no)->count();
        $countIdCard = Member::where('mem_card_id','=',$request->mem_card_id)->count();

        if($countNo == 0){
            if($countIdCard == 0){
                if($request->get('mem_status')==1){
                    $mem = new Member(
                        [
                            'mem_no' => $request->get('mem_no'),
                            'mem_card_id' => $request->get('mem_card_id'),
                            'mem_title' => $request->get('mem_title'),
                            'mem_fname' => $request->get('mem_fname'),
                            'mem_lname' => $request->get('mem_lname'),
                            'mem_birthdate' => $request->get('mem_birthdate'),
                            'mem_add_no' => $request->get('mem_add_no'),
                            'v_id' => $request->get('v_id'),
                            'register_date' => $request->get('register_date'),
                            'mem_status' => $request->get('mem_status'),
                            'password' => bcrypt($request->get('password')),
                            'type_mid' => $request->get('type_mid')
                        ]
                    );
                }else{
                    $mem = new Member(
                        [
                            'mem_no' => $request->get('mem_no'),
                            'mem_card_id' => $request->get('mem_card_id'),
                            'mem_title' => $request->get('mem_title'),
                            'mem_fname' => $request->get('mem_fname'),
                            'mem_lname' => $request->get('mem_lname'),
                            'mem_birthdate' => $request->get('mem_birthdate'),
                            'mem_add_no' => $request->get('mem_add_no'),
                            'v_id' => $request->get('v_id'),
                            'register_date' => $request->get('register_date'),
                            'resign_date' => $request->get('resign_date'),
                            'mem_status' => $request->get('mem_status'),
                            'mem_cause_st' => $request->get('mem_cause_st'),
                            'password' => bcrypt($request->get('password')),
                            'type_mid' => $request->get('type_mid')
                        ]
                    );
                }
                $mem->save();
                return redirect('/mem')->with('status', 'save');
            }
            else{
                return redirect()->back()->withInput($request->input())->with('status', 'memidcardduplicate');
            }
        }
        else{
            return redirect()->back()->withInput($request->input())->with('status', 'memnoduplicate');
        }
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
        $fund = FundInformation::find(1);
        $mem = Member::find($id);
        $vils = Village::all();
        $mtypes = MemberType::all();

        return view('member.member_edit', compact('mem', 'vils','mtypes','fund'));
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
        // $mem = Member::find($id);
        // $no =  $mem->mem_no;
        // echo $no;


        $countNo = Member::where('mem_no','=',$request->mem_no)
                            ->where('mem_id','!=',$id)
                            ->count();

        $countIdCard = Member::where('mem_card_id','=',$request->mem_card_id)
                            ->where('mem_id','!=',$id)
                            ->count();

        if($countNo == 0){
            if($countIdCard == 0){
                if($request->password==''){
                    $mem = Member::find($id);
                    $mem->mem_no = $request->mem_no;
                    $mem->mem_card_id = $request->mem_card_id;
                    $mem->mem_title = $request->mem_title;
                    $mem->mem_fname = $request->mem_fname;
                    $mem->mem_lname = $request->mem_lname;
                    $mem->mem_birthdate = $request->mem_birthdate;
                    $mem->mem_add_no = $request->mem_add_no;
                    $mem->v_id = $request->v_id;
                    $mem->register_date = $request->register_date;
                    $mem->resign_date = $request->resign_date;
                    $mem->mem_status = $request->mem_status;
                    $mem->mem_cause_st = $request->mem_cause_st;
                    $mem->type_mid = $request->type_mid;
                }
                else{
                    $mem = Member::find($id);
                    $mem->mem_no = $request->mem_no;
                    $mem->mem_card_id = $request->mem_card_id;
                    $mem->mem_title = $request->mem_title;
                    $mem->mem_fname = $request->mem_fname;
                    $mem->mem_lname = $request->mem_lname;
                    $mem->mem_birthdate = $request->mem_birthdate;
                    $mem->mem_add_no = $request->mem_add_no;
                    $mem->v_id = $request->v_id;
                    $mem->register_date = $request->register_date;
                    $mem->resign_date = $request->resign_date;
                    $mem->mem_status = $request->mem_status;
                    $mem->mem_cause_st = $request->mem_cause_st;
                    $mem->type_mid = $request->type_mid;
                    $mem->password = bcrypt($request->password);
                }
                $mem->save();
                return redirect('mem')->with('status', 'update');
            }
            else{
                return redirect()->back()->withInput($request->input())->with('status', 'memidcardduplicate');
            }
        }
        else{
            return redirect()->back()->withInput($request->input())->with('status', 'memnoduplicate');
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

    }
}
