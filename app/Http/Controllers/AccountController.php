<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\GroupAcc;
use App\FundInformation;

class AccountController extends Controller
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
        $acs = Account::orderBy('acc_id', 'DESC')->paginate( $per_page);
        $gcs = GroupAcc::all();

        return view('account.account_manage',compact('acs','gcs','fund'));

    }

    function fetchAc(Request $request){

        $data = Account::all();
        return response()->json($data);

    }

    public function search(Request $request)
    {
        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $gcs = GroupAcc::all();
        $fund = FundInformation::find(1);

        $search = $request->get('ac_search');
        $searchDate = $request->get('acc_searchdate');

        if($search =='' && $searchDate == ''){
            $acs = Account::orderBy('acc_id', 'DESC')->paginate($per_page);
        }else if($search !='' && $searchDate == ''){
            $acs = Account::where('acc_id','like','%'.$search)
                            ->orWhere('acc_name','like','%'.$search.'%')
                            ->orderBy('acc_id', 'DESC')
                            ->paginate($per_page);
        }else if($search =='' && $searchDate != ''){
            $acs = Account::where('acc_date', '=', $searchDate)
                            ->orderBy('acc_id', 'DESC')
                            ->paginate($per_page);
        }else if($search !='' && $searchDate !=''){
            $acs = Account::where(function($query) use ($search) {
                                $query->where('acc_id', 'like', '%'.$search)
                                        ->orWhere('acc_name', 'like', '%'.$search.'%');
                            })
                            ->where('acc_date', '=', $searchDate)
                            ->orderBy('acc_id', 'DESC')
                            ->paginate($per_page);
        }
        return view('account.account_manage',compact('acs','gcs','fund'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gcs = GroupAcc::all();
        $fund = FundInformation::find(1);

        return view('account.account_create',compact('gcs','fund'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $this->validate($request,
        [
            'acc_name' => 'required',
            'acc_date' => 'required',
            'group_acid' => 'required',
            'acc_piece' => 'required',
            'acc_price' => 'required',
            'acc_total' => 'required'
        ]);

        $ac = new Account(
            [
                'acc_name' => $request->get('acc_name'),
                'acc_date' => $request->get('acc_date'),
                'group_acid' => $request->get('group_acid'),
                'acc_piece' => $request->get('acc_piece'),
                'acc_price' => $request->get('acc_price'),
                'acc_total' => $request->get('acc_total')
            ]
        );
        $ac->save();
        return redirect('/ac')->with('status', 'save');
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
        $ac = Account::where('acc_id','=',$id)->first();
        $gcs = GroupAcc::all();
        $fund = FundInformation::find(1);

        return view('account.account_edit', compact('ac','gcs','fund'));
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
            'acc_piece' => 'required',
            'acc_price' => 'required',
            'acc_total' => 'required'
        ]);

        $ac = Account::where('acc_id', '=', $id)->first();
        $ac->acc_name = $request->acc_name;
        $ac->acc_date = $request->acc_date;
        $ac->group_acid = $request->group_acid;
        $ac->acc_piece = $request->acc_piece;
        $ac->acc_price = $request->acc_price;
        $ac->acc_total = $request->acc_total;
        $ac->save();
        return redirect('ac')->with('status', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Account::where('acc_id',"=",$id)->delete();
        return redirect('ac')->with('status', 'delete');
    }
}
