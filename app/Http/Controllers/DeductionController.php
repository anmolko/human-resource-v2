<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Increment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeductionController extends Controller
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
            'deduction_name' => 'required|max:100',
            'deduction_month' => 'required',
            'deduction_amount' => 'required|numeric',
            'deduction_description' => 'required',
        ]);

        $result = Deduction::create([
            'payroll_id'           => $request->input('payroll_id'),
            'deduction_name'        => $request->input('deduction_name'),
            'deduction_month'       => $request->input('deduction_month').'-01',
            'deduction_amount'      => $request->input('deduction_amount'),
            'deduction_description' => $request->input('deduction_description'),
            'created_by'            => Auth::user()->id,

        ]);

        if($result){
            Session::flash('success','New Deduction Created Successfully');
        }
        else{
            Session::flash('error','New Deduction Creation Failed');
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
        $editdeduction    = Deduction::with('payroll')->find($id);
        return response()->json($editdeduction);
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
            'deduction_name' => 'required|max:100',
            'deduction_month' => 'required',
            'deduction_amount' => 'required|numeric',
            'deduction_description' => 'required',
        ]);

        $deduction                         = Deduction::find($id);
        $deduction->deduction_name         = $request->input('deduction_name');
        $deduction->deduction_month        = $request->input('deduction_month').'-01';
        $deduction->deduction_amount       = $request->input('deduction_amount');
        $deduction->deduction_description  = $request->input('deduction_description');
        $deduction->updated_by              = Auth::user()->id;

        $status                            = $deduction->update();
        if($status){
            Session::flash('success','Deduction Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Deduction could not be Updated');
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
        $deletdeduction= Deduction::find($id);

        $deletdeduction->delete();
        return '#deduction'.$id;
    }

  

    public function restoretrash($id){
        $restoretrash =  Deduction::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Deduction Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Deduction could not be Restored');
        }
        return redirect()->back();

    }

    public function deletetrash($id){
        $trashremoval = Deduction::onlyTrashed()->where('id', $id)->get();

        Deduction::onlyTrashed()->where('id', $id)->forceDelete();
        return '#deduction';
    }
}
