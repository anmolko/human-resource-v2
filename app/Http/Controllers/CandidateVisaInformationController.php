<?php

namespace App\Http\Controllers;

use App\Models\AirlineDetail;
use App\Models\CandidateDemandJobInformation;
use App\Models\CandidatePersonalInformation;
use App\Models\CandidateVisaInformation;
use App\Models\DemandInformation;
use App\Models\CandidateSubStatusHistory;
use App\Models\JobCategory;
use App\Models\SubStatus;
use App\Models\TicketingAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class CandidateVisaInformationController extends Controller
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
        $visa_candidates    = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','visa-received');
            })->get();

        $sub_status                  =  SubStatus::all();
        $airline_detail              =  AirlineDetail::all();
        $ticketing_agents            =  TicketingAgent::all();
        $demand_info                 =  DemandInformation::all();
        $job_category                =  JobCategory::all();
        $data                        = getCompanySortedData($visa_candidates);
        return view('admin.candidate.processing.visa_received.index',compact('airline_detail','ticketing_agents','data','visa_candidates','sub_status','demand_info','job_category'));
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
            'visa_number'                           => $request->input('visa_number'),
            'visa_ref_number'                       => $request->input('visa_ref_number'),
            'demand_info_id'                        => $request->input('demand_info_id'),
            'job_to_demand_id'                      => $request->input('job_to_demand_id'),
            'visa_type'                             => $request->input('visa_type'),
            'purpose'                               => $request->input('purpose'),
            'issue_date'                            => $request->input('issue_date'),
            'expiry_date'                           => $request->input('expiry_date'),
            'residency_duration'                    => $request->input('residency_duration'),
            'remarks'                               => $request->input('remarks'),
            'created_by'                            => Auth::user()->id,
        ];

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            $name1 = uniqid() . '_' . $image->getClientOriginalName();
            $path = base_path() . '/public/images/visa/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path, 80)) {
                $data['image'] = $name1;
            }
        }

        $visa_info = CandidateVisaInformation::create($data);
        if ($visa_info) {
            if($request->input('demand_info_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status       = "visa-received";
                $status                           = $candidate_personal->update();


                //updating substatus in candidate demand job info
                $candidate_demand_update                                       =  CandidateDemandJobInformation::find($request->input('demand_job_info_id'));
                $candidate_demand_update->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
                $candidate_demand_update->sub_status_id                        =  $request->input('sub_status_id');
                $candidate_demand_update->remarks                              =  $request->input('status_remarks');
                $candidate_demand_update->status_applied_date                  =  $request->input('status_applied_date');
                $candidate_demand_update->demand_info_id                       =  $request->input('demand_info_id');
                $candidate_demand_update->job_to_demand_id                     =  $request->input('job_to_demand_id');
                $jobdemandstatus                                               =  $candidate_demand_update->update();

                //for history
                $history=[
                    'status'                                => "visa-received",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('status_remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success', 'Candidate status updated to Visa Received Successfully');
        } else {
            Session::flash('error', 'Candidate status could not be updated');
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

    public function getAgentAirline(Request $request)
    {
        $agentID         = $request->id;
        $airlines        = TicketingAgent::with('airline')->find($agentID);
        $airlinesvalue   = [];
        foreach ($airlines->airline  as $air){
            $airlinesvalue[$air->id]= ucwords($air->reference_no);
        }
        return response()->json($airlinesvalue);
    }


}
