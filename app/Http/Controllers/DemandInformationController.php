<?php

namespace App\Http\Controllers;

use App\Models\CountrySetting;
use App\Models\DemandCompany;
use App\Models\DemandInformation;
use App\Models\JobCategory;
use App\Models\OverseasAgent;
use CountryState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class DemandInformationController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demand_info        = DemandInformation::with('jobs')->get();
        $countries          = CountryState::getCountries();
        $agents             = OverseasAgent::latest()->get();
        $categories         = JobCategory::latest()->get();
        $demands            = DemandInformation::latest()->get();
        $country_settings   = CountrySetting::latest()->get();
        $companies          = DemandCompany::latest()->pluck('title','id');

        return view('admin.demand_informations.index',compact('demand_info','companies','country_settings','countries','agents','categories','demands'));
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
            'ref_no'               => $request->input('ref_no'),
            'serial_no'            => $request->input('serial_no'),
            'demand_company_id'    => $request->input('company_id'),
            'category'             => $request->input('category'),
            'fulfill_date'         => $request->input('fulfill_date'),
            'issued_date'          => $request->input('issued_date'),
            'expired_date'         => $request->input('expired_date'),
            'advertised'           => $request->input('advertised'),
            'status'               => $request->input('status'),
            'doc_status'           => $request->input('doc_status'),
            'num_of_pax'           => $request->input('num_of_pax'),
            'doc_received_date'    => $request->input('doc_received_date'),
            'doc_status_remarks'   => $request->input('doc_status_remarks'),
            'created_by'           =>Auth::user()->id,
        ];


        if(!empty($request->file('image'))) {
            $image        = $request->file('image');
            $name1        = uniqid() . '_' . $image->getClientOriginalName();
            $path         = base_path() . '/public/images/demandinfo/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path, 80)) {
                $data['image'] = $name1;
            }
        }
        $demand = DemandInformation::create($data);

        if($demand){
            Session::flash('success','Demand Entry Created Successfully');
        }
        else{
            Session::flash('error','Demand Entry Creation Failed');
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
        $demand           = DemandInformation::find($id);
        $countries        = CountryState::getCountries();
        return view('admin.demand_informations.single',compact('demand','countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demand_info_edit = DemandInformation::find($id);
        $countries        = CountryState::getCountries();
        $agents           = OverseasAgent::latest()->get();

        return response()->json(['demand_info_agent'=>$demand_info_edit,'countries'=>$countries,'agents'=>$agents]);
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
        $demand                        =  DemandInformation::find($id);
        $demand->ref_no                =  $request->input('ref_no');
        $demand->serial_no             =  $request->input('serial_no');
        $demand->demand_company_id     =  $request->input('company_id');
        $demand->category              =  $request->input('category');
        $demand->fulfill_date          =  $request->input('fulfill_date');
        $demand->issued_date           =  $request->input('issued_date');
        $demand->expired_date          =  $request->input('expired_date');
        $demand->advertised            =  $request->input('advertised');
        $demand->status                =  $request->input('status');
        $demand->doc_status            =  $request->input('doc_status');
        $demand->num_of_pax            =  $request->input('num_of_pax');
        $demand->doc_received_date     =  $request->input('doc_received_date');
        $demand->doc_status_remarks    =  $request->input('doc_received_date');

        $oldimage                       = $demand->image;
        if (!empty($request->file('image'))){
            $image =$request->file('image');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/demandinfo/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $demand->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/demandinfo/'.$oldimage)){
                    @unlink(public_path().'/images/demandinfo/'.$oldimage);
                }
            }
        }

        $status = $demand->update();
        if($status){
            Session::flash('success','Demand Information Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Demand Information could not be Updated');
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
        $deletedemand    = DemandInformation::find($id);
        $rid             = $deletedemand->id;
        $deletedemand->delete();

        return '#demand_info_'.$rid;
    }

    public function trashindex(){
        $trashed        = DemandInformation::onlyTrashed()->get();
        $countries        = CountryState::getCountries();
        return view('admin.demand_informations.trash', compact('trashed','countries'));
    }

    public function restoretrash($id){
        $restoretrash =  DemandInformation::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Demand Information Restored');
        }
        else{
            Session::flash('error','Something Went Wrong.Demand Information could not be Restored');
        }
        return redirect()->route('demand-info.trash');
    }

    public function deletetrash($id){
        $trashremoval = DemandInformation::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/demandinfo/'.$trashremoval[0]->image)){
            @unlink(public_path().'/images/demandinfo/'.$trashremoval[0]->image);
        }
        DemandInformation::onlyTrashed()->where('id', $id)->forceDelete();
        return  '#demand_info_'.$rid;
    }

    public function statusupdate(Request $request, $id){
        $demand          = DemandInformation::find($id);
        $demand->status  = $request->status;
        $status        = $demand->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
