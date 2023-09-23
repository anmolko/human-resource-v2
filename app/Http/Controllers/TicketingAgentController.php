<?php

namespace App\Http\Controllers;


use App\Http\Requests\TicketingAgentCreateRequest;
use App\Http\Requests\TicketingAgentUpdateRequest;
use App\Models\AirlineDetail;
use App\Models\TicketingAgent;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use CountryState;


class TicketingAgentController extends Controller
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
        $ticketing_agent    = TicketingAgent::latest()->get();
        $airlines           = AirlineDetail::latest()->get();
        return view('admin.ticketing_agent.index',compact('ticketing_agent','airlines'));

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
    public function store(TicketingAgentCreateRequest $request)
    {

        $data = [
            'agent_id'                  =>$request->input('agent_id'),
            'company_name'              =>$request->input('company_name'),
            'address'                   =>$request->input('address'),
            'country'                   =>$request->input('country'),
            'contact'                   =>$request->input('contact'),
            'fax_no'                    =>$request->input('fax_no'),
            'email'                     =>$request->input('email'),
            'website'                   =>$request->input('website'),
            'postal_address'            =>$request->input('postal_address'),
            'fullname'                  =>$request->input('fullname'),
            'designation'               =>$request->input('designation'),
            'personal_contact'          =>$request->input('personal_contact'),
            'personal_mobile'           =>$request->input('personal_mobile'),
            'personal_email'            =>$request->input('personal_email'),
            'status'                    =>$request->input('status'),
            'created_by'                =>Auth::user()->id,
        ];
        $agent = TicketingAgent::create($data);

        if($agent){

            $slug = str_replace(" ","_",strtolower($request->input('company_name')));
            $secondarygroup = SecondaryGroup::create([
                'primary_group_id' =>5,
                'imported_from' => 'true',
                'name'        =>$request->input('company_name'),
                'status'      =>1,
                'slug'        =>$slug,
                'created_by'  => Auth::user()->id,
            ]);

            $recent = TicketingAgent::find($agent->id);
            $recent->airline()->sync($request->input('airline_detail_id'));
            if($secondarygroup){
                Session::flash('success','Ticketing Agent Created Successfully');
                return redirect()->back();
            }else{
                Session::flash('error','Secondary Group not created.');
                return redirect()->back();
            }
        }
        else{
            Session::flash('error','Ticketing Agent Creation Failed');
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
        $show           = TicketingAgent::find($id);
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
        $edit       = TicketingAgent::find($id);
        $selected   = [];
        foreach ($edit->airline as $air){
            array_push($selected,$air->id);
        }
        return response()->json(['edit'=>$edit,'selected_airlines'=>$selected]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketingAgentUpdateRequest $request, $id)
    {
        $agent                      =  TicketingAgent::find($id);

        $old_c_name                 = $agent->company_name;

        $agent->agent_id            =  $request->input('agent_id');
        $agent->company_name        =  $request->input('company_name');
        $agent->address             =  $request->input('address');
        $agent->country             =  $request->input('country');
        $agent->contact             =  $request->input('contact');
        $agent->fax_no              =  $request->input('fax_no');
        $agent->email               =  $request->input('email');
        $agent->website             =  $request->input('website');
        $agent->postal_address      =  $request->input('postal_address');
        $agent->fullname            =  $request->input('fullname');
        $agent->designation         =  $request->input('designation');
        $agent->personal_contact    =  $request->input('personal_contact');
        $agent->personal_mobile     =  $request->input('personal_mobile');
        $agent->personal_email      =  $request->input('personal_email');
        $agent->status              =  $request->input('status');
        $agent->updated_by          = Auth::user()->id;

        $status = $agent->update();
        if($status){

            $oldslug           = str_replace(" ","_",strtolower($old_c_name));
            $secondarygroup     = SecondaryGroup::where("slug",$oldslug)->first();
            $slug = str_replace(" ","_",strtolower($request->input('company_name')));

            $secondarygroup->name        = $request->input('company_name');
            $secondarygroup->slug        = $slug;
            $secondarygroup->updated_by  = Auth::user()->id;
            $secondarygroup->update();

            $recent = TicketingAgent::find($agent->id);
            $recent->airline()->sync($request->input('airline_detail_id'));

            Session::flash('success','Ticketing Agent Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Ticketing Agent could not be Updated');
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
        $trash       = TicketingAgent::find($id);
        $rid         = $trash->id;
        $trash->delete();
        return '#agent_'.$rid;
    }

    public function trashindex()
    {
        $trashed   = TicketingAgent::onlyTrashed()->get();
        $countries = CountryState::getCountries();

        return view('admin.ticketing_agent.trash', compact('trashed','countries'));

    }

    public function restoretrash($id)
    {
        $restoretrash =  TicketingAgent::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Ticketing Agent Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Ticketing Agent could not be Restored');
        }
        return redirect()->route('ticketing-agent.trash');

    }


    public function deletetrash($id)
    {
        $trashremoval   = TicketingAgent::onlyTrashed()->where('id', $id)->get();
        $rid            = $trashremoval[0]->id;
        $trashremoval[0]->airline()->detach();
        TicketingAgent::onlyTrashed()->where('id', $id)->forceDelete();
        return  '#ticketing_agent_'.$rid;
    }



    public function statusupdate(Request $request, $id)
    {
        $clinic          = TicketingAgent::find($id);
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
