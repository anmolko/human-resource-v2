<?php

namespace App\Http\Controllers;

use App\Http\Requests\PayrollCreateRequest;
use App\Http\Requests\PayrollUpdateRequest;
use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Increment;
use App\Models\PayrollInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PayrollInformationController extends Controller
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
        $payrolls  = PayrollInformation::all();
        $employees = Employee::with('user')->get();

        return view('admin.payroll_details.payroll.index', compact('payrolls','employees'));
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
    public function store(PayrollCreateRequest $request)
    {
        $data = [
            'employee_id'                   =>$request->input('employee_id'),
            'employee_type'                 =>$request->input('employee_type'),
            'basic_salary'                  =>$request->input('basic_salary'),
            'house_rent_allowance'          =>$request->input('house_rent_allowance'),
            'medical_allowance'             =>$request->input('medical_allowance'),
            'special_allowance'             =>$request->input('special_allowance'),
            'provident_fund_contribution'   =>$request->input('provident_fund_contribution'),
            'other_allowance'               =>$request->input('other_allowance'),
            'tax_deduction'                 =>$request->input('tax_deduction'),
            'provident_fund_deduction'      =>$request->input('provident_fund_deduction'),
            'other_deduction'               =>$request->input('other_deduction'),
            'total_provident_fund'          =>$request->input('total_provident_fund'),
            'net_salary'                    =>$request->input('net_salary'),
            'gross_salary'                  =>$request->input('gross_salary'),
            'created_by'                    =>Auth::user()->id,
        ];

        $payroll = PayrollInformation::create($data);

        if($payroll){
            Session::flash('success','Employee Payroll Created Successfully');
        }
        else{
            Session::flash('error','Employee Payroll Creation Failed');
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
        $show           = PayrollInformation::with('employee')->find($id);
        return response()->json(['show'=>$show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit            = PayrollInformation::find($id);
        return response()->json(['edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PayrollUpdateRequest $request, $id)
    {
        $payroll                                    =  PayrollInformation::find($id);
        $payroll->employee_id                       =  $request->input('employee_id');
        $payroll->employee_type                     =  $request->input('employee_type');
        $payroll->basic_salary                      =  $request->input('basic_salary');
        $payroll->house_rent_allowance              =  $request->input('house_rent_allowance');
        $payroll->medical_allowance                 =  $request->input('medical_allowance');
        $payroll->special_allowance                 =  $request->input('special_allowance');
        $payroll->provident_fund_contribution       =  $request->input('provident_fund_contribution');
        $payroll->other_allowance                   =  $request->input('other_allowance');
        $payroll->tax_deduction                     =  $request->input('tax_deduction');
        $payroll->provident_fund_deduction          =  $request->input('provident_fund_deduction');
        $payroll->other_deduction                   =  $request->input('other_deduction');
        $payroll->other_deduction                   =  $request->input('other_deduction');
        $payroll->total_provident_fund              =  $request->input('total_provident_fund');
        $payroll->net_salary                        =  $request->input('net_salary');
        $payroll->gross_salary                      =  $request->input('gross_salary');
        $payroll->updated_by                        = Auth::user()->id;
        $status = $payroll->update();
        if($status){
            Session::flash('success','Employee Payroll Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Employee Payroll could not be Updated');
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
        $trash       = PayrollInformation::find($id);
        $rid         = $trash->id;
        $trash->delete();
        return '#payroll_'.$rid;
    }


    public function trashindex()
    {
        $trashed   = PayrollInformation::onlyTrashed()->get();
        return view('admin.payroll_details.payroll.trash', compact('trashed'));
    }

    public function restoretrash($id)
    {
        $restoretrash =  PayrollInformation::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Employee Payroll Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Employee Payroll could not be Restored');
        }
        return redirect()->route('employee-payroll.trash');

    }


    public function deletetrash($id)
    {
        $trashremoval    = PayrollInformation::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        PayrollInformation::onlyTrashed()->where('id', $id)->forceDelete();

        return  '#employee_payroll'.$rid;
    }


    public function addalldetails($id){
        //other details
        $bonuses = Bonus::with('payroll')
        ->whereHas('payroll',function($query)use($id){
            $query->where('id', $id);
        })->get();

        $deductions = Deduction::with('payroll')
        ->whereHas('payroll',function($query)use($id){
            $query->where('id', $id);
        })->get();

        $increments = Increment::with('payroll')
        ->whereHas('payroll',function($query)use($id){
            $query->where('id', $id);
        })->get();

        $payroll_info = PayrollInformation::find($id);
    
        return view('admin.payroll_details.index',compact('payroll_info','deductions','bonuses','increments'));
    }


    public function alltrashindex($id){
        $trashedDeductions = Deduction::with('payroll')
        ->whereHas('payroll',function($query)use($id){
            $query->where('id', $id);
        })->onlyTrashed()->get();

        $trashedIncrements = Increment::with('payroll')
        ->whereHas('payroll',function($query)use($id){
            $query->where('id', $id);
        })->onlyTrashed()->get();

        $trashedBonuses = Bonus::with('payroll')
        ->whereHas('payroll',function($query)use($id){
            $query->where('id', $id);
        })->onlyTrashed()->get();

        $payroll_info = PayrollInformation::find($id);

        return view('admin.payroll_details.trash', compact('payroll_info','trashedDeductions','trashedBonuses','trashedIncrements'));
    }
}
