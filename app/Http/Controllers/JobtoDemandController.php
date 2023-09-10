<?php

namespace App\Http\Controllers;

use App\Models\DemandInformation;
use App\Models\CountrySetting;
use App\Models\JobCategory;
use App\Models\JobtoDemand;
use App\Models\OverseasAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class JobtoDemandController extends Controller
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
        $country_settings = CountrySetting::latest()->get();
        $job_demand    = JobtoDemand::latest()->get();
        $categories    = JobCategory::latest()->get();
        $demands       = DemandInformation::latest()->get();
        return view('admin.jobs_to_demand.index',compact('country_settings','job_demand','demands','categories'));

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

        if($request->input('levy') == null){
            $levy = "no";
        }else{
            $levy = "yes";
        }

        if ($request->input('job_status') == null){
            $status = "incomplete";
        }else{
            $status = "complete";
        }

        $data=[
            'job_category_id'          => $request->input('job_category_id'),
            'demand_information_id'    => $request->input('demand_information_id'),
            'job_status'               => $status,
            'requirements'             => $request->input('requirements'),
            'min_qualification'        => $request->input('min_qualification'),
            'contact_period'           => $request->input('contact_period'),
            'working'                  => $request->input('working'),
            'holidays'                 => $request->input('holidays'),
            'hours'                    => $request->input('hours'),
            'salary'                   => $request->input('salary'),
            'category_amount'          => $request->input('category_amount'),
            'commission_amount'        => $request->input('commission_amount'),
            'overtime_per_month'       => $request->input('overtime_per_month'),
            'currency'                 => $request->input('currency'),
            'accommodation'            => $request->input('accommodation'),
            'food_facilities'          => $request->input('food_facilities'),
            'ticket'                   => $request->input('ticket'),
            'overtime'                 => $request->input('overtime'),
            'medical_in'               => $request->input('medical_in'),
            'medical_company'          => $request->input('medical_company'),
            'insurance_in'             => $request->input('insurance_in'),
            'insurance_company'        => $request->input('insurance_company'),
            'remarks'                  => $request->input('remarks'),
            'levy'                     => $levy,
            'levy_amount'              => $request->input('levy_amount'),
            'created_by'               => Auth::user()->id,
        ];
        $jobstodemand = JobtoDemand::create($data);

        if($jobstodemand){
            Session::flash('success','Jobs added to Demand Successfully.');
        }
        else{
            Session::flash('error','Jobs could not be added to Demand.');
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
        $show = JobtoDemand::with('demandInformation','jobCategory')->find($id);
        return response()->json($show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_job_demand = JobtoDemand::with('demandInformation')->find($id);
        $categories      = JobCategory::latest()->get();
        $demands         = DemandInformation::latest()->get();

        return response()->json(['job_demand_edit'=>$edit_job_demand,'categories'=>$categories,'demands'=>$demands]);
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
        $jobdemand                        =  JobtoDemand::find($id);
        if($request->input('levy') == null){
            $levy = "no";
        }else{
            $levy = "yes";
        }
        if ($request->input('job_status') == null){
            $status = "incomplete";
        }else{
            $status = "complete";
        }
        $jobdemand->job_category_id       =  $request->input('job_category_id');
        $jobdemand->demand_information_id =  $request->input('demand_information_id');
        $jobdemand->job_status            =  $status;
        $jobdemand->requirements          =  $request->input('requirements');
        $jobdemand->min_qualification     =  $request->input('min_qualification');
        $jobdemand->contact_period        =  $request->input('contact_period');
        $jobdemand->working               =  $request->input('working');
        $jobdemand->holidays              =  $request->input('holidays');
        $jobdemand->hours                 =  $request->input('hours');
        $jobdemand->salary                =  $request->input('salary');
        $jobdemand->category_amount       =  $request->input('category_amount');
        $jobdemand->commission_amount     =  $request->input('commission_amount');
        $jobdemand->overtime_per_month    =  $request->input('overtime_per_month');
        $jobdemand->currency              =  $request->input('currency');
        $jobdemand->accommodation         =  $request->input('accommodation');
        $jobdemand->food_facilities       =  $request->input('food_facilities');
        $jobdemand->ticket                =  $request->input('ticket');
        $jobdemand->overtime              =  $request->input('overtime');
        $jobdemand->medical_in            =  $request->input('medical_in');
        $jobdemand->medical_company       =  $request->input('medical_company');
        $jobdemand->insurance_in          =  $request->input('insurance_in');
        $jobdemand->insurance_company     =  $request->input('insurance_company');
        $jobdemand->remarks               =  $request->input('remarks');
        $jobdemand->levy                  =  $levy;
        $jobdemand->levy_amount           =  $request->input('levy_amount');
        $jobdemand->updated_by            =  Auth::user()->id;
        $status = $jobdemand->update();
        if($status){
            Session::flash('success','Jobs details to Demand Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Jobs details to Demand could not be Updated');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletejobdemand    = JobtoDemand::find($id);
        $rid             = $deletejobdemand->id;
        $deletejobdemand->delete();
        return '#jobs_to_demand_'.$rid;
    }

    public function trashindex(){
        $trashed       = JobtoDemand::onlyTrashed()->get();
        $categories    = JobCategory::latest()->get();
        $demands       = DemandInformation::latest()->get();
        return view('admin.jobs_to_demand.trash', compact('trashed','categories','demands'));
    }

    public function restoretrash($id){
        $restoretrash =  JobtoDemand::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Jobs details to Demand Restored');
        }
        else{
            Session::flash('error','Something Went Wrong.Jobs details to Demand could not be Restored');
        }
        return redirect()->route('job-to-demand.trash');
    }

    public function deletetrash($id){
        $trashremoval    = JobtoDemand::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        JobtoDemand::onlyTrashed()->where('id', $id)->forceDelete();
        return  '#jobs_to_demand_'.$rid;
    }

    public function getDemandInfo(Request $request)
    {
        if ($request->ajax()) {
            $demand_id = $request->demand_id;
            $demand_info = DemandInformation::with('demandCompany')->find($demand_id);
            return response($demand_info);
        }
    }

    public function statusupdate(Request $request, $id){
        $agent          = JobtoDemand::find($id);
        $agent->job_status  = $request->job_status;
        $status        = $agent->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }

}
