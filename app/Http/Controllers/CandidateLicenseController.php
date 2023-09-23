<?php

namespace App\Http\Controllers;

use App\Models\CandidateLicenseInformation;
use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use CountryState;

class CandidateLicenseController extends Controller
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
        $license_data=[
            'candidate_personal_information_id'     => $request->input('candidate_personal_information_id'),
            'license_no'                            => $request->input('license_no'),
            'license_type'                          => $request->input('license_type'),
            'issued_date'                           => $request->input('issued_date'),
            'expirary_date'                         => $request->input('expirary_date'),
            'country'                               => $request->input('country'),
            'remarks'                               => $request->input('remarks'),
            'created_by'                            =>Auth::user()->id,
        ];

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            $name1 = 'license_'.uniqid() . '_' . $image->getClientOriginalName();
            $path = base_path() . '/public/images/license/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); //maintain license image ratio
            });
            if ($image_resize->save($path, 80)) {
                $license_data['image'] = $name1;
            }
        }


        $license_info = CandidateLicenseInformation::create($license_data);
        $folder_info = Folder::where('candidate_id',$request->input('candidate_personal_information_id'))->first();

        File::create([
            'folder_id'         => $folder_info->id,
            'filename'          => $name1,
            'type'              => 'license',
            'created_by'        => Auth::user()->id,

        ]);


        if ($license_info) {
            Session::flash('success', 'Candidate License Info Created Successfully');
        } else {
            Session::flash('error', 'Candidate License Info Creation Failed');
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
        $candidate_license = CandidateLicenseInformation::find($id);
        $issued            = Carbon::parse($candidate_license->issued_date)->isoFormat('MMMM Do, YYYY');
        $expiry            = Carbon::parse($candidate_license->expirary_date)->isoFormat('MMMM Do, YYYY');
        $country      = $candidate_license->country;
        $countries         = CountryState::getCountries();
        foreach ($countries as $key => $value){
            if($key==$country){
                $send_country = $value;
            }
        }
        return response()->json(['show'=>$candidate_license,'issued_date'=>$issued,'expirary_date'=>$expiry,'country'=>$send_country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate_license      = CandidateLicenseInformation::find($id);
        $edit_country           = $candidate_license->country;
        $countries              = CountryState::getCountries();
        foreach ($countries as $key => $value){
            if($key==$edit_country){
                $send_country = $value;
            }
        }
        return response()->json(['edit'=>$candidate_license,'countryname'=>$send_country]);
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
        $candidate_license                                      =  CandidateLicenseInformation::find($id);
        $candidate_license->candidate_personal_information_id   =  $request->input('candidate_personal_information_id');
        $candidate_license->license_type                        =  $request->input('license_type');
        $candidate_license->country                             =  $request->input('country');
        $candidate_license->issued_date                         =  $request->input('issued_date');
        $candidate_license->expirary_date                       =  $request->input('expirary_date');
        $candidate_license->remarks                             =  $request->input('remarks');
        $old_image                                              = $candidate_license->image;
        if (!empty($request->file('image'))){
            $image =$request->file('image');
            $name1 = 'license_'.uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/license/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $candidate_license->image= $name1;
                if (!empty($old_image) && file_exists(public_path().'/images/license/'.$old_image)){
                    @unlink(public_path().'/images/license/'.$old_image);
                }
            }


            $folder_info = File::where('filename',$old_image)->first();
            $folder_info->filename             =  $name1;
            $folder_info->update();

        }

        $status = $candidate_license->update();



        if($status){
            Session::flash('success','Candidate License Info Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate License Info could not be Updated');
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
        $trash           = CandidateLicenseInformation::find($id);
        $trash_status    = $trash->delete();
        if($trash_status){
            $status = CandidateLicenseInformation::onlyTrashed()->where('id', $id)->get();
            if (!empty($status[0]->image) && file_exists(public_path().'/images/license/'.$status[0]->image)){
                @unlink(public_path().'/images/license/'.$status[0]->image);
            }
            $folder_info = File::where('filename',$status[0]->image)->first();
            $folder_info->delete();

            $final_status    = CandidateLicenseInformation::onlyTrashed()->where('id', $id)->forceDelete();
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
