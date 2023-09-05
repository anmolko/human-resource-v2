<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Increment;
use App\Models\PayrollInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IncrementController extends Controller
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
            'month' => 'required',
            'amount' => 'required|numeric',
            'purpose' => 'required',
        ]);

        $result = Increment::create([
            'payroll_id'        => $request->input('payroll_id'),
            'month'             => $request->input('month'),
            'amount'            => $request->input('amount'),
            'purpose'           => $request->input('purpose'),
            'created_by'        => Auth::user()->id,
        ]);

        if($result){
            $payroll                = PayrollInformation::find($request->input('payroll_id'));
            $payroll->basic_salary  = ($payroll->basic_salary + $request->input('amount'));
            $payroll->gross_salary  = ($payroll->gross_salary + $request->input('amount'));
            $payroll->net_salary    = ($payroll->net_salary   + $request->input('amount'));
            $payrollupdate          = $payroll->update();
            Session::flash('success','New Increment Added Successfully');
        }
        else{
            Session::flash('error','New Increment Creation Failed');
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
        $editdIncrement    = Increment::with('payroll')->find($id);
        return response()->json($editdIncrement);
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
            'month' => 'required',
            'amount' => 'required|numeric',
            'purpose' => 'required',
        ]);

        $increment                         = Increment::find($id);
        $increment->month                  = $request->input('month');
        $increment->amount                 = $request->input('amount');
        $increment->purpose                = $request->input('purpose');
        $increment->updated_by             = Auth::user()->id;

        $status                            = $increment->update();
        if($status){
            Session::flash('success','Increment Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Increment could not be Updated');
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
        $delete= Increment::find($id);

        $delete->delete();
        return '#increment'.$id;
    }

    public function restoretrash($id){
        $restoretrash =  Increment::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Increment Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Increment could not be Restored');
        }
        return redirect()->back();

    }

    public function deletetrash($id){
        $trashremoval = Increment::onlyTrashed()->where('id', $id)->get();

        Increment::onlyTrashed()->where('id', $id)->forceDelete();
        return '#increment';
    }
}
