<?php

namespace App\Http\Controllers;

use App\Models\CandidatePCCReport;
use App\Models\CandidatePoliceReport;
use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use CountryState;
use Intervention\Image\ImageManagerStatic as Image;

class CandidatePCCReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'candidate_personal_information_id'         => $request->input('candidate_personal_information_id'),
            'country'                                   => $request->input('country'),
            'issued'                                    => $request->input('issued'),
            'stamping_date'                             => $request->input('stamping_date'),
            'registration_number'                       => $request->input('registration_number'),
            'expiry_date'                               => $request->input('expired_date'),
            'created_by'                                => Auth::user()->id,
        ];

        if(!empty($request->file('image'))) {
            $photograph_image   = $request->file('image');
            $name1              = 'pcc_'.uniqid() . '_' . $photograph_image->getClientOriginalName();
            $photograph_path    = base_path() . '/public/images/document/' . $name1;
            $image_resize       = Image::make($photograph_image->getRealPath())->orientate();
            if ($image_resize->save($photograph_path, 80)) {
                $data['image'] = $name1;
            }

            $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

            File::create([
                'folder_id'         => $folder_info->id,
                'filename'          => $name1,
                'type'              => 'report',
                'created_by'        => Auth::user()->id,

            ]);

        }

        $info = CandidatePCCReport::create($data);

        if ($info) {
            Session::flash('success', 'Candidate PCC Report Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate PCC Report Info Creation Failed');
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
        $show         = CandidatePCCReport::find($id);
        $issued       = Carbon::parse($show->issued)->isoFormat('MMMM Do, YYYY');
        $stamp        = Carbon::parse($show->stamping_date)->isoFormat('MMMM Do, YYYY');
        $expiry       = Carbon::parse($show->expiry_date)->isoFormat('MMMM Do, YYYY');
        $countries    = CountryState::getCountries();
        $country_name = "";

        foreach($countries as $key => $value){
            if($key == $show->country){
                $country_name = ucfirst($value);
            }
        }



        return response()->json(['show'=>$show,'issued'=>$issued,'stamp'=>$stamp,'expiry'=>$expiry,'country'=>$country_name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = CandidatePCCReport::find($id);
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
        $report                                      =  CandidatePCCReport::find($id);
        $report->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $report->country                             =  $request->input('country');
        $report->issued                              =  $request->input('issued');
        $report->stamping_date                       =  $request->input('stamping_date');
        $report->registration_number                 =  $request->input('registration_number');
        $report->expiry_date                         =  $request->input('expiry_date');
        $old_image                                   =  $report->image;


        if (!empty($request->file('image'))){
            $image          =  $request->file('image');
            $name1          = 'pcc_'.uniqid().'_'.$image->getClientOriginalName();
            $path           = base_path().'/public/images/document/'.$name1;
            $image_resize   = Image::make($image->getRealPath())->orientate();

            if ($image_resize->save($path,80)){
                $report->image  = $name1;
                if (!empty($old_image) && file_exists(public_path().'/images/document/'.$old_image)){
                    @unlink(public_path().'/images/document/'.$old_image);
                }
            }
            $folder_info = File::where('filename',$old_image)->first();
            if($folder_info){
                $folder_info->filename             =  $name1;
                $folder_info->update();
            }else{
                $folder = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();
                File::create([
                    'folder_id'         => $folder->id,
                    'filename'          => $name1,
                    'type'              => 'report',
                    'created_by'        => Auth::user()->id,

                ]);
            }

        }


        $status = $report->update();
        if($status){
            Session::flash('success','Candidate PCC Report Info Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate PCC Report Info could not be Updated');
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
        $trash           = CandidatePCCReport::find($id);
        $trash_status    = $trash->delete();
        if($trash_status) {
            $status = CandidatePCCReport::onlyTrashed()->where('id', $id)->get();
            if (!empty($status[0]->image) && file_exists(public_path() . '/images/document/' . $status[0]->image)) {
                @unlink(public_path() . '/images/document/' . $status[0]->image);
            }
            $final_status    = CandidatePCCReport::onlyTrashed()->where('id', $id)->forceDelete();
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
