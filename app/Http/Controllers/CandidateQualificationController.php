<?php

namespace App\Http\Controllers;

use App\Models\CandidateLanguageInformation;
use App\Models\CandidateProfessionalTraining;
use App\Models\CandidateQualificationInformation;
use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class CandidateQualificationController extends Controller
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

    //for language info
    public function languageindex()
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

    //for language info
    public function languagecreate()
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
            'school_college_name'                   => $request->input('school_college_name'),
            'academic_level'                        => $request->input('academic_level'),
            'address'                               => $request->input('address'),
            'completed_on'                          => $request->input('completed_on'),
            'division'                              => $request->input('division'),
            'result'                                => $request->input('result'),
            'created_by'                            => Auth::user()->id,
        ];


        if(!empty($request->file('document'))) {
            $image          = $request->file('document');
            $name1          = 'qualification_'.uniqid() . '_' . $image->getClientOriginalName();
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

        $qualification_info = CandidateQualificationInformation::create($data);

        if ($qualification_info) {
            Session::flash('success', 'Candidate Qualification Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate Qualification Info Creation Failed');
        }
        return redirect()->back();
    }

    //for language info
    public function languagestore(Request $request){
        $data=[
            'candidate_personal_information_id'  => $request->input('candidate_personal_information_id'),
            'language'                           => $request->input('language'),
            'speaking'                           => $request->input('speaking'),
            'reading'                            => $request->input('reading'),
            'writing'                            => $request->input('writing'),
            'created_by'                         => Auth::user()->id,
        ];
        $language_info = CandidateLanguageInformation::create($data);
        if ($language_info) {
            Session::flash('success', 'Candidate Language Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate Language Info Creation Failed');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $show         = CandidateQualificationInformation::find($id);
        $completed_on = Carbon::parse($show->completed_on)->isoFormat('MMMM Do, YYYY');
        $division     = ucfirst(str_replace('-',' ',$show->division));
        return response()->json(['show'=>$show,'completed_on'=>$completed_on,'division'=>$division]);

    }

    //for language info
    public function languageshow($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate_qualification = CandidateQualificationInformation::find($id);
        return response()->json(['edit'=>$candidate_qualification]);
    }

    //for language info
    public function languageedit($id){
        $candidate_language = CandidateLanguageInformation::find($id);
        return response()->json(['edit'=>$candidate_language]);
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
        $candidate_qualification                                      =  CandidateQualificationInformation::find($id);
        $candidate_qualification->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_qualification->school_college_name                 =  $request->input('school_college_name');
        $candidate_qualification->academic_level                      =  $request->input('academic_level');
        $candidate_qualification->address                             =  $request->input('address');
        $candidate_qualification->completed_on                        =  $request->input('completed_on');
        $candidate_qualification->division                            =  $request->input('division');
        $candidate_qualification->result                              =  $request->input('result');
        $candidate_qualification->updated_by                          = Auth::user()->id;


        $old_image                                                    =  $candidate_qualification->document;

        if (!empty($request->file('document'))){
            $image          = $request->file('document');
            $name1          = 'qualification_'.uniqid().'_'.$image->getClientOriginalName();
            $path           = base_path().'/public/images/professional/'.$name1;
            $image_resize   = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path,80)){
                $candidate_qualification->document= $name1;
                if (!empty($old_image) && file_exists(public_path().'/images/professional/'.$old_image)){
                    @unlink(public_path().'/images/professional/'.$old_image);
                }

            }


            $folder_info = File::where('filename',$old_image)->first();
            $folder_info->filename             =  $name1;
            $folder_info->update();

        }


        $status                                                       = $candidate_qualification->update();
        if($status){
            Session::flash('success','Candidate Qualification Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Qualification could not be Updated');
        }
        return redirect()->back();
    }

    //for language info
    public function languageupdate(Request $request, $id){
        $candidate_language                                      =  CandidateLanguageInformation::find($id);
        $candidate_language->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_language->language                            =  $request->input('language');
        $candidate_language->speaking                            =  $request->input('speaking');
        $candidate_language->reading                             =  $request->input('reading');
        $candidate_language->writing                             =  $request->input('writing');
        $candidate_language->updated_by                          = Auth::user()->id;
        $status                                                  = $candidate_language->update();
        if($status){
            Session::flash('success','Candidate Language Info Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Language Info could not be Updated');
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
        $trash           = CandidateQualificationInformation::find($id);
        if (!empty($trash->document) && file_exists(public_path().'/images/professional/'.$trash->document)){
            @unlink(public_path().'/images/professional/'.$trash->document);
        }
        $trash_status    = $trash->delete();
        if($trash_status){
            $final_status    = CandidateQualificationInformation::onlyTrashed()->where('id', $id)->forceDelete();
            if ($final_status){
                return response()->json('success');
            }else{
                return response()->json('failed');
            }
        }else{
            return response()->json('failed');
        }
    }


    //for language info
    public function languagedestroy($id){
        $trash           = CandidateLanguageInformation::find($id);
        $trash_status    = $trash->delete();
        if($trash_status){
            $final_status    = CandidateLanguageInformation::onlyTrashed()->where('id', $id)->forceDelete();
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
