<?php

namespace App\Http\Controllers;

use App\Models\AirlineDetail;
use App\Models\CandidateDemandHistory;
use App\Models\CandidateDemandJobInformation;
use App\Models\CandidateIndividualTicketing;
use App\Models\CandidatePersonalInformation;
use App\Models\DemandInformation;
use App\Models\CandidateSubStatusHistory;
use App\Models\HealthClinicInformation;
use App\Models\JobCategory;
use App\Models\JournalEntry;
use App\Models\JournalParticular;
use App\Models\SubStatus;
use App\Models\SecondaryGroup;
use App\Models\TicketingAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ProcessingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function appliedindex()
    {
        $applied = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','applied');
            })->get();
        $sub_status             =  SubStatus::latest()->get();
        $demand_info            =  DemandInformation::latest()->get();

        $data = getCompanySortedData($applied);

        return view('admin.candidate.processing.applied.index',compact('sub_status','demand_info','data'));
    }

    public function appliedToSelectedUpdate(Request $request, $id)
    {
        $candidate_demand                                       =  CandidateDemandJobInformation::find($id);
        $candidate_demand->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
        $candidate_demand->sub_status_id                        =  $request->input('sub_status_id');
        $candidate_demand->remarks                              =  $request->input('remarks');
        $candidate_demand->status_applied_date                  =  $request->input('status_applied_date');
        $candidate_demand->demand_info_id                       =  $request->input('demand_info_id');
        $candidate_demand->receivable_salary                    =  $request->input('receivable_salary');
        if ($request->input('job_to_demand_id') !== null){
            $candidate_demand->job_to_demand_id                     =  $request->input('job_to_demand_id');
        }
        $candidate_demand->interview_date                       =  $request->input('interview_date');
        $candidate_demand->interview_remarks                    =  $request->input('interview_remarks');
        $status                                                 =  $candidate_demand->update();
        if($status){
            if($request->input('candidate_personal_information_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status       = "selected";
                $can_status                       = $candidate_personal->update();

                $history=[
                    'status'                                => "selected",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success','Candidate applied demand status updated to selected');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate applied demand status could not be updated');
        }
        return redirect()->back();
    }

    public function selectedindex()
    {
        $selected_candidates    = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','selected');
            })->get();
        $sub_status             =  SubStatus::latest()->get();
        $demand_info            =  DemandInformation::latest()->get();
        $data = getCompanySortedData($selected_candidates);
        return view('admin.candidate.processing.selected.index',compact('sub_status','demand_info','data'));

    }

    public function selectedToUnderProcessUpdate(Request $request, $id)
    {
        $candidate_demand_update                                       =  CandidateDemandJobInformation::find($id);
        $candidate_demand_update->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
        $candidate_demand_update->sub_status_id                        =  $request->input('sub_status_id');
        $candidate_demand_update->remarks                              =  $request->input('remarks');
        $candidate_demand_update->status_applied_date                  =  $request->input('status_applied_date');
        $candidate_demand_update->demand_info_id                       =  $request->input('demand_info_id');
        $candidate_demand_update->job_to_demand_id                     =  $request->input('job_to_demand_id');
        $status                                                        =  $candidate_demand_update->update();
        if($status){
            if($request->input('candidate_personal_information_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status       = "under-process";
                $can_status                       = $candidate_personal->update();

                $history=[
                    'status'                                => "under-process",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success','Candidate selected demand status updated to under process');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate selected demand status could not be updated');
        }
        return redirect()->back();
    }

    public function underprocessindex()
    {
        $under_process_candidates    = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','under-process');
            })->get();
        $sub_status                  =  SubStatus::latest()->get();
        $demand_info                 =  DemandInformation::latest()->get();
        $job_category                =  JobCategory::latest()->get();
        $data                        = getCompanySortedData($under_process_candidates);

        return view('admin.candidate.processing.underprocess.index',compact('under_process_candidates','data','sub_status','demand_info','job_category'));
    }

    public function ticketreceivedindex()
    {
        $ticket_received_candidates  = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','ticket-received');
            })->get();
