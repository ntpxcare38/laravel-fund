<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BenefitType;
use App\Benefit;
use App\Member;
use App\FundInformation;

use Carbon\Carbon;

class BenefitController extends Controller
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

    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $btypes = BenefitType::all();
        $bens = Benefit::orderBy('benefit_date', 'DESC')
                            ->orderBy('benefit_id', 'DESC')
                            ->join('members', 'benefit.mem_id', '=', 'members.mem_id')
                            ->select('benefit.*','members.mem_no','members.mem_fname', 'members.mem_lname')
                            ->paginate( $per_page);
        return view('benefit.benefit_manage', compact('bens','btypes','fund'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fund = FundInformation::find(1);
        $mems = Member::all();
        $btypes = BenefitType::all();
        return view('benefit.benefit_create', compact('mems','btypes','fund'));
    }

    function fetch(Request $request){

        $data = Member::all();
        return response()->json($data);

    }

    function fetchBen(Request $request){

        $data = Benefit::select('benefit.*','members.*')
                        ->join('members', 'benefit.mem_id', '=', 'members.mem_id')->get();
        return response()->json($data);

    }


    public function search(Request $request){

        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $btypes = BenefitType::all();

        $search = $request->get('ben_search');
        $searchDate = $request->get('ben_searchdate');

        if($search =='' && $searchDate == ''){
            $bens = Benefit::select('benefit.*','members.mem_id','members.mem_no','members.mem_fname', 'members.mem_lname')
                            ->join('members', 'benefit.mem_id', '=', 'members.mem_id')
                            ->orderBy('benefit_date', 'DESC')
                            ->orderBy('benefit_id', 'DESC')
                            ->paginate($per_page);
        }
        else if($search !='' && $searchDate == ''){
            $bens= Benefit::select('benefit.*','members.mem_id','members.mem_no','members.mem_fname', 'members.mem_lname')
                            ->join('members', 'benefit.mem_id', '=', 'members.mem_id')
                            ->where(function($query) use($search){
                                $query->where('members.mem_no','like','%'.$search.'%')
                                        ->orWhere('members.mem_fname','like','%'.$search.'%')
                                        ->orWhere('members.mem_lname','like','%'.$search.'%');
                                })
                            ->orderBy('benefit_date', 'DESC')
                            ->orderBy('benefit_id', 'DESC')
                            ->paginate($per_page);
        }
        else if($search =='' && $searchDate != ''){
            $bens= Benefit::select('benefit.*','members.mem_id','members.mem_no','members.mem_fname', 'members.mem_lname')
                            ->join('members', 'benefit.mem_id', '=', 'members.mem_id')
                            ->where(function($query) use($searchDate){
                                $query->where('benefit.benefit_date', '>=', $searchDate);
                                })
                            ->orderBy('benefit_date', 'DESC')
                            ->orderBy('benefit_id', 'DESC')
                            ->paginate($per_page);
        }
        else if($search !='' && $searchDate !=''){
            $bens= Benefit::select('benefit.*','members.mem_id','members.mem_no','members.mem_fname', 'members.mem_lname')
                            ->join('members', 'benefit.mem_id', '=', 'members.mem_id')
                            ->where(function($query) use ($search,$searchDate) {
                                $query->where('members.mem_no','like','%'.$search.'%')
                                        ->orWhere('members.mem_fname','like','%'.$search.'%')
                                        ->orWhere('members.mem_lname','like','%'.$search.'%')
                                        ->where('benefit.benefit_date', '>=', $searchDate);
                            })
                            ->orderBy('benefit_date', 'DESC')
                            ->orderBy('benefit_id', 'DESC')
                            ->paginate($per_page);
        }

        return view('benefit.benefit_manage', compact('bens','btypes','fund'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $day = date("d");
        $month = date("m");
        $year = date("Y")+543;
        $dateObj = ("$year-$month-$day");

        $expDate = Carbon::parse($dateObj)->subYear((60));
        $oldMems = Member::whereDate('mem_birthdate', '<',$expDate)
                            ->where('mem_status','=',1)
                            ->get();

        $benOld = array();

        if($request->ben_status == 1){
            foreach($oldMems as $oldMen){
                array_push($benOld,
                    array(  'mem_id' => $oldMen->mem_id,
                            'benefit_date' => $request->get('benefit_date'),
                            'type_bid' => $request->get('type_bid'),
                            'benefit_price' => $request->get('benefit_price'),
                            'benefit_annotation' => $request->get('benefit_annotation')
                        ),
                );
            }
            Benefit::insert($benOld);
            return redirect('/ben')->with('status', 'save');
        }
        else{
            $this->validate($request,
            [
                'benefit_date' => 'required',
                'type_bid' => 'required',
                'benefit_price' => 'required'
            ]);

            $ben_mem_no = $request->get('mem_no');
            $countMem = Member::where('mem_no','=',$ben_mem_no)->count();

            if($countMem == 1 && $ben_mem_no != ''){
                $mem = Member::where('mem_no','=',$ben_mem_no)->first();
                $ben = new Benefit(
                    [
                    'mem_id' => $mem->mem_id,
                    'benefit_date' => $request->get('benefit_date'),
                    'type_bid' => $request->get('type_bid'),
                    'benefit_price' => $request->get('benefit_price'),
                    'benefit_annotation' => $request->get('benefit_annotation')
                    ]
                );
                $ben->save();
                return redirect('/ben')->with('status', 'save');
            }
            else{
                return redirect()->back()->withInput($request->input())->with('status', 'notfoundmemno');
            }
        }
    }

    /**p
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
        $ben = Benefit::find($id);
        $mem = Member::where('mem_id', '=', $ben->mem_id)->first();
        $btypes = BenefitType::all();
        return view('benefit.benefit_edit', compact('ben','mem','btypes','fund'));
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
            'mem_no' => 'required',
            'benefit_date' => 'required',
            'type_bid' => 'required',
            'benefit_price' => 'required'

        ]);


        $ben_mem_no = $request->get('mem_no');
        $countMem = Member::where('mem_no','=',$ben_mem_no)->count();

        if($countMem == 1){
            $mem = Member::where('mem_no','=',$ben_mem_no)->first();
            $ben = Benefit::where('benefit_id', '=', $id)->first();
            $ben->mem_id = $mem->mem_id;
            $ben->benefit_date = $request->benefit_date;
            $ben->type_bid = $request->type_bid;
            $ben->benefit_price = $request->benefit_price;
            $ben->benefit_annotation = $request->benefit_annotation;
            $ben->save();
            return redirect('/ben')->with('status', 'update');
        }else{
            return redirect()->back()->withInput($request->input())->with('status', 'notfoundmemno');
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
        Benefit::where('benefit_id',"=",$id)->delete();
        return redirect('ben')->with('status', 'delete');
    }
}
