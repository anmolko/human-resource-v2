<?php

namespace App\Http\Controllers;

use App\Http\Requests\HealthClinicCreateRequest;
use App\Http\Requests\HealthClinicUpdateRequest;
use App\Models\HealthClinicInformation;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HealthClinicController extends Controller
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
        $health_clinic  = HealthClinicInformation::all();
        $countries      = CountryState::getCountries();

        return view('admin.health_clinic.index',compact('health_clinic','countries'));

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
    public function store(HealthClinicCreateRequest $request)
    {
        $data = [
            'name'                  =>$request->input('name'),
            'address'               =>$request->input('address'),
            'country'               =>$request->input('country'),
            'email'                 =>$request->input('email'),
            'contact'               =>$request->input('contact'),
            'status'                =>$request->input('status'),
            'organization_name'     =>$request->input('organization_name'),
            'membership_number'     =>$request->input('membership_number'),
            'created_by'            =>Auth::user()->id,
        ];
        $healthclinic = HealthClinicInformation::create($data);

        if($healthclinic){
            $slug = str_replace(" ","_",strtolower($request->input('name')));
            $secondarygroup = SecondaryGroup::create([
                'primary_group_id' =>5,
                'imported_from' => 'true',
                'name'        =>$request->input('name'),
                'status'      =>1,
                'slug'        =>$slug,
                'created_by'  => Auth::user()->id,
            ]);

            if($secondarygroup){
                Session::flash('success','Health Clinic Created Successfully');
                return redirect()->back();
            }else{
                Session::flash('error','Secondary Group not created.');
                return redirect()->back();
            }
        }
        else{
            Session::flash('error','Health Clinic Creation Failed');
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
        $show = HealthClinicInformation::find($id);
        $countries      = CountryState::getCountries();

        return response()->json(['show'=>$show,'countries'=>$countries]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit            = HealthClinicInformation::find($id);
        $countries       = CountryState::getCountries();

        return response()->json(['edit'=>$edit,'countries'=>$countries]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HealthClinicUpdateRequest $request, $id)
    {
        $clinic                     =  HealthClinicInformation::find($id);
        $old_c_name                 = $clinic->name;

        $clinic->name               =  $request->input('name');
        $clinic->address            =  $request->input('address');
        $clinic->country            =  $request->input('country');
        $clinic->contact            =  $request->input('contact');
        $clinic->email              =  $request->input('email');
        $clinic->status             =  $request->input('status');
        $clinic->organization_name  =  $request->input('organization_name');
        $clinic->membership_number  =  $request->input('membership_number');
        $clinic->updated_by         = Auth::user()->id;

        $status = $clinic->update();
        if($status){

            $oldslug           = str_replace(" ","_",strtolower($old_c_name));
            $secondarygroup     = SecondaryGroup::where("slug",$oldslug)->first();
            $slug = str_replace(" ","_",strtolower($request->input('name')));

            $secondarygroup->name        = $request->input('name');
            $secondarygroup->slug        = $slug;
            $secondarygroup->updated_by  = Auth::user()->id;
            $secondarygroup->update();


            Session::flash('success','Health Clinic Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Health Clinic could not be Updated');
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
        $trash       = HealthClinicInformation::find($id);
        $rid         = $trash->id;

        $trash->delete();
        return '#clinic_'.$rid;
    }

    public function trashindex()
    {
        $trashed = HealthClinicInformation::onlyTrashed()->get();
        $countries = CountryState::getCountries();

        return view('admin.health_clinic.trash', compact('trashed','countries'));

    }

    public function restoretrash($id)
    {
        $restoretrash =  HealthClinicInformation::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Health Clinic Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Health Clinic could not be Restored');
        }
        return redirect()->route('health-clinic.trash');
    }

    public function deletetrash($id)
    {
        $trashremoval    = HealthClinicInformation::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        HealthClinicInformation::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#health_clinic_'.$rid;

    }

    public function statusupdate(Request $request, $id)
    {
        $clinic          = HealthClinicInformation::find($id);
        $clinic->status  = $request->status;
        $status          = $clinic->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
