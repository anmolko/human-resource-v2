<?php

namespace App\Http\Controllers;

use App\Models\Bonus;
use App\Models\Deduction;
use App\Models\Increment;
use App\Models\PaymentVoucher;
use App\Models\PaymentVoucherParticulars;
use App\Models\PayrollInformation;
use App\Models\SalaryPayment;
use App\Models\SecondaryGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SalaryPaymentController extends Controller
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
        $payrolls = PayrollInformation::with('employee')->get();
        return view('admin.payroll_details.payment.index', compact('payrolls'));

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

    public function loadMakePayment(Request $request)
    {
        $payroll_id             = $request->payroll_id;
        $payroll_month          = $request->month;
        $salary_payment         = SalaryPayment::where('payroll_id',$payroll_id)->where('payment_month',$payroll_month)->count();
        $payroll                = PayrollInformation::with('employee')->find($payroll_id);
        $query_month            = $payroll_month."-1";
        $bonuses                = Bonus::where('payroll_id',$payroll_id)->where('month',$query_month)->get();
        $deductions             = Deduction::where('payroll_id',$payroll_id)->where('deduction_month',$query_month)->get();
        $increments             = Increment::where('payroll_id',$payroll_id)->where('month',$payroll_month)->get();
        if($salary_payment>0){
            $paymentdetails     = SalaryPayment::where('payroll_id',$payroll_id)->where('payment_month',$payroll_month)->first();
            $allcurrentpayment  = SalaryPayment::where('payroll_id',$payroll_id)->get();
            return view('admin.payroll_details.payment.information',compact('payroll_month','payroll','paymentdetails','bonuses','deductions','increments','allcurrentpayment'));
        }else{
            $secondary      = SecondaryGroup::with('primaryGroup')
                ->whereHas('primaryGroup',function($query){
                    $query->where('slug' , 'cash')->orWhere('slug' , 'bank');
                })->select('id','name')->get();
            return view('admin.payroll_details.payment.individual', compact('payroll','payroll_id','payroll_month','bonuses','deductions','secondary','increments'));
        }

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
            'payroll_id'           =>$request->input('payroll_id'),
            'basic_salary'         =>$request->input('basic_salary'),
            'gross_salary'         =>$request->input('gross_salary'),
            'total_deduction'      =>$request->input('total_deduction'),
            'net_salary'           =>$request->input('net_salary'),
            'provident_fund'       =>$request->input('provident_fund'),
            'payment_amount'       =>$request->input('payment_amount'),
            'payment_month'        =>$request->input('payment_month'),
            'secondary_group_id'   =>$request->input('secondary_group_id'),
            'note'                 =>$request->input('note'),
            'created_by'           =>Auth::user()->id,
        ];
        $month    = Carbon::parse($request->input('payment_month'))->isoFormat('MMMM YYYY');
        $payment  = SalaryPayment::create($data);
        if($payment){
            $latest            = SalaryPayment::with('payrolls')->latest()->first();
            $fullname          = str_replace(" ","_",strtolower($latest->payrolls->employee->user->name));
            $slug              = $fullname."_".$latest->payrolls->employee->user_id;
            $secondary_details = SecondaryGroup::with('primaryGroup')->where('slug',$slug)->first();
            $ref               = 'PAY-'.str_pad(time() + 1, 8, "0", STR_PAD_LEFT);
            $payment_entry     = PaymentVoucher::create([
                'date'         => Carbon::now()->isoFormat('YYYY-MM-DD'),
                'ref_no'       => $ref,
                'narration'    => "Payment voucher addition for ".$latest->payrolls->employee->user->name." for the month of ". Carbon::parse($latest->payment_month)->isoFormat('MMMM, YYYY'),
                'total_amount' => $latest->payment_amount,
                'created_by'   => Auth::user()->id,
            ]);
            $latestpayment       = PaymentVoucher::latest()->first();
            $payment_particulars_debit = PaymentVoucherParticulars::create([
                'payment_voucher_id'=> $latestpayment->id,
                'by_debit_id' =>$secondary_details->id,
                'initial_acc_id' =>$latest->secondary_group_id,
                'debit_amount' =>$latest->payment_amount,
                'credit_amount' =>0,
                'created_by' =>Auth::user()->id,
            ]);
            $payment_particulars_credit = PaymentVoucherParticulars::create([
                'payment_voucher_id'=> $latestpayment->id,
                'to_credit_id' =>$latest->secondary_group_id,
                'initial_acc_id' =>$secondary_details->id,
                'debit_amount' =>0,
                'credit_amount' =>$latest->payment_amount,
                'created_by' =>Auth::user()->id,
            ]);
            if ($payment_entry && $payment_particulars_debit && $payment_particulars_credit){
                Session::flash('success','Salary Payment for '.$month.' created successfully');

            }else{
                Session::flash('error','Payment Voucher error for '.$month.' could not be created');
            }
        }
        else{
            Session::flash('error','Salary Payment for '.$month.' could not be created');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
