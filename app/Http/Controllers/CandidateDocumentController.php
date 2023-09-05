<?php

namespace App\Http\Controllers;

use App\Models\CandidateBankInformation;
use App\Models\CandidateDocumentInformation;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class CandidateDocumentController extends Controller
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

    public function bankindex()
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

    public function bankcreate()
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
        $document_data=[
            'candidate_personal_information_id'         => $request->input('candidate_personal_information_id'),
            'resume'                                    => $request->input('resume'),
            'original_passport'                         => $request->input('original_passport'),
            'passport_xerox_copy'                       => $request->input('passport_xerox_copy'),
            'academic_certificates'                     => $request->input('academic_certificates'),
            'original_academic'                         => $request->input('original_academic'),
            'professional_training'                     => $request->input('professional_training'),
            'work_certificates'                         => $request->input('work_certificates'),
            'medical_reports'                           => $request->input('medical_reports'),
            'original_driving_license'                  => $request->input('original_driving_license'),
            'driving_license_copy'                      => $request->input('driving_license_copy'),
            'photographs'                               => $request->input('photographs'),
            'created_by'                                => Auth::user()->id,
        ];

        if(!empty($request->file('photograph_image'))) {
            $photograph_image = $request->file('photograph_image');
            $name1 = 'photograph_'.uniqid() . '_' . $photograph_image->getClientOriginalName();
            $photograph_path = base_path() . '/public/images/document/' . $name1;
            $image_resize = Image::make($photograph_image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain document image ratio
            });
            if ($image_resize->save($photograph_path, 80)) {
                $document_data['photograph_image'] = $name1;
            }

            $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

            File::create([
                'folder_id'         => $folder_info->id,
                'filename'          => $name1,
                'type'              => 'document',
                'created_by'        => Auth::user()->id,

            ]);

        }


        if(!empty($request->file('passport_image'))) {
            $passport_image = $request->file('passport_image');
            $name1 = 'passport_'.uniqid() . '_' . $passport_image->getClientOriginalName();
            $passport_path = base_path() . '/public/images/document/' . $name1;
            $image_resize = Image::make($passport_image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain document image ratio
            });
            if ($image_resize->save($passport_path, 80)) {
                $document_data['passport_image'] = $name1;
            }

            $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

            File::create([
                'folder_id'         => $folder_info->id,
                'filename'          => $name1,
                'type'              => 'document',
                'created_by'        => Auth::user()->id,

            ]);
        }

        if(!empty($request->file('signature_image'))) {
            $signature_image = $request->file('signature_image');
            $name1 = 'signature_'.uniqid() . '_' . $signature_image->getClientOriginalName();
            $signature_path = base_path() . '/public/images/document/' . $name1;
            $image_resize = Image::make($signature_image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain document image ratio
            });
            if ($image_resize->save($signature_path, 80)) {
                $document_data['signature_image'] = $name1;
            }

            $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

            File::create([
                'folder_id'         => $folder_info->id,
                'filename'          => $name1,
                'type'              => 'document',
                'created_by'        => Auth::user()->id,

            ]);
        }

        $document_info = CandidateDocumentInformation::create($document_data);
        if ($document_info) {
            Session::flash('success', 'Candidate Document Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate Document Info Creation Failed');
        }
        return redirect()->back();
    }

    public function bankstore(Request $request){
      //bank information
        $bank_data=[
            'candidate_personal_information_id'         => $request->input('candidate_personal_information_id'),
            'bank_details'                              => $request->input('bank_details'),
            'bank_remarks'                              => $request->input('bank_remarks'),
            'created_by'                                =>Auth::user()->id,
        ];

        if(!empty($request->file('cheque_image'))) {
            $bank_image = $request->file('cheque_image');
            $name1 = 'bank_'.uniqid() . '_' . $bank_image->getClientOriginalName();
            $path = base_path() . '/public/images/bank/' . $name1;
            $image_resize = Image::make($bank_image->getRealPath())->orientate();
            $image_resize->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); //maintain bank image ratio
            });
            if ($image_resize->save($path, 80)) {
                $bank_data['cheque_image'] = $name1;
            }
        }
        $document_info = CandidateBankInformation::create($bank_data);
        $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

        File::create([
            'folder_id'         => $folder_info->id,
            'filename'          => $name1,
            'type'              => 'bank',
            'created_by'        => Auth::user()->id,

        ]);

        if ($document_info) {
            Session::flash('success', 'Candidate Bank Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate Bank Info Creation Failed');
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
        $show         = CandidateDocumentInformation::find($id);
        return response()->json(['show'=>$show]);

    }

    public function bankshow($id)
    {
        $show         = CandidateBankInformation::find($id);
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
        $candidate_document = CandidateDocumentInformation::find($id);
        return response()->json(['edit'=>$candidate_document]);
    }

    public function bankedit($id)
    {
        $candidate_bank = CandidateBankInformation::find($id);
        return response()->json(['edit'=>$candidate_bank]);
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
        $candidate_document                                      =  CandidateDocumentInformation::find($id);
        $candidate_document->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_document->resume                              =  $request->input('resume');
        $candidate_document->original_passport                   =  $request->input('original_passport');
        $candidate_document->passport_xerox_copy                 =  $request->input('passport_xerox_copy');
        $candidate_document->academic_certificates               =  $request->input('academic_certificates');
        $candidate_document->original_academic                   =  $request->input('original_academic');
        $candidate_document->professional_training               =  $request->input('professional_training');
        $candidate_document->work_certificates                   =  $request->input('work_certificates');
        $candidate_document->medical_reports                     =  $request->input('medical_reports');
        $candidate_document->original_driving_license            =  $request->input('original_driving_license');
        $candidate_document->driving_license_copy                =  $request->input('driving_license_copy');
        $candidate_document->photographs                         =  $request->input('photographs');

        $oldphotograph_image                                     = $candidate_document->photograph_image;
        $oldpassport_image                                       = $candidate_document->passport_image;
        $oldsignature_image                                      = $candidate_document->signature_image;

        if (!empty($request->file('photograph_image'))){
            $image =$request->file('photograph_image');
            $name1 = 'photograph_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/document/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $candidate_document->photograph_image= $name1;
                if (!empty($oldphotograph_image) && file_exists(public_path().'/images/document/'.$oldphotograph_image)){
                    @unlink(public_path().'/images/document/'.$oldphotograph_image);
                }
            }
            $folder_info = File::where('filename',$oldphotograph_image)->first();
            if($folder_info){
                $folder_info->filename             =  $name1;
                $folder_info->update();
            }else{
                $folder = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();
                File::create([
                    'folder_id'         => $folder->id,
                    'filename'          => $name1,
                    'type'              => 'document',
                    'created_by'        => Auth::user()->id,

                ]);
            }

        }
        if (!empty($request->file('passport_image'))){
            $image =$request->file('passport_image');
            $name1 = 'passport_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/document/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $candidate_document->passport_image= $name1;
                if (!empty($oldpassport_image) && file_exists(public_path().'/images/document/'.$oldpassport_image)){
                    @unlink(public_path().'/images/document/'.$oldpassport_image);
                }
            }
            $folder_info = File::where('filename',$oldpassport_image)->first();
            if($folder_info){
                $folder_info->filename             =  $name1;
                $folder_info->update();
            }else{
                $folder = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();
                File::create([
                    'folder_id'         => $folder->id,
                    'filename'          => $name1,
                    'type'              => 'document',
                    'created_by'        => Auth::user()->id,

                ]);
            }
        }
        if (!empty($request->file('signature_image'))){
            $image =$request->file('signature_image');
            $name1 = 'signature_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/document/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $candidate_document->signature_image= $name1;
                if (!empty($oldsignature_image) && file_exists(public_path().'/images/document/'.$oldsignature_image)){
                    @unlink(public_path().'/images/document/'.$oldsignature_image);
                }
            }

            $folder_info = File::where('filename',$oldsignature_image)->first();
            if($folder_info){
                $folder_info->filename             =  $name1;
                $folder_info->update();
            }else{
                $folder = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();
                File::create([
                    'folder_id'         => $folder->id,
                    'filename'          => $name1,
                    'type'              => 'document',
                    'created_by'        => Auth::user()->id,

                ]);
            }
        }

        $status = $candidate_document->update();
        if($status){
            Session::flash('success','Candidate Document Info Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Document Info could not be Updated');
        }
        return redirect()->back();
    }

    public function bankupdate(Request $request, $id)
    {
        $candidate_bank                                      =  CandidateBankInformation::find($id);
        $candidate_bank->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_bank->bank_details                        =  $request->input('bank_details');
        $candidate_bank->bank_remarks                        =  $request->input('bank_remarks');
        $oldimage                                            = $candidate_bank->cheque_image;
        if (!empty($request->file('cheque_image'))){
            $image =$request->file('cheque_image');
            $name1 = 'bank_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/bank/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $candidate_bank->cheque_image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/bank/'.$oldimage)){
                    @unlink(public_path().'/images/bank/'.$oldimage);
                }
            }

            $folder_info = File::where('filename',$oldimage)->first();
            $folder_info->filename             =  $name1;
            $folder_info->update();
        }

        $status = $candidate_bank->update();
        if($status){
            Session::flash('success','Candidate Bank Info Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Bank Info could not be Updated');
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
        $trash           = CandidateDocumentInformation::find($id);
        $trash_status    = $trash->delete();
        if($trash_status){
            $status = CandidateDocumentInformation::onlyTrashed()->where('id', $id)->get();
            if (!empty($status[0]->photograph_image) && file_exists(public_path().'/images/document/'.$status[0]->photograph_image)){
                @unlink(public_path().'/images/document/'.$status[0]->photograph_image);
            }
            if (!empty($status[0]->photograph_image)){

                $file_photo = File::where('filename',$status[0]->photograph_image)->first();
                $file_photo->delete();
            }

            if (!empty($status[0]->passport_image) && file_exists(public_path().'/images/document/'.$status[0]->passport_image)){
                @unlink(public_path().'/images/document/'.$status[0]->passport_image);
            }
            if (!empty($status[0]->passport_image)){
                $file_passport = File::where('filename',$status[0]->passport_image)->first();
                $file_passport->delete();
            }

            if (!empty($status[0]->signature_image) && file_exists(public_path().'/images/document/'.$status[0]->signature_image)){
                @unlink(public_path().'/images/document/'.$status[0]->signature_image);
            }

            if (!empty($status[0]->signature_image)){
                $file_signature = File::where('filename',$status[0]->signature_image)->first();
                $file_signature->delete();
            }


            $final_status    = CandidateDocumentInformation::onlyTrashed()->where('id', $id)->forceDelete();
            if ($final_status){
                return response()->json('success');
            }else{
                return response()->json('failed');
            }
        }else{
            return response()->json('failed');
        }
    }

    public function bankdestroy($id)
    {
        $trash           = CandidateBankInformation::find($id);
        $trash_status    = $trash->delete();
        if($trash_status){
            $status = CandidateBankInformation::onlyTrashed()->where('id', $id)->get();
            if (!empty($status[0]->cheque_image) && file_exists(public_path().'/images/bank/'.$status[0]->cheque_image)){
                @unlink(public_path().'/images/bank/'.$status[0]->cheque_image);
            }
            $folder_info = File::where('filename',$status[0]->cheque_image)->first();
            $folder_info->delete();

            $final_status    = CandidateBankInformation::onlyTrashed()->where('id', $id)->forceDelete();
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
