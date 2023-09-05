<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfessionalInformation;
use App\Models\CandidateProfessionalTraining;
use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use CountryState;
use Intervention\Image\ImageManagerStatic as Image;

class CandidateProfessionalInformationController extends Controller
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

    //for professional training information
    public function trainingindex()
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

    //for professional training information
    public function trainingcreate()
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
            'candidate_personal_information_id'    => $request->input('candidate_personal_information_id'),
            'job_ref_no'                           => $request->input('job_ref_no'),
            'company_name'                         => $request->input('company_name'),
            'address'                              => $request->input('address'),
            'country'                              => $request->input('country'),
            'category_of_job'                      => $request->input('category_of_job'),
            'designation'                          => $request->input('designation'),
            'duration'                             => $request->input('duration'),
            'from'                                 => $request->input('from'),
            'to'                                   => $request->input('to'),
            'created_by'                           => Auth::user()->id,
        ];

        if(!empty($request->file('document'))) {
            $image          = $request->file('document');
            $name1          = 'professional_'.uniqid() . '_' . $image->getClientOriginalName();
            $path           = base_path() . '/public/images/professional/' . $name1;
            $image_resize   = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path, 80)) {
                $data['document'] = $name1;
            }
            $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

            File::create([
                'folder_id'         => $folder_info->id,
                'filename'          => $name1,
                'type'              => 'professional_experience',
                'created_by'        => Auth::user()->id,

            ]);
        }

        $professional_info = CandidateProfessionalInformation::create($data);


        if ($professional_info) {
            Session::flash('success', 'Candidate Professional Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate Professional Info Creation Failed');
        }
        return redirect()->back();
    }

    //for professional training information
    public function trainingstore(Request $request){
         $training_data=[
            'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
            'certificate_no'                        => $request->input('certificate_no'),
            'institute_name'                        => $request->input('institute_name'),
            'training_type'                         => $request->input('training_type'),
            'country'                               => $request->input('country'),
            'duration'                              => $request->input('duration'),
            'created_by'                            => Auth::user()->id,
        ];

        if(!empty($request->file('certificate'))) {
            $image          = $request->file('certificate');
            $name1          = 'certificate_'.uniqid() . '_' . $image->getClientOriginalName();
            $path           = base_path() . '/public/images/professional/' . $name1;
            $image_resize   = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path, 80)) {
                $training_data['certificate'] = $name1;
            }
            $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

            File::create([
                'folder_id'         => $folder_info->id,
                'filename'          => $name1,
                'type'              => 'professional_trainings',
                'created_by'        => Auth::user()->id,
            ]);
        }

        $training_info = CandidateProfessionalTraining::create($training_data);
        if ($training_info) {
            Session::flash('success', 'Candidate Professional Training Added Successfully');
        } else {
            Session::flash('error', 'Candidate Professional Training Creation Failed');
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
        $show          = CandidateProfessionalInformation::find($id);
        $show_country  = $show->country;
        $show_from     = Carbon::parse($show->from)->isoFormat('MMMM Do, YYYY');
        $show_to       = Carbon::parse($show->to)->isoFormat('MMMM Do, YYYY');
        $show_duration = str_replace("-"," ",$show->duration);
        $countries     = CountryState::getCountries();
        foreach ($countries as $key => $value){
            if($key==$show_country){
                $send_country = $value;
            }
        }

        return response()->json(['show'=>$show,'country'=>$send_country,'duration'=>$show_duration,'from'=>$show_from,'to'=>$show_to]);
    }


    public function trainingshow($id){
        $showtraining     = CandidateProfessionalTraining::find($id);
        $show_country     = $showtraining->country;
        $countries        = CountryState::getCountries();
        foreach ($countries as $key => $value){
            if($key==$show_country){
                $send_country = $value;
            }
        }

        return response()->json(['showtraining'=>$showtraining,'country'=>$send_country]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate_professional = CandidateProfessionalInformation::find($id);
        $edit_country  = $candidate_professional->country;
        $countries     = CountryState::getCountries();
        foreach ($countries as $key => $value){
            if($key==$edit_country){
                $send_country = $value;
            }
        }
        return response()->json(['edit'=>$candidate_professional,'countryname'=>$send_country]);
    }

    //for professional training information
    public function trainingedit($id){
        $candidate_trainings = CandidateProfessionalTraining::find($id);
        $edit_country  = $candidate_trainings->country;
        $countries     = CountryState::getCountries();
        foreach ($countries as $key => $value){
            if($key==$edit_country){
                $send_country = $value;
            }
        }
        return response()->json(['edit'=>$candidate_trainings,'countries'=>$send_country]);
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
        $candidate_prof                                      =  CandidateProfessionalInformation::find($id);
        $candidate_prof->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_prof->job_ref_no                          =  $request->input('job_ref_no');
        $candidate_prof->company_name                        =  $request->input('company_name');
        $candidate_prof->address                             =  $request->input('address');
        $candidate_prof->country                             =  $request->input('country');
        $candidate_prof->category_of_job                     =  $request->input('category_of_job');
        $candidate_prof->designation                         =  $request->input('designation');
        $candidate_prof->duration                            =  $request->input('duration');
        $candidate_prof->from                                =  $request->input('from');
        $candidate_prof->to                                  =  $request->input('to');
        $candidate_prof->updated_by                          =  Auth::user()->id;
        $old_image                                           =  $candidate_prof->document;

        if (!empty($request->file('document'))){
            $image =$request->file('document');
            $name1 = 'professional_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/professional/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path,80)){
                $candidate_prof->document= $name1;
                if (!empty($old_image) && file_exists(public_path().'/images/professional/'.$old_image)){
                    @unlink(public_path().'/images/professional/'.$old_image);
                }
            }


            $folder_info = File::where('filename',$old_image)->first();
            $folder_info->filename             =  $name1;
            $folder_info->update();

        }

        $status = $candidate_prof->update();
        if($status){
            Session::flash('success','Candidate Professional Information Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Professional Information could not be Updated');
        }
        return redirect()->back();
    }

    //for professional training information
    public function trainingupdate(Request $request, $id){
        $candidate_train                                      =  CandidateProfessionalTraining::find($id);
        $candidate_train->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_train->certificate_no                      =  $request->input('certificate_no');
        $candidate_train->training_type                       =  $request->input('training_type');
        $candidate_train->country                             =  $request->input('country');
        $candidate_train->duration                            =  $request->input('duration');
        $old_image                                            =  $candidate_train->certificate;


        if (!empty($request->file('certificate'))){
            $image =$request->file('certificate');
            $name1 = 'certificate_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/professional/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path,80)){
                $candidate_train->certificate = $name1;
                if (!empty($old_image) && file_exists(public_path().'/images/professional/'.$old_image)){
                    @unlink(public_path().'/images/professional/'.$old_image);
                }
            }


            if($old_image !== null){
                $folder_info                    = File::where('filename',$old_image)->first();
                $folder_info->filename          =  $name1;
                $folder_info->update();
            }
        }

        $status                                               =  $candidate_train->update();

        if($status){
            Session::flash('success','Candidate Professional Training Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Professional Training could not be Updated');
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
        $trash           = CandidateProfessionalInformation::find($id);
        $rid             = $trash->id;
        if (!empty($trash->document) && file_exists(public_path().'/images/professional/'.$trash->document)){
            @unlink(public_path().'/images/professional/'.$trash->document);
        }
        $trash_status    = $trash->delete();

        if($trash_status){

            $final_status    = CandidateProfessionalInformation::onlyTrashed()->where('id', $id)->forceDelete();
           if ($final_status){
               return response()->json('success');
           }else{
               return response()->json('failed');
           }
        }else{
            return response()->json('failed');
        }
    }

    //for professional training information
    public function trainingdestroy($id){
        $trash           = CandidateProfessionalTraining::find($id);
        if (!empty($trash->certificate) && file_exists(public_path().'/images/professional/'.$trash->certificate)){
            @unlink(public_path().'/images/professional/'.$trash->certificate);
        }
        $trash_status    = $trash->delete();
        if($trash_status){
            $final_status    = CandidateProfessionalTraining::onlyTrashed()->where('id', $id)->forceDelete();
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
