<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\CandidateCV;
use App\Models\CandidatePersonalInformation;

use App\Http\Requests\CandidateCvCreateRequest;
use App\Http\Requests\CandidateCvUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CandidateCvController extends Controller
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
        $candidate_cvs = CandidateCV::with('personalInfo')->get();
        $candidate_personals = CandidatePersonalInformation::all();
        return view('admin.candidate_cv.index',compact('candidate_cvs','candidate_personals'));
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
     public function store(CandidateCvCreateRequest $request)
    {
        $data=[
            'candidate_personal_information_id'    => $request->input('candidate_personal_information_id'),
            'profile'                              => $request->input('profile'),
            'skill'                                => $request->input('skill'),
            'duty'                                 => $request->input('duty'),
            'declaration'                          => $request->input('declaration'),
            'created_by'                           => Auth::user()->id,
        ];
        $cv_info = CandidateCV::create($data);
        if ($cv_info) {
            Session::flash('success', 'Candidate CV Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate CV Info Creation Failed');
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
        $edit            = CandidateCV::find($id);
        $candidate_personal = CandidatePersonalInformation::find($edit->candidate_personal_information_id);

        $name = $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname;

        $candidates       = CandidatePersonalInformation::all();

        return response()->json(['edit'=>$edit,'candidates'=>$candidates,'name'=>$name]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateCvUpdateRequest $request, $id)
    {
      
        $cv                                         =  CandidateCV::find($id);
        $cv->candidate_personal_information_id      =  $request->input('candidate_personal_information_id');
        $cv->profile                                =  $request->input('profile');
        $cv->duty                                   =  $request->input('duty');
        $cv->skill                                  =  $request->input('skill');
        $cv->declaration                            =  $request->input('declaration');
        $cv->updated_by                             = Auth::user()->id;

        $status = $cv->update();
        if($status){

            Session::flash('success','Candiate CV Info  Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candiate CV Info could not be Updated');
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
        $trash       = CandidateCV::find($id);
        $rid         = $trash->id;

        $trash->delete();
        return '#cv_'.$rid;
    }

    public function trashindex()
    {
        $trashed = CandidateCV::onlyTrashed()->with('personalInfo')->get();
        $candidate_personals = CandidatePersonalInformation::all();
        return view('admin.candidate_cv.trash', compact('trashed','candidate_personals'));

    }

    public function restoretrash($id)
    {
        $restoretrash =  CandidateCV::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Candidate CV Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate CV could not be Restored');
        }
        return redirect()->route('candidate-cv-info.trash');
    }

    public function deletetrash($id)
    {
        $trashremoval    = CandidateCV::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        CandidateCV::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#candidate_'.$rid;

    }
}
