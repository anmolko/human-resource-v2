<?php

namespace App\Http\Controllers;

use App\Models\CountrySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use CountryState;


class CountrySettingController extends Controller
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
         $country_settings = CountrySetting::latest()->get();
        $countries = CountryState::getCountries();

        return view('admin.setting.country_setting',compact('countries','country_settings'));
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
        $countries = CountryState::getCountries();
        foreach($countries as $key => $value){
            if($key==$request->input('country')){
                $country =  $value;
            }

        }

        $countrystate = CountrySetting::create([
            'country'       =>$country,
            'country_code'  =>$request->input('country'),
            'state'         =>$request->input('state'),
            'currency'      =>$request->input('currency'),
            'created_by'    =>Auth::user()->id,
        ]);

        if($countrystate){
            Session::flash('success','Country-State Created Successfully');
        }
        else{
            Session::flash('error','Country-State Creation Failed');
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
        $editcountry   = CountrySetting::find($id);
        $countries     = CountryState::getCountries();

        return response()->json(['editcountry'=>$editcountry,'countries'=>$countries]);
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
        $countries = CountryState::getCountries();
        foreach($countries as $key => $value){
            if($key==$request->input('country')){
                $country =  $value;
            }

        }

        $countrystate                        =  CountrySetting::find($id);
        $countrystate->country               =  $country;
        $countrystate->country_code          =  $request->input('country');
        $countrystate->state                 =  $request->input('state');
        $countrystate->currency              =  $request->input('currency');
        $countrystate->updated_by            =  Auth::user()->id;
        $status                              =  $countrystate->update();

        if($status){
            Session::flash('success','Country-State Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Country-State could not be Updated');
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
        $deletecountry  = CountrySetting::find($id);
        $rid             = $deletecountry->id;

        // $checkjob    = $deletecategory->modules()->get();
        // if ($checkjob->count() > 0 ) {
        //     return 0;

        // }else{

             $deletecountry->delete();
        // }
        return '#country_state_'.$rid;
    }

    public function trashindex(){
        $trashed = CountrySetting::onlyTrashed()->get();
        return view('admin.setting.trash_country_setting', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  CountrySetting::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Country-State Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Country-State could not be Restored');
        }
        return redirect()->route('country-setting.trash');
    }

    public function deletetrash($id){
        $trashremoval = CountrySetting::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;

        // $checkjob    = $trashremoval[0]->secondaryGroups()->get();
        // if ($checkjob->count() > 0 ) {

        //     return 0;
        // } else {

            CountrySetting::onlyTrashed()->where('id', $id)->forceDelete();

        // }
         return  '#country_state_'.$rid;


    }

}