//        dd($ticket_received_candidates);
        $sub_status                  =  SubStatus::latest()->get();
        $demand_info                 =  DemandInformation::latest()->get();
        $job_category                =  JobCategory::latest()->get();
        $ticketing_agents            =  TicketingAgent::latest()->get();
        $airline_detail              =  AirlineDetail::latest()->get();
        $clinic_detail               =  HealthClinicInformation::latest()->get();
        $data                        =  getCompanySortedData($ticket_received_candidates);

        return view('admin.candidate.processing.ticket_received.index',compact('ticket_received_candidates','ticketing_agents','data','sub_status','airline_detail','clinic_detail','demand_info','job_category'));
    }

    public function visatoTicketReceived(Request $request)
    {
        $data=[
            'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
            'ticket_no'                             => $request->input('ticket_no'),
            'ticketing_agent_id'                    => $request->input('ticketing_agent_id'),
            'booking_date'                          => $request->input('booking_date'),
            'booking_time'                          => $request->input('booking_time'),
            'booking_description'                   => $request->input('booking_description'),
            'airline_id'                            => $request->input('airline_id'),
            'status_applied_date'                   => $request->input('status_applied_date'),
            'remarks'                               => $request->input('remarks'),
            'sub_status_id'                         => $request->input('sub_status_id'),
            'created_by'                            => Auth::user()->id,
        ];
        $ticket_info = CandidateIndividualTicketing::create($data);
        if ($ticket_info) {
            if($request->input('demand_info_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::with('demandJobInfo','referenceInfo')->find($request->input('candidate_personal_information_id'));
                 $candidate_personal->status       = "ticket-received";
                 $status                           = $candidate_personal->update();

                 //updating substatus in candidate demand job info
                $candidate_demand_update                                       =  CandidateDemandJobInformation::find($request->input('demand_job_info_id'));
                $candidate_demand_update->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
                $candidate_demand_update->sub_status_id                        =  $request->input('sub_status_id');
                $candidate_demand_update->remarks                              =  $request->input('remarks');
                $candidate_demand_update->status_applied_date                  =  $request->input('status_applied_date');
                $candidate_demand_update->demand_info_id                       =  $request->input('demand_info_id');
                $candidate_demand_update->job_to_demand_id                     =  $request->input('job_to_demand_id');
                $jobdemandstatus                                               =  $candidate_demand_update->update();


                //journal entry for reference information

                if($candidate_personal->reference_amount !== null ){

                    $slug               = str_replace(" ","_",strtolower($candidate_personal->referenceInfo->name));
                    $secondarygroup     = SecondaryGroup::where("slug",$slug)->first();
                    $ref                = 'JRN-'.str_pad(time() + 1, 8, "0", STR_PAD_LEFT);
                    $journal_entry     = JournalEntry::create([
                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
                        'ref_no'       => $ref,
                        'narration'    => "Journal Entry addition for ".$candidate_personal->referenceInfo->name." for the reference commisson fee",
                        'total_amount' => $candidate_personal->reference_amount,
                        'candidate_personal_id' =>$request->input('candidate_personal_information_id'),
                        'processing_status' =>'ticket-received',
                        'created_by'   => Auth::user()->id,
                    ]);

                    // $latestjournal       = JournalEntry::latest()->first();
                    $journal_particulars_debit = JournalParticular::create([
                        'journal_entry_id'=> $journal_entry->id,
                        'by_debit_id' =>11,
                        'initial_acc_id' =>$secondarygroup->id,
                        'debit_amount' =>$candidate_personal->reference_amount,
                        'credit_amount' =>0,
                        'created_by' =>Auth::user()->id,
                    ]);

                    $journal_particulars_credit = JournalParticular::create([
                        'journal_entry_id'=> $journal_entry->id,
                        'to_credit_id' =>$secondarygroup->id,
                        'initial_acc_id' =>11,
                        'debit_amount' =>0,
                        'credit_amount' =>$candidate_personal->reference_amount,
                        'created_by' =>Auth::user()->id,
                    ]);

                }

                //journal entry for overseas agent

                if($candidate_personal->demandJobInfo->jobtoDemand->commission_amount !== null ){

                    $companynew = str_replace(" ","_",strtolower($candidate_personal->demandJobInfo->overseasInfo->company_name));
                    $slug     = $companynew."_".$candidate_personal->demandJobInfo->overseasInfo->client_no;
                    $secondarygroup     = SecondaryGroup::where("slug",$slug)->first();

                    $ref                = 'JRN-'.str_pad(time() + 3, 8, "0", STR_PAD_LEFT);
                    $journal_entry     = JournalEntry::create([
                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
                        'ref_no'       => $ref,
                        'narration'    => "Journal Entry addition for ".$candidate_personal->demandJobInfo->overseasInfo->company_name." for the overseas commisson fee",
                        'total_amount' => $candidate_personal->demandJobInfo->jobtoDemand->commission_amount,
                        'candidate_personal_id' =>$request->input('candidate_personal_information_id'),
                        'processing_status' =>'ticket-received',
                        'created_by'   => Auth::user()->id,
                    ]);

                    // $latestjournal       = JournalEntry::latest()->first();
                    $journal_particulars_debit = JournalParticular::create([
                        'journal_entry_id'=> $journal_entry->id,
                        'by_debit_id' =>10,
                        'initial_acc_id' =>$secondarygroup->id,
                        'debit_amount' =>$candidate_personal->demandJobInfo->jobtoDemand->commission_amount,
                        'credit_amount' =>0,
                        'created_by' =>Auth::user()->id,
                    ]);

                    $journal_particulars_credit = JournalParticular::create([
                        'journal_entry_id'=> $journal_entry->id,
                        'to_credit_id' =>$secondarygroup->id,
                        'initial_acc_id' =>10,
                        'debit_amount' =>0,
                        'credit_amount' =>$candidate_personal->demandJobInfo->jobtoDemand->commission_amount,
                        'created_by' =>Auth::user()->id,
                    ]);

                }

                //journal entry for candidate commission receivable

                if($candidate_personal->demandJobInfo->jobtoDemand->category_amount !== null ){


                    $first = str_replace(" ","_",strtolower($candidate_personal->candidate_firstname));
                    $middle = str_replace(" ","_",strtolower($candidate_personal->candidate_middlename));
                    $last = str_replace(" ","_",strtolower($candidate_personal->candidate_lastname));
                    $slug     = $first."_".$middle."_".$last."_".$candidate_personal->registration_no;

                    $secondarygroup     = SecondaryGroup::where("slug",$slug)->first();

                    $ref                = 'JRN-'.str_pad(time() + 5, 8, "0", STR_PAD_LEFT);
                    $journal_entry     = JournalEntry::create([
                        'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
                        'ref_no'       => $ref,
                        'narration'    => "Journal Entry addition for ".$candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname." for the commisson receivable",
                        'total_amount' => $candidate_personal->demandJobInfo->jobtoDemand->category_amount,
                        'candidate_personal_id' =>$request->input('candidate_personal_information_id'),
                        'processing_status' =>'ticket-received',
                        'created_by'   => Auth::user()->id,
                    ]);

                    // $latestjournal       = JournalEntry::latest()->first();
                    $journal_particulars_debit = JournalParticular::create([
                        'journal_entry_id'=> $journal_entry->id,
                        'by_debit_id' =>$secondarygroup->id,
                        'initial_acc_id' =>12,
                        'debit_amount' =>$candidate_personal->demandJobInfo->jobtoDemand->category_amount,
                        'credit_amount' =>0,
                        'created_by' =>Auth::user()->id,
                    ]);

                    $journal_particulars_credit = JournalParticular::create([
                        'journal_entry_id'=> $journal_entry->id,
                        'to_credit_id' =>12,
                        'initial_acc_id' =>$secondarygroup->id,
                        'debit_amount' =>0,
                        'credit_amount' =>$candidate_personal->demandJobInfo->jobtoDemand->category_amount,
                        'created_by' =>Auth::user()->id,
                    ]);

                }


                //for history
                $history=[
                    'status'                                => "ticket-received",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success', 'Candidate status updated to Ticket Received Successfully');
        } else {
            Session::flash('error', 'Candidate status could not be updated');
        }
        return redirect()->back();
    }

    public function individualTicketUpdate(Request $request, $id)
    {
        $individual_ticket                                         =  CandidateIndividualTicketing::find($id);
        $individual_ticket->candidate_personal_information_id      =  $request->input('candidate_personal_information_id');
        $individual_ticket->ticket_no                              =  $request->input('ticket_no');
        $individual_ticket->airline_id                             =  $request->input('airline_id');
        $individual_ticket->status_applied_date                    =  $request->input('status_applied_date');
        $individual_ticket->remarks                                =  $request->input('remarks');
        $individual_ticket->sub_status_id                          =  $request->input('sub_status_id');
        $individual_ticket->updated_by                             =  Auth::user()->id;
        $individual_update                                            =  $individual_ticket->update();
        if($individual_update){
            Session::flash('success','Candidate individual ticket information updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate individual ticket information could not be updated');
        }
        return redirect()->back();
    }

    public function ticketReceivedToDeployed(Request $request, $id)
    {
        $candidate_demand_update                                       =  CandidateDemandJobInformation::find($id);
        $candidate_demand_update->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
        $candidate_demand_update->sub_status_id                        =  $request->input('sub_status_id');
        $candidate_demand_update->remarks                              =  $request->input('remarks');
        $candidate_demand_update->status_applied_date                  =  $request->input('status_applied_date');
        $candidate_demand_update->demand_info_id                       =  $request->input('demand_info_id');
        $candidate_demand_update->job_to_demand_id                     =  $request->input('job_to_demand_id');
        $status                                                        =  $candidate_demand_update->update();
        if($status){
            if($request->input('candidate_personal_information_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status       = "deployed";
                $can_status                       = $candidate_personal->update();

                $history=[
                    'status'                                => "deployed",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success','Candidate demand status updated to deployed');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate demand status could not be updated');
        }
        return redirect()->back();
    }

    public function deployedindex()
    {
        $deployed_candidates         = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','deployed');
            })->get();
        $sub_status                  =  SubStatus::latest()->get();
        $demand_info                 =  DemandInformation::latest()->get();
        $job_category                =  JobCategory::latest()->get();
        $airline_detail              =  AirlineDetail::latest()->get();
        $data                        =  getCompanySortedData($deployed_candidates);

        return view('admin.candidate.processing.deployed.index',compact('deployed_candidates','data','sub_status','airline_detail','demand_info','job_category'));
    }

    public function oneStepBackUpdate(Request $request, $id)
    {

        $new_status = "";
        $current_status = $request->input('status');

        if($current_status == 'deployed'){
            $new_status = "ticket-received";
        }elseif ($current_status == 'ticket-received'){
            $candidateinfo = CandidatePersonalInformation::with('individual_ticket')->find($request->input('candidate_personal_information_id'));
            $candidateinfo->individual_ticket->delete();

            $alldeletejournalentry = JournalEntry::with('journalParticulars')
                                    ->where('candidate_personal_id',$request->input('candidate_personal_information_id'))
                                    ->where('processing_status','ticket-received')->get();
            foreach($alldeletejournalentry as $deletejournal){
                $deletejournal->journalParticulars()->delete();

            }
            foreach($alldeletejournalentry as $deletejournal){
                $deletejournal->delete();

            }
            $alltrashremoval = JournalEntry::onlyTrashed()
                            ->where('candidate_personal_id', $request->input('candidate_personal_information_id'))
                            ->where('processing_status','ticket-received')->get();

            foreach($alltrashremoval as $trashremoval){
                $trashremoval->journalParticulars()->forceDelete();

            }
            foreach($alltrashremoval as $trashremoval){
                $trashremoval->forceDelete();

            }

            //removing individual ticket information
            $new_status = "visa-received";
        }elseif ($current_status == 'visa-received'){
            $candidateinfo = CandidatePersonalInformation::with('visa','visa_stamping')->find($request->input('candidate_personal_information_id'));
            if($candidateinfo->visa_stamping !== null){
                $candidateinfo->visa_stamping->delete();
            }
            if($candidateinfo->visa !== null){
                $candidateinfo->visa->delete();
            }
            //removing visa and ticket booking details
            $new_status = "under-process";
        } elseif ($current_status == 'under-process'){
            $new_status = "selected";
        } elseif ($current_status == 'selected'){
            $new_status = "applied";
        }
        $candidate_demand_update                                       =  CandidateDemandJobInformation::find($id);
        $candidate_demand_update->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
        $candidate_demand_update->sub_status_id                        =  $request->input('sub_status_id');
        $candidate_demand_update->remarks                              =  $request->input('remarks');
        $candidate_demand_update->status_applied_date                  =  $request->input('status_applied_date');
        $candidate_demand_update->demand_info_id                       =  $request->input('demand_info_id');
        $candidate_demand_update->job_to_demand_id                     =  $request->input('job_to_demand_id');
        $status                                                        =  $candidate_demand_update->update();
        if($status){
            if($request->input('candidate_personal_information_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status       =  $new_status;
                $can_status                       =  $candidate_personal->update();

                $history=[
                    'status'                                => $new_status,
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success','Candidate demand status was reverted to '.$new_status);
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate demand status could not be reverted');
        }
        return redirect()->back();
    }

    public function statusReapply(Request $request, $id)
    {
        if($request->input('candidate_personal_information_id') !== null) {
            $candidate = CandidatePersonalInformation::with('individual_ticket', 'visa', 'visa_stamping', 'demandJobInfo')->find($request->input('candidate_personal_information_id'));
            $alldeletejournalentry = JournalEntry::with('journalParticulars')
            ->where('candidate_personal_id',$request->input('candidate_personal_information_id'))
            ->where('processing_status','ticket-received')->get();
                foreach($alldeletejournalentry as $deletejournal){
                $deletejournal->journalParticulars()->delete();

                }
                foreach($alldeletejournalentry as $deletejournal){
                $deletejournal->delete();

                }
                $alltrashremoval = JournalEntry::onlyTrashed()
                    ->where('candidate_personal_id', $request->input('candidate_personal_information_id'))
                    ->where('processing_status','ticket-received')->get();

                foreach($alltrashremoval as $trashremoval){
                $trashremoval->journalParticulars()->forceDelete();

                }
                foreach($alltrashremoval as $trashremoval){
                $trashremoval->forceDelete();

                }
            if ($candidate->individual_ticket !== null) {
                $candidate->individual_ticket->delete();
            }
            if ($candidate->visa !== null) {
                $candidate->visa->delete();
            }
            if ($candidate->visa_stamping !== null) {
                $candidate->visa_stamping->delete();
            }
        }

        $candidate_demand                                       =  CandidateDemandJobInformation::find($id);
        $data=[
            'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
            'job_category_id'                       => $candidate_demand->job_category_id,
            'demand_info_id'                        => $request->input('demand_info_id'),
            'job_to_demand_id'                      => $request->input('job_to_demand_id'),
            'overseas_agent_id'                     => $candidate_demand->overseas_agent_id,
            'skills'                                => $candidate_demand->skills,
            'salary'                                => $candidate_demand->salary,
            'receivable_salary'                     => $candidate_demand->receivable_salary,
            'interview_date'                        => $candidate_demand->interview_date,
            'interview_remarks'                     => $candidate_demand->interview_remarks,
            'issued_date'                           => $candidate_demand->issued_date,
            'status_applied_date'                   => $request->input('status_applied_date'),
            'num_of_pax'                            => $candidate_demand->num_of_pax,
            'sub_status_id'                         => $request->input('sub_status_id'),
            'remarks'                               => $request->input('remarks'),
            'created_by'                            => Auth::user()->id,
        ];

        $status = CandidateDemandHistory::create($data);
        if($status){
            if($request->input('candidate_personal_information_id') !== null){
                $candidate->status       =  null;
                $can_status              =  $candidate->update();

                $history=[
                    'status'                                => "reapplied",
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            $candidate_demand->delete();
            $final_status    = CandidateDemandJobInformation::onlyTrashed()->where('id', $id)->forceDelete();
            Session::flash('success','Candidate demand process was reapplied successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate demand process could not be reapplied');
        }
        return redirect()->back();
    }

    public function demandUpdate(Request $request, $id)
    {
        $candidate_demand                                       =  CandidateDemandJobInformation::find($id);
        $candidate_demand->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
        $candidate_demand->status_applied_date                  =  $request->input('status_applied_date');
        $candidate_demand->demand_info_id                       =  $request->input('demand_info_id');
        $candidate_demand->job_to_demand_id                     =  $request->input('job_to_demand_id');
        $status                                                 =  $candidate_demand->update();
        if($status){
            Session::flash('success','Candidate demand has been updated');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate demand could not be updated');
        }
        return redirect()->back();
    }

    public function statusReject(Request $request, $id){
        $new_status                                           = $request->input('status');
        $status_updates                                       =  CandidateDemandJobInformation::find($id);
        $status_updates->candidate_personal_information_id    =  $request->input('candidate_personal_information_id');
        $status_updates->sub_status_id                        =  $request->input('sub_status_id');
        $status_updates->remarks                              =  $request->input('remarks');
        $status_updates->status_applied_date                  =  $request->input('status_applied_date');
        $status_updates->demand_info_id                       =  $request->input('demand_info_id');
        $status_updates->job_to_demand_id                     =  $request->input('job_to_demand_id');
        $status                                               =  $status_updates->update();
        if($status){
            if($request->input('candidate_personal_information_id') !== null){
                $candidate_personal               =  CandidatePersonalInformation::find($request->input('candidate_personal_information_id'));
                $candidate_personal->status       =  $new_status;
                $can_status                       =  $candidate_personal->update();

                $history=[
                    'status'                                => $new_status,
                    'sub_status_id'                         => $request->input('sub_status_id'),
                    'status_applied_date'                   => $request->input('status_applied_date'),
                    'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
                    'remarks'                               => $request->input('remarks'),
                    'created_by'                            => Auth::user()->id,
                ];
                CandidateSubStatusHistory::create($history);
            }
            Session::flash('success','Candidate demand status was updated to '.$new_status);
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate demand status could not be reverted');
        }
        return redirect()->back();
    }

    public function rejectedindex()
    {
        $rejected = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','rejected');
            })->get();
        $sub_status             =  SubStatus::latest()->get();
        $demand_info            =  DemandInformation::latest()->get();

        $data = getCompanySortedData($rejected);

        return view('admin.candidate.processing.rejected.index',compact('sub_status','demand_info','data'));
    }

    public function cancelledindex()
    {
        $rejected = CandidateDemandJobInformation::with('personalInfo','demandInfo','jobtoDemand')
            ->whereHas('personalInfo',function($query){
                $query->where('status','cancelled');
            })->get();
        $sub_status             =  SubStatus::latest()->get();
        $demand_info            =  DemandInformation::latest()->get();

        $data = getCompanySortedData($rejected);

        return view('admin.candidate.processing.cancelled.index',compact('sub_status','demand_info','data'));
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
