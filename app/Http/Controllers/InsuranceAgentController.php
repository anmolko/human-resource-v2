<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsuranceAgentCreateRequest;
use App\Http\Requests\InsuranceAgentUpdateRequest;
use App\Models\InsuranceAgent;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class InsuranceAgentController extends Controller
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
        $insurances = InsuranceAgent::all();
        $countries = CountryState::getCountries();

        return view('admin.insurance_agent.index',compact('insurances','countries'));
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
    public function store(InsuranceAgentCreateRequest $request)
    {
        $data=[
            'company_name'          =>$request->input('company_name'),
            'company_address'       =>$request->input('company_address'),
            'country'               =>$request->input('country'),
            'company_contact_num'   =>$request->input('company_contact_num'),
            'company_email'         =>$request->input('company_email'),
            'status'                =>$request->input('status'),
            'personal_fullname'     =>$request->input('personal_fullname'),
            'personal_designation'  =>$request->input('personal_designation'),
            'personal_email'        =>$request->input('personal_email'),
            'personal_mobile_num'   =>$request->input('personal_mobile_num'),
            'personal_contact_num'  =>$request->input('personal_contact_num'),
            'created_by'            =>Auth::user()->id,
        ];


        $insuranceagent = InsuranceAgent::create($data);

        if($insuranceagent){
            
            $slug = str_replace(" ","_",strtolower($request->input('company_name')));
            $secondarygroup = SecondaryGroup::create([
                'primary_group_id' =>5,
                'imported_from' => 'true',
                'name'        =>$request->input('company_name'),
                'status'      =>1,
                'slug'        =>$slug,
                'created_by'  => Auth::user()->id,
            ]);

            if($secondarygroup){
                Session::flash('success','Insurance Agent Created Successfully');
                return redirect()->back();
            }else{
                Session::flash('error','Secondary Group not created.');
                return redirect()->back();
            }
        }
        else{
            Session::flash('error','Insurance Agent Creation Failed');
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
        $show = InsuranceAgent::find($id);
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
        $editinsurance   = InsuranceAgent::find($id);
        $countries = CountryState::getCountries();

        return response()->json(['editinsurance'=>$editinsurance,'countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsuranceAgentUpdateRequest $request, $id)
    {
        $agent                         =  InsuranceAgent::find($id);
        $old_c_name                 = $agent->company_name;

        $agent->company_name           =  $request->input('company_name');
        $agent->company_address        =  $request->input('company_address');
        $agent->country                =  $request->input('country');
        $agent->company_contact_num    =  $request->input('company_contact_num');
        $agent->company_email          =  $request->input('company_email');
        $agent->personal_fullname      =  $request->input('personal_fullname');
        $agent->status                 =  $request->input('status');
        $agent->personal_designation   =  $request->input('personal_designation');
        $agent->personal_email         =  $request->input('personal_email');
        $agent->personal_mobile_num    =  $request->input('personal_mobile_num');
        $agent->personal_contact_num   =  $request->input('personal_contact_num');
        $agent->updated_by             = Auth::user()->id;
       

        $status = $agent->update();
        if($status){

            $oldslug           = str_replace(" ","_",strtolower($old_c_name));
            $secondarygroup     = SecondaryGroup::where("slug",$oldslug)->first();
            $slug = str_replace(" ","_",strtolower($request->input('company_name')));

            $secondarygroup->name        = $request->input('company_name');
            $secondarygroup->slug        = $slug;
            $secondarygroup->updated_by  = Auth::user()->id;
            $secondarygroup->update();
            Session::flash('success','Insurance Agent Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Insurance Agent could not be Updated');
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
        $deleteagent    = InsuranceAgent::find($id);
        $rid             = $deleteagent->id;

        $deleteagent->delete();
        return '#insurance_agent_'.$rid;
    }

    public function trashindex(){
        $trashed = InsuranceAgent::onlyTrashed()->get();
        $countries = CountryState::getCountries();

        return view('admin.insurance_agent.trash', compact('trashed','countries'));
    }

    public function restoretrash($id){
        $restoretrash =  InsuranceAgent::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Insurance Agent Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Insurance Agent could not be Restored');
        }
        return redirect()->route('insurance-agent.trash');
    }

    public function deletetrash($id){
        $trashremoval = InsuranceAgent::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;

        InsuranceAgent::onlyTrashed()->where('id', $id)->forceDelete();

         return  '#insurance_agent_'.$rid;

    }

    public function statusupdate(Request $request, $id){
        $agent          = InsuranceAgent::find($id);
        $agent->status  = $request->status;
        $status        = $agent->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
