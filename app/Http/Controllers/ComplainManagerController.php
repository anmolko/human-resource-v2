<?php

namespace App\Http\Controllers;

use App\Models\CandidatePersonalInformation;
use App\Models\ComplainManager;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ComplainManagerController extends Controller
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
        $employees        = Employee::with('user')->get();
        $candidate        = CandidatePersonalInformation::latest()->get();
        $solved_complains = ComplainManager::where('solved_date', '!=' , null)->get();
        $pending_complain = ComplainManager::where('solved_date', null)->get();

        return view('admin.complain_manager.index',compact('employees','candidate','solved_complains','pending_complain'));
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
        $data = [
            'candidate_info_id'       => $request->input('candidate_info_id'),
            'passport_num'            => $request->input('passport_num'),
            'job_category'            => $request->input('job_category'),
            'company'                 => $request->input('company'),
            'contact_person'          => $request->input('contact_person'),
            'employee_id'             => $request->input('employee_id'),
            'regd_by'                 => $request->input('regd_by'),
            'type'                    => $request->input('type'),
            'priority'                => $request->input('priority'),
            'subject'                 => $request->input('subject'),
            'message'                 => $request->input('message'),
            'regd_date'               => $request->input('regd_date'),
            'status'                  => $request->input('status'),
            'solved_date'             => $request->input('solved_date'),
            'created_by'              => Auth::user()->id,
        ];
        $complain = ComplainManager::create($data);
        if($complain){
            Session::flash('success','Complain Registered Created Successfully');
        }
        else{
            Session::flash('error','Complain Registered Creation Failed');
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
        $show           = ComplainManager::find($id);

        return response()->json(['show'=>$show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit            = ComplainManager::find($id);
        return response()->json(['edit'=>$edit]);

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
        $complain                       =  ComplainManager::find($id);
        $complain->candidate_info_id    =  $request->input('candidate_info_id');
        $complain->passport_num         =  $request->input('passport_num');
        $complain->job_category         =  $request->input('job_category');
        $complain->company              =  $request->input('company');
        $complain->contact_person       =  $request->input('contact_person');
        $complain->regd_by              =  $request->input('regd_by');
        $complain->employee_id          =  $request->input('employee_id');
        $complain->type                 =  $request->input('type');
        $complain->priority             =  $request->input('priority');
        $complain->subject              =  $request->input('subject');
        $complain->message              =  $request->input('message');
        $complain->regd_date            =  $request->input('regd_date');
        $complain->status               =  $request->input('status');
        $complain->solved_date          =  $request->input('solved_date');
        $complain->updated_by           = Auth::user()->id;
        $status = $complain->update();
        if($status){
            Session::flash('success','Complain Manager Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Complain Manager could not be Updated');
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
        $trash       = ComplainManager::find($id);
        $rid         = $trash->id;
        $trash->delete();
        return '#complain_'.$rid;
    }

    public function trashindex()
    {
        $trashed      = ComplainManager::onlyTrashed()->get();
        $employees    = Employee::with('user')->get();
        $candidate    = CandidatePersonalInformation::latest()->get();

        return view('admin.complain_manager.trash', compact('trashed','employees','candidate'));

    }

    public function restoretrash($id)
    {
        $restoretrash =  ComplainManager::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Complain Manager Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Complain Manager could not be Restored');
        }
        return redirect()->route('complain-manager.trash');

    }


    public function deletetrash($id)
    {
        $trashremoval    = ComplainManager::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        ComplainManager::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#complain_manager_'.$rid;
    }

}
