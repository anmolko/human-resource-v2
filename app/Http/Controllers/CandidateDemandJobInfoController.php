<?php

namespace App\Http\Controllers;

use App\Models\CandidateDemandHistory;
use App\Models\CandidateDemandJobInformation;
use App\Models\CandidatePersonalInformation;
use App\Models\DemandInformation;
use App\Models\CandidateSubStatusHistory;
use App\Models\JobCategory;
use App\Models\JobtoDemand;
use App\Models\OverseasAgent;
use App\Models\SubStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CandidateDemandJobInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:web,agent');

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
        'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
        'job_category_id'                       => $request->input('job_category_id'),
        'demand_info_id'                        => $request->input('demand_info_id'),
        'job_to_demand_id'                      => $request->input('job_to_demand_id'),
        'overseas_agent_id'                     => $request->input('overseas_agent_id'),
        'skills'                                => $request->input('skills'),
        'salary'                                => $request->input('salary'),
        'receivable_salary'                     => $request->input('receivable_salary'),
        'issued_date'                           => $request->input('issued_date'),
        'status_applied_date'                   => $request->input('status_applied_date'),
        'num_of_pax'                            => $request->input('num_of_pax'),
        'sub_status_id'                         => $request->input('sub_status_id'),
        'remarks'                               => $request->input('remarks'),
        'created_by'                            => Auth::user()->id,
    ];

        $demand_job_info = CandidateDemandJobInformation::create($data);
        if ($demand_job_info) {
            if($request->input('demand_info_id') !== null){
                $candidate_personal                      =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status              = "applied";
                $candidate_personal->reference_amount    = $request->input('reference_amount');
                $status                           = $candidate_personal->update();

                //for history
                $history=[
                    'status'                                => "applied",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success', 'Candidate Demand Job Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate Demand Job Info Creation Failed');
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
        $candidate_demand   = CandidateDemandJobInformation::find($id);
        $issued             = Carbon::parse($candidate_demand->issued_date)->isoFormat('MMMM Do, YYYY');
        $applied            = Carbon::parse($candidate_demand->status_applied_date)->isoFormat('MMMM Do, YYYY');
        $cat                = JobCategory::find($candidate_demand->job_category_id)->name;
        $substatus                = SubStatus::find($candidate_demand->sub_status_id)->name;
        if($candidate_demand->demand_info_id !== null){
            $comp_name          = DemandInformation::find($candidate_demand->demand_info_id)->company_name;
            $assigned_cat       = JobtoDemand::with('jobCategory')->find($candidate_demand->job_to_demand_id);
            $agent_name         = OverseasAgent::find($candidate_demand->overseas_agent_id)->fullname;
        }else{
            $comp_name = "Not Set";
            $assigned_cat = "Not Set";
            $agent_name = "Not Set";
        }
        return response()->json(['show'=>$candidate_demand,'issued_date'=>$issued,'status_applied_date'=>$applied,'job_category'=>$cat,'company_name'=>$comp_name,'assigned_category'=>$assigned_cat,'agent_name'=>$agent_name,'sub_status'=>$substatus]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate_demand       = CandidateDemandJobInformation::with('personalInfo')->find($id);
        $jobs                   = JobtoDemand::with('jobCategory')->where('demand_information_id',$candidate_demand->demand_info_id)->get();
        $response = [];
        foreach( $jobs as $job )
        {
            $response[$job->id] = $job->jobCategory->name;
        }
        return response()->json(['edit'=>$candidate_demand,'response'=>$response]);
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
        $candidate_demand                                      =  CandidateDemandJobInformation::find($id);
        $candidate_demand->skills                              =  $request->input('skills');
        $candidate_demand->job_category_id                     =  $request->input('job_category_id');
        $candidate_demand->salary                              =  $request->input('salary');
        $candidate_demand->receivable_salary                   =  $request->input('receivable_salary');
        $candidate_demand->demand_info_id                      =  $request->input('demand_info_id');
        $candidate_demand->job_to_demand_id                    =  $request->input('job_to_demand_id');
        $candidate_demand->issued_date                         =  $request->input('issued_date');
        $candidate_demand->status_applied_date                 =  $request->input('status_applied_date');
        $candidate_demand->num_of_pax                          =  $request->input('num_of_pax');
        $candidate_demand->overseas_agent_id                   =  $request->input('overseas_agent_id');
        $candidate_demand->sub_status_id                       =  $request->input('sub_status_id');
        $candidate_demand->remarks                             =  $request->input('remarks');
        $candidate_demand->updated_by                          =  Auth::user()->id;

        $status                                                =  $candidate_demand->update();
        if($status){
                $candidate_personal                      =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->reference_amount    = $request->input('reference_amount');
                $status                                  = $candidate_personal->update();

            Session::flash('success','Candidate Demand Jobs Info Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Demand Jobs Info could not be Updated');
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
        $trash           = CandidateDemandJobInformation::find($id);
        $rid             = $trash->id;
        $data=[
            'candidate_personal_information_id'     => $trash->candidate_personal_information_id,
            'job_category_id'                       => $trash->job_category_id,
            'demand_info_id'                        => $trash->demand_info_id,
            'job_to_demand_id'                      => $trash->job_to_demand_id,
            'overseas_agent_id'                     => $trash->overseas_agent_id,
            'skills'                                => $trash->skills,
            'salary'                                => $trash->salary,
            'receivable_salary'                     => $trash->receivable_salary,
            'interview_date'                        => $trash->interview_date,
            'interview_remarks'                     => $trash->interview_remarks,
            'issued_date'                           => $trash->issued_date,
            'status_applied_date'                   => $trash->status_applied_date,
            'num_of_pax'                            => $trash->num_of_pax,
            'sub_status_id'                         => $trash->sub_status_id,
            'remarks'                               => $trash->remarks,
            'created_by'                            => Auth::user()->id,
        ];

        $status          = CandidateDemandHistory::create($data);

        if($status){
            $candidate = CandidatePersonalInformation::with('individual_ticket', 'visa', 'visa_stamping', 'demandJobInfo')->find($trash->candidate_personal_information_id);
            if ($candidate->individual_ticket !== null) {
                $candidate->individual_ticket->delete();
            } elseif ($candidate->visa !== null) {
                $candidate->visa->delete();
            } elseif ($candidate->visa_stamping !== null) {
                $candidate->visa_stamping->delete();
            }
            $candidate->status       =  null;
            $can_status              =  $candidate->update();


            $trash_status    = $trash->delete();
            $final_status    = CandidateDemandJobInformation::onlyTrashed()->where('id', $id)->forceDelete();
            if ($final_status){
                return response()->json('success');
            }else{
                return response()->json('failed');
            }
        }else{
            return response()->json('failed');
        }
    }
}
