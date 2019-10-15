<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Complaint;
use App\FundInformation;

class ComplaintForOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('officer');
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $comps = Complaint::select('complaint.*','members.mem_id','members.mem_no','members.mem_fname','members.mem_lname')
                            ->join('members', 'complaint.mem_id', '=', 'members.mem_id')
                            ->orderBy('comp_date', 'DESC')
                            ->orderBy('comp_id', 'DESC')
                            ->paginate($per_page);
        return view('complaint.complaint_show', compact('comps','fund'));
    }

    public function search(Request $request){
        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);

        $searchDate = $request->get('comp_searchdate');

        if($searchDate == ''){
            $comps = Complaint::select('complaint.*','members.mem_id','members.mem_no','members.mem_fname','members.mem_lname')
                                ->join('members', 'complaint.mem_id', '=', 'members.mem_id')
                                ->orderBy('comp_date', 'DESC')
                                ->orderBy('comp_id', 'DESC')
                                ->paginate($per_page);
        }else if($searchDate != ''){
            $comps = Complaint::select('complaint.*','members.mem_id','members.mem_no','members.mem_fname','members.mem_lname')
                            ->join('members', 'complaint.mem_id', '=', 'members.mem_id')
                            ->where('comp_date', '>=', $searchDate)
                            ->orderBy('comp_date', 'DESC')
                            ->orderBy('comp_id', 'DESC')
                            ->paginate($per_page);
        }
        return view('complaint.complaint_show',compact('comps','fund'));
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
        //
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
