<?php

namespace App\Http\Controllers;

use App\Models\OverseasAgent;
use App\Models\SecondaryGroup;
use App\Models\CountrySetting;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Intervention\Image\ImageManagerStatic as Image;

class OverseasAgentController extends Controller
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
        $overseas = OverseasAgent::latest()->get();
        $countries = CountryState::getCountries();

        return view('admin.overseas_agent.index',compact('overseas','countries'));
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
            'client_no'             =>$request->input('client_no'),
            'type_of_company'       =>$request->input('type_of_company'),
            'company_name'          =>$request->input('company_name'),
            'company_address'       =>$request->input('company_address'),
            'company_contact_num'   =>$request->input('company_contact_num'),
            'fax_num'               =>$request->input('fax_num'),
            'company_email'         =>$request->input('company_email'),
            'website'               =>$request->input('website'),
            'postal_address'        =>$request->input('postal_address'),
            'status'                =>$request->input('status'),
            'fullname'              =>$request->input('fullname'),
            'designation'           =>$request->input('designation'),
            'personal_email'        =>$request->input('personal_email'),
            'personal_mobile'       =>$request->input('personal_mobile'),
            'personal_contact_num'  =>$request->input('personal_contact_num'),
            'created_by'            =>Auth::user()->id,
        ];

        if($request->input('type_of_company') == 'individual'){
            $data["country"]           =  $request->input('country_personal');
            $data["country_state_id"]  =  $request->input('country_personal');
        }else{
            $data["country"]           =  $request->input('country');
            $data["country_state_id"]  =  $request->input('state');
        }

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            $name1 = uniqid() . '_' . $image->getClientOriginalName();
            $path = base_path() . '/public/images/agent/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path, 80)) {
                $data['image'] = $name1;
            }
        }

        $agent = OverseasAgent::create($data);


        if($agent){

//            $lower = str_replace(" ","_",strtolower($request->input('company_name')));
//            $slug     = $lower."_".$request->input('client_no');
//            $secondarygroup = SecondaryGroup::create([
//                'primary_group_id' =>9,
//                'imported_from' => 'true',
//                'name'        =>$request->input('company_name'),
//                'status'      =>1,
//                'slug'        =>$slug,
//                'created_by'  => Auth::user()->id,
//            ]);
//
//            if($secondarygroup){
//                Session::flash('success','Overseas Agent Created Successfully');
//                return redirect()->back();
//            }else{
//                Session::flash('error','Secondary Group not created.');
//                return redirect()->back();
//            }
        }
        else{
            Session::flash('error','Overseas Agent Creation Failed');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_no)
    {
        $agent   = OverseasAgent::where('client_no',$client_no)->first();

        return view('admin.overseas_agent.single',compact('agent'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editagent   = OverseasAgent::with('countryState')->find($id);
        $countries = CountryState::getCountries();

        return response()->json(['editagent'=>$editagent,'countries'=>$countries]);
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
        $agent                         =  OverseasAgent::find($id);

        $old_c_name                 = $agent->company_name;
        $old_c_no                   = $agent->client_no;

        $agent->client_no              =  $request->input('client_no');
        $agent->type_of_company        =  $request->input('type_of_company');
        $agent->company_name           =  $request->input('company_name');
        $agent->company_address        =  $request->input('company_address');
        $agent->company_contact_num    =  $request->input('company_contact_num');
        $agent->fax_num                =  $request->input('fax_num');
        $agent->company_email          =  $request->input('company_email');
        $agent->website                =  $request->input('website');
        $agent->postal_address         =  $request->input('postal_address');
        $agent->fullname               =  $request->input('fullname');
        $agent->status                 =  $request->input('status');
        $agent->designation            =  $request->input('designation');
        $agent->personal_email         =  $request->input('personal_email');
        $agent->personal_mobile        =  $request->input('personal_mobile');
        $agent->personal_contact_num   =  $request->input('personal_contact_num');

        if($request->input('type_of_company') == 'individual'){
            $agent->country                =  $request->input('country_personal');
            $agent->country_state_id       =  $request->input('state_personal');
        }else{
            $agent->country                =  $request->input('country');
            $agent->country_state_id       =  $request->input('state');
        }





        $agent->updated_by             = Auth::user()->id;
        $oldimage                      = $agent->image;

        if (!empty($request->file('image'))){
            $image =$request->file('image');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/agent/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $agent->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/agent/'.$oldimage)){
                    @unlink(public_path().'/images/agent/'.$oldimage);
                }
            }
        }

        $status = $agent->update();
        if($status){

//            $lower           = str_replace(" ","_",strtolower($old_c_name));
//            $oldslug     = $lower."_".$old_c_no;
//
//            $secondarygroup     = SecondaryGroup::where("slug",$oldslug)->first();
//
//            $companynew = str_replace(" ","_",strtolower($request->input('company_name')));
//            $slug     = $companynew."_".$request->input('client_no');
//
//            $secondarygroup->name        = $request->input('company_name');
//            $secondarygroup->slug        = $slug;
//            $secondarygroup->updated_by  = Auth::user()->id;
//            $secondarygroup->update();
//


            Session::flash('success','Overseas Agent Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Overseas Agent could not be Updated');
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
        $deleteagent  = OverseasAgent::find($id);
        $rid             = $deleteagent->id;

        // $checkjob    = $deletecategory->modules()->get();
        // if ($checkjob->count() > 0 ) {
        //     return 0;

        // }else{

             $deleteagent->delete();
        // }
        return '#overseas_agent_'.$rid;
    }

    public function trashindex(){
        $trashed = OverseasAgent::onlyTrashed()->get();
        return view('admin.overseas_agent.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  OverseasAgent::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Overseas Agent Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Overseas Agent could not be Restored');
        }
        return redirect()->route('overseas-agent.trash');
    }

    public function deletetrash($id){
        $trashremoval = OverseasAgent::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;

        // $checkjob    = $trashremoval[0]->secondaryGroups()->get();
        // if ($checkjob->count() > 0 ) {

        //     return 0;
        // } else {
            if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/agent/'.$trashremoval[0]->image)){
                @unlink(public_path().'/images/agent/'.$trashremoval[0]->image);
            }
            OverseasAgent::onlyTrashed()->where('id', $id)->forceDelete();

        // }
         return  '#overseas_agent_'.$rid;


    }

    public function getState(Request $request)
    {
        $country = $request->country_code;
        $states = CountrySetting::where('country_code',$country)->select('id','state')->get();
        $statesvalue     = [];
        foreach ($states  as $state){
            $statesvalue[$state->id]=ucwords($state->state);
        }
        return response()->json($statesvalue);
    }

    public function statusupdate(Request $request, $id){
        $agent          = OverseasAgent::find($id);
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
