<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class BonusController extends Controller
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
        
        $this->validate(request(), [
            'name' => 'required|max:100',
            'month' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $result = Bonus::create([
            'payroll_id'       => $request->input('payroll_id'),
            'name'              => $request->input('name'),
            'month'             => $request->input('month').'-01',
            'amount'            => $request->input('amount'),
            'description'       => $request->input('description'),
            'created_by'        => Auth::user()->id,

        ]);

        if($result){
            Session::flash('success','New Bonus Created Successfully');
        }
        else{
            Session::flash('error','New Bonus Creation Failed');
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
        $editdBonus    = Bonus::with('payroll')->find($id);
        return response()->json($editdBonus);
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

        $this->validate(request(), [
            'name' => 'required|max:100',
            'month' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);

        $bonus                         = Bonus::find($id);
        $bonus->name                   = $request->input('name');
        $bonus->month                  = $request->input('month').'-01';
        $bonus->amount                 = $request->input('amount');
        $bonus->description            = $request->input('description');
        $bonus->updated_by             = Auth::user()->id;

        $status                            = $bonus->update();
        if($status){
            Session::flash('success','Bonus Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Bonus could not be Updated');
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
        $deletebonus= Bonus::find($id);
        
        $deletebonus->delete();
        return '#bonus'.$id;
    }

  
    public function restoretrash($id){
        $restoretrash =  Bonus::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Bonus Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Bonus could not be Restored');
        }
        return redirect()->back();
    }

    public function deletetrash($id){
        $trashremoval = Bonus::onlyTrashed()->where('id', $id)->get();
       
        Bonus::onlyTrashed()->where('id', $id)->forceDelete();
        return '#bonus';
    }
}
