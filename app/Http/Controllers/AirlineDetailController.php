<?php

namespace App\Http\Controllers;

use App\Models\AirlineDetail;
use Illuminate\Http\Request;
use CountryState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AirlineDetailController extends Controller
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
        $airline_detail     = AirlineDetail::latest()->get();
        $countries          = CountryState::getCountries();

        return view('admin.airline_details.index',compact('airline_detail','countries'));

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
            'reference_no'          => $request->input('reference_no'),
            'country'               => $request->input('country'),
            'country_state_id'      => $request->input('country_state_id'),
            'country_one'           => $request->input('country_one'),
            'country_two'           => $request->input('country_two'),
            'country_three'         => $request->input('country_three'),
            'transaction'           => $request->input('transaction'),
            'total_cost'            => $request->input('total_cost'),
            'remarks'               => $request->input('remarks'),
            'created_by'            =>Auth::user()->id,
        ];
        $airline = AirlineDetail::create($data);

        if($airline){
            Session::flash('success','Airline Detail Created Successfully');
        }
        else{
            Session::flash('error','Airline Detail Creation Failed');
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
        $show           = AirlineDetail::with('countryState')->find($id);
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
        $edit            = AirlineDetail::with('countryState')->find($id);
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
        $airline                        =  AirlineDetail::find($id);
        $airline->reference_no          =  $request->input('reference_no');
        $airline->country               =  $request->input('country');
        $airline->country_state_id      =  $request->input('country_state_id');
        $airline->country_one           =  $request->input('country_one');
        $airline->country_two           =  $request->input('country_two');
        $airline->country_three         =  $request->input('country_three');
        $airline->transaction           =  $request->input('transaction');
        $airline->total_cost            =  $request->input('total_cost');
        $airline->remarks               =  $request->input('remarks');
        $airline->updated_by            = Auth::user()->id;
        $status                         = $airline->update();
        if($status){
            Session::flash('success','Airline details Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Airline details could not be Updated');
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
        $trash       = AirlineDetail::find($id);
        $rid         = $trash->id;
        $trash->delete();
        return '#airline_'.$rid;
    }

    public function trashindex(){
        $trashed        = AirlineDetail::onlyTrashed()->get();
        $countries      = CountryState::getCountries();
        return view('admin.airline_details.trash', compact('trashed','countries'));
    }

    public function restoretrash($id){
        $restoretrash =  AirlineDetail::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Airline Detail Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Airline Detail could not be Restored');
        }
        return redirect()->route('airline-details.trash');
    }

    public function deletetrash($id)
    {
        $trashremoval    = AirlineDetail::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        AirlineDetail::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#airline_detail_'.$rid;
    }

}
