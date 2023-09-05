<?php

namespace App\Http\Controllers;

use App\Models\VisaStamp;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VisaStampController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
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
        $data=[
            'candidate_personal_information_id'     =>$request->input('candidate_personal_information_id'),
            'stamping_forward_date'                 =>$request->input('stamping_forward_date'),
            'stamping_collection_date'              =>$request->input('stamping_collection_date'),
            'visa_stamp_remarks'                    =>$request->input('visa_stamp_remarks'),
            'job_to_demand_id'                      =>$request->input('job_to_demand_id'),
            'remarks'                               =>$request->input('remarks'),
            'sub_status_id'                         =>$request->input('sub_status_id'),
            'created_by'                            =>Auth::user()->id,
        ];
        $status = VisaStamp::create($data);
        
        if($status){
            Session::flash('success','New Visa Stamping Created Successfully');
        }
        else{
            Session::flash('error','New Visa Stamping Creation Failed');
        }
        return redirect()->back();
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
