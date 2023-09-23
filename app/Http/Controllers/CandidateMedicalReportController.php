<?php

namespace App\Http\Controllers;

use App\Models\CandidateMedicalReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class CandidateMedicalReportController extends Controller
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
        $substat         = ($request->input('sub_status_id') == null) ? 1:$request->input('sub_status_id');
        $applieddate     = ($request->input('status_applied_date') == null) ? date("Y-m-d"):$request->input('status_applied_date');
        $remarks         = ($request->input('remarks') == null) ? "added by ".Auth::user()->name :$request->input('remarks');
        $data=[
            'candidate_personal_information_id'         => $request->input('candidate_personal_information_id'),
            'complexion'                                => $request->input('complexion'),
            'bloodgroup'                                => $request->input('bloodgroup'),
            'height'                                    => $request->input('height'),
            'weight'                                    => $request->input('weight'),
            'check_medical'                             => $request->input('check_medical'),
            'medical_report_number'                     => $request->input('medical_report_number'),
            'health_clinic_id'                          => $request->input('health_clinic_id'),
            'report_issued_date'                        => $request->input('report_issued_date'),
            'report_expiry_date'                        => $request->input('report_expiry_date'),
            'result'                                    => $request->input('result'),
            'report'                                    => $request->input('report'),
            'report_remarks'                            => $request->input('report_remarks'),
            'payment_status'                            => $request->input('payment_status'),
            'amount'                                    => $request->input('amount'),
            'sub_status_id'                             => $substat,
            'remarks'                                   => $remarks,
            'status_applied_date'                       => $applieddate,
            'report_image'                              => $request->input('report_image'),
            'created_by'                                => Auth::user()->id,
        ];

        if(!empty($request->file('report_image'))) {
            $image = $request->file('report_image');
            $name1 = 'medical_'.uniqid() . '_' . $image->getClientOriginalName();
            $path = base_path() . '/public/images/medical/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path, 80)) {
                $data['report_image'] = $name1;
            }
        }

        $status = CandidateMedicalReport::create($data);
        if($status){
            Session::flash('success','Candidate Medical Record Added');
        }
        else{
            Session::flash('error','Candidate Medical Record Could not be Added');
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
        $substat         = ($request->input('sub_status_id') == null) ? 1:$request->input('sub_status_id');
        $applieddate     = ($request->input('status_applied_date') == null) ? date("Y-m-d"):$request->input('status_applied_date');
        $remarks         = ($request->input('remarks') == null) ? "added by ".Auth::user()->name :$request->input('remarks');
        $medical                                        = CandidateMedicalReport::find($id);
        $medical->candidate_personal_information_id     = $request->input('candidate_personal_information_id');
        $medical->complexion                            = $request->input('complexion');
        $medical->bloodgroup                            = $request->input('bloodgroup');
        $medical->height                                = $request->input('height');
        $medical->weight                                = $request->input('weight');
        $medical->check_medical                         = $request->input('check_medical');
        $medical->medical_report_number                 = $request->input('medical_report_number');
        $medical->health_clinic_id                      = $request->input('health_clinic_id');
        $medical->report_issued_date                    = $request->input('report_issued_date');
        $medical->report_expiry_date                    = $request->input('report_expiry_date');
        $medical->result                                = $request->input('result');
        $medical->report                                = $request->input('report');
        $medical->report_remarks                        = $request->input('report_remarks');
        $medical->payment_status                        = $request->input('payment_status');
        $medical->amount                                = $request->input('amount');
        $medical->sub_status_id                         = $substat;
        $medical->remarks                               = $remarks;
        $medical->status_applied_date                   = $applieddate;
        $medical->updated_by                            = Auth::user()->id;
        $oldimage                                       = $medical->report_image;

        if (!empty($request->file('report_image'))){
            $image          = $request->file('report_image');
            $name1          = 'medical_'.uniqid() . '_' . $image->getClientOriginalName();
            $path           = base_path().'/public/images/medical/'.$name1;
            $image_resize   = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path,80)){
                $medical->report_image = $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/medical/'.$oldimage)){
                    @unlink(public_path().'/images/medical/'.$oldimage);
                }
            }

        }

        $status  =  $medical->update();
        if($status){
            Session::flash('success','Candidate Medical Record Updated');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate Medical Record Could not be Updated');
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
        //
    }
}
