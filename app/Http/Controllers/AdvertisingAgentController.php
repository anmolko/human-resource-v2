<?php

namespace App\Http\Controllers;

use App\Models\AdvertisingAgent;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AdvertisingAgentController extends Controller
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
        $advertising_agent  = AdvertisingAgent::latest()->get();
        $countries          = CountryState::getCountries();

        return view('admin.advertising_agent.index',compact('advertising_agent','countries'));

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
            'registration_no'           =>$request->input('registration_no'),
            'company_name'              =>$request->input('company_name'),
            'address'                   =>$request->input('address'),
            'country'                   =>$request->input('country'),
            'contact'                   =>$request->input('contact'),
            'email'                     =>$request->input('email'),
            'fullname'                  =>$request->input('fullname'),
            'designation'               =>$request->input('designation'),
            'personal_contact'          =>$request->input('personal_contact'),
            'personal_mobile'           =>$request->input('personal_mobile'),
            'personal_email'            =>$request->input('personal_email'),
            'status'                    =>$request->input('status'),
            'created_by'                =>Auth::user()->id,
        ];
        $agent = AdvertisingAgent::create($data);

        if($agent){
            Session::flash('success','Advertising Agent Created Successfully');
        }
        else{
            Session::flash('error','Advertising Agent Creation Failed');
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
        $show           = AdvertisingAgent::find($id);
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
        $edit            = AdvertisingAgent::find($id);
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
    public function update(Request $request, $id)
    {
        $agent                      =  AdvertisingAgent::find($id);
        $agent->registration_no     =  $request->input('registration_no');
        $agent->company_name        =  $request->input('company_name');
        $agent->address             =  $request->input('address');
        $agent->country             =  $request->input('country');
        $agent->contact             =  $request->input('contact');
        $agent->email               =  $request->input('email');
        $agent->fullname            =  $request->input('fullname');
        $agent->designation         =  $request->input('designation');
        $agent->personal_contact    =  $request->input('personal_contact');
        $agent->personal_mobile     =  $request->input('personal_mobile');
        $agent->personal_email      =  $request->input('personal_email');
        $agent->status              =  $request->input('status');
        $agent->updated_by          = Auth::user()->id;
        $status = $agent->update();
        if($status){
            Session::flash('success','Advertising Agent Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Advertising Agent could not be Updated');
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
        $trash       = AdvertisingAgent::find($id);
        $rid         = $trash->id;
        $trash->delete();
        return '#agent_'.$rid;
    }

    public function trashindex()
    {
        $trashed   = AdvertisingAgent::onlyTrashed()->get();
        $countries = CountryState::getCountries();

        return view('admin.advertising_agent.trash', compact('trashed','countries'));

    }

    public function restoretrash($id)
    {
        $restoretrash =  AdvertisingAgent::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Advertising Agent Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Advertising Agent could not be Restored');
        }
        return redirect()->route('advertising-agent.trash');

    }


    public function deletetrash($id)
    {
        $trashremoval    = AdvertisingAgent::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        AdvertisingAgent::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#advertising_agent_'.$rid;
    }



    public function statusupdate(Request $request, $id)
    {
        $clinic          = AdvertisingAgent::find($id);
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
