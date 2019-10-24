<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personnel;
use App\PositionFund;
use App\PositionCom;
use App\FundInformation;
use File;

class PersonnelController extends Controller
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

    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $pfunds = PositionFund::all();
        $pcoms = PositionCom::all();
        $pers = Personnel::orderBy('p_id', 'DESC')->paginate($per_page);

        return view('personnel.personnel_manage', compact('pers', 'pcoms','pfunds','fund'));

    }

    function fetchPer(Request $request){

        $data = Personnel::all();
        return response()->json($data);

    }

    public function search(Request $request){

        $per_page = $request->get('per_page');
        if($per_page==''){
            $per_page = 10;
        }

        $fund = FundInformation::find(1);
        $pfunds = PositionFund::all();
        $pcoms = PositionCom::all();

        $search = $request->get('per_search');
        //$searchDate = $request->get('mem_searchdate');

        if($search !=''){
            $pers = Personnel::where('p_fname','like','%'.$search.'%')
                            ->orWhere('p_lname','like','%'.$search.'%')
                            ->orderBy('p_id', 'DESC')
                            ->paginate($per_page);
        }
        else{
            $pers = Personnel::orderBy('p_id', 'DESC')->paginate($per_page);
        }

        return view('personnel.personnel_manage', compact('pers', 'pcoms','pfunds','fund'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fund = FundInformation::find(1);
        $pfunds = PositionFund::all();
        $pcoms = PositionCom::all();

        return view('personnel.personnel_create', compact('pcoms','pfunds','fund'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save upload image to 'avatar' folder which in 'storage/app/public' folder
        $path = $path = $request->file('p_photo');


        if($path ==''){
            $path ='avatar/none_profile.jpeg';
        }else{
            $path = $request->file('p_photo')->store('avatar','public');
        }

        $this->validate($request,
        [
            'p_title' => 'required|integer',
            'p_fname' => 'required',
            'p_lname' => 'required',
            'position_fid' => 'required|integer',
            'position_cid' => 'required|integer',
            'p_tel' => 'required',
            'p_username' => 'required',
            'password' => 'required',
            'type_pid' => 'required|integer'

        ]);

        $countUser = Personnel::where('p_username','=',$request->p_username)->count();

        if($countUser==0){
            $Per = new Personnel(
                [
                    'p_title' => $request->get('p_title'),
                    'p_fname' => $request->get('p_fname'),
                    'p_lname' => $request->get('p_lname'),
                    'p_photo' => $path,
                    'position_fid' => $request->get('position_fid'),
                    'position_cid' => $request->get('position_cid'),
                    'p_tel' => $request->get('p_tel'),
                    'type_pid' => $request->get('type_pid'),
                    'p_username' => $request->get('p_username'),
                    'password' => bcrypt($request->get('password'))

                ]
            );
            $Per->save();
            return redirect('/per')->with('status', 'save');
        }else{
            return redirect()->back()->withInput($request->input())->with('status', 'usernameduplicate');
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
        $per = Personnel::find($id);
        $pfunds = PositionFund::all();
        $pcoms = PositionCom::all();

        return view('personnel.personnel_edit', compact('per', 'pcoms','pfunds','fund'));
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
        $def_photo = 'avatar/none_profile.jpeg';
        if($request->password==''){
            $per = Personnel::find($id);
            if($request->hasFile('p_photo')){
                if($per->p_photo!=$def_photo){
                    File::delete(public_path('storage/'.$per->p_photo));
                }
                $per->p_photo = $request->file('p_photo')->store('avatar','public');
            }
            $per->p_title = $request->p_title;
            $per->p_fname = $request->p_fname;
            $per->p_lname = $request->p_lname;
            $per->position_fid = $request->position_fid;
            $per->position_cid = $request->position_cid;
            $per->p_tel = $request->p_tel;
            $per->type_pid = $request->type_pid;
            $per->save();
        }
        else{
            $per = Personnel::find($id);
            if($request->hasFile('p_photo')){
                if($per->p_photo!=$def_photo){
                    File::delete(public_path('storage/'.$per->p_photo));
                }
                $per->p_photo = $request->file('p_photo')->store('avatar','public');
            }
            $per->p_title = $request->p_title;
            $per->p_fname = $request->p_fname;
            $per->p_lname = $request->p_lname;
            $per->position_fid = $request->position_fid;
            $per->position_cid = $request->position_cid;
            $per->p_tel = $request->p_tel;
            $per->type_pid = $request->type_pid;
            $per->password = bcrypt($request->password);
            $per->save();
        }
        return redirect('per')->with('status', 'update');

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

    public function viewphoto($path, $filename){

        $path = public_path(). '/storage/'. $path.'/'.$filename;
        return response()->file($path);
    }

}
