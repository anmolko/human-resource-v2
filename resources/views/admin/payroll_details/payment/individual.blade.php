<!-- Employee Statistics -->
<div class="row">
    <div class="col-md-3">
        <div class="stats-info">
            <h6><span style="color: #727272">Employee Name</span></h6>
            <h4 class="text-primary">{{$payroll->employee->user->name}}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-info">
            <h6><span style="color: #727272">Department</span></h6>
            <h4 class="text-primary">{{$payroll->employee->department->name}}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-info">
            <h6><span style="color: #727272">Designation</span></h6>
            <h4 class="text-primary">{{$payroll->employee->designation->name}}</h4>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-info">
            <h6><span style="color: #727272">Joined Date</span></h6>
            <h4 class="text-primary">{{\Carbon\Carbon::parse($payroll->employee->created_at)->isoFormat('MMMM Do, YYYY')}}</h4>
        </div>
    </div>
</div>
<!-- /Employee Statistics -->

@php
$tax_deduction   = ($payroll->tax_deduction != null) ? $payroll->tax_deduction:0;
$pf_deduction    = ($payroll->provident_fund_deduction != null) ? $payroll->provident_fund_deduction:0;
$other_deduction = ($payroll->other_deduction != null) ? $payroll->other_deduction:0;
$total_deduction = $tax_deduction + $pf_deduction + $other_deduction;
$extra_amount    = 0;
$deduct_amount   = 0;
if(count($bonuses)>0){
    foreach($bonuses as $bonus){
        $extra_amount += $bonus->amount;
    }
}
if(count($deductions)>0){
    foreach($deductions as $deduction){
        $deduct_amount +=$deduction->deduction_amount;
    }
}

$final_gross            = ($payroll->gross_salary + $extra_amount );
$final_net              = ($payroll->net_salary + $extra_amount - $deduct_amount);
$provident_contribute   = ($payroll->provident_fund_contribution != null) ? $payroll->provident_fund_contribution: 0 ;

@endphp
<!-- Payment details Widget -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-6 d-flex">
        <div class="card flex-fill dash-statistics">
            <div class="card-body">
                <h5 class="card-title">Payment Details Form</h5>
                <div class="stats-list">
                    {!! Form::open(['route' => 'employee-payment.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                    <div class="form-group">
                        <label>Gross Salary </label>
                        <input class="form-control"  name="gross_salary" value="{{$final_gross}}" type="number" readonly>
                        <input name="payroll_id" value="{{$payroll->id}}" type="hidden"/>
                        <input name="basic_salary" value="{{$payroll->basic_salary}}" type="hidden"/>
                        <div class="invalid-feedback">
                            Please enter gross salary.
                        </div>
                        @if($errors->has('gross_salary'))
                            <div class="invalid-feedback">
                                {{$errors->first('gross_salary')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Total Deduction Number </label>
                        <input class="form-control"  name="total_deduction" value="{{$total_deduction}}" type="number" readonly>
                        <div class="invalid-feedback">
                            Please enter total deduction number.
                        </div>
                        @if($errors->has('total_deduction'))
                            <div class="invalid-feedback">
                                {{$errors->first('total_deduction')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Net Salary </label>
                        <input class="form-control" value="{{$final_net}}" name="net_salary" type="number" readonly>
                        <div class="invalid-feedback">
                            Please enter net salary.
                        </div>
                        @if($errors->has('net_salary'))
                            <div class="invalid-feedback">
                                {{$errors->first('net_salary')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Provident Fund </label>
                        <input class="form-control" value="{{($payroll->provident_fund_contribution + $provident_contribute)}}"  name="provident_fund" type="number" readonly>
                        <div class="invalid-feedback">
                            Please enter provident fund.
                        </div>
                        @if($errors->has('provident_fund'))
                            <div class="invalid-feedback">
                                {{$errors->first('provident_fund')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Payment Amount<span class="text-danger">*</span></label>
                        <input class="form-control" value="{{$final_net}}" name="payment_amount" type="number" required readonly>
                        <input value="{{$payroll_month}}" name="payment_month" type="hidden" />
                        <div class="invalid-feedback">
                            Please enter payment amount
                        </div>
                        @if($errors->has('payment_amount'))
                            <div class="invalid-feedback">
                                {{$errors->first('payment_amount')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Payment Type<span class="text-danger">*</span></label>
                        <select class="custom-select select-height" name="secondary_group_id" required>
                            <option value disabled selected> Select Type</option>
                            @foreach($secondary as $sec)
                            <option value="{{$sec->id}}">{{$sec->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please enter payment Type.
                        </div>
                        @if($errors->has('payment_type'))
                            <div class="invalid-feedback">
                                {{$errors->first('payment_type')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Note <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="note" rows="4" required></textarea>
                        <div class="invalid-feedback">
                            Please enter the note.
                        </div>
                        @if($errors->has('note'))
                            <div class="invalid-feedback">
                                {{$errors->first('note')}}
                            </div>
                        @endif
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" id="submit-advertising-agent">Submit</button>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-6 col-xl-6 d-flex">
        <div class="card flex-fill">
            <div class="card-body">
                <h4 class="card-title">Payment Details</h4>
                <div class="statistics">
                    <div class="row">
                        <div class="col-md-12 col-12 text-center">
                            <div class="stats-box mb-4">
                                <p style="color: #727272">Payment for the month of</p>
                                <h3 class="text-primary">{{\Carbon\Carbon::parse($payroll_month)->isoFormat('MMMM YYYY')}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="table-responsive">
                        <table class="table custom-table mb-0">
                            <thead>
                            <tr>
                                <th>Item </th>
                                <th>Debit(-) </th>
                                <th class="text-right">Credit (+)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Basic Salary </h2>
                                </td>
                                <td>
                                    <i class="fa fa-minus"></i>
                                </td>
                                <td class="text-right">
                                    {{($payroll->basic_salary != null) ? $payroll->basic_salary:"Not Set"}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>House Rent Allowance </h2>
                                </td>
                                <td>
                                    <i class="fa fa-minus"></i>
                                </td>
                                <td class="text-right">
                                    {{($payroll->house_rent_allowance != null) ? $payroll->house_rent_allowance:"Not Set"}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Medical Allowance </h2>
                                </td>
                                <td>
                                    <i class="fa fa-minus"></i>
                                </td>
                                <td class="text-right">
                                    {{($payroll->medical_allowance != null) ? $payroll->medical_allowance:"Not Set"}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Special Allowance </h2>
                                </td>
                                <td>
                                    <i class="fa fa-minus"></i>
                                </td>
                                <td class="text-right">
                                    {{($payroll->special_allowance != null) ? $payroll->special_allowance:"Not Set"}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Other Allowance </h2>
                                </td>
                                <td>
                                    <i class="fa fa-minus"></i>
                                </td>
                                <td class="text-right">
                                    {{($payroll->other_allowance != null) ? $payroll->other_allowance:"Not Set"}}
                                </td>
                            </tr>
                            @foreach($bonuses as $bonus)
                                <tr>
                                    <td>
                                        <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Bonus ({{$bonus->name}}) </h2>
                                    </td>
                                    <td>
                                        <i class="fa fa-minus"></i>
                                    </td>
                                    <td class="text-right">
                                        {{$bonus->amount}}
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($increments as $increment)
                                <tr>
                                    <td>
                                        <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Increment starting from {{\Carbon\Carbon::parse($increment->month)->isoFormat('MMMM YYYY')}} </h2>
                                    </td>
                                    <td>
                                        <i class="fa fa-minus"></i>
                                    </td>
                                    <td class="text-right">
                                        {{$increment->amount}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Tax Deduction </h2>
                                </td>
                                <td>
                                    {{($payroll->tax_deduction != null) ? $payroll->tax_deduction:"Not Set"}}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-minus"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Provident Fund Deduction </h2>
                                </td>
                                <td>
                                    {{($payroll->provident_fund_deduction != null) ? $payroll->provident_fund_deduction:"Not Set"}}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-minus"></i>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Other Deduction </h2>
                                </td>
                                <td>
                                    {{($payroll->other_deduction != null) ? $payroll->other_deduction:"Not Set"}}
                                </td>
                                <td class="text-right">
                                    <i class="fa fa-minus"></i>
                                </td>
                            </tr>
                            @foreach($deductions as $deduction)
                                <tr>
                                    <td>
                                        <h2><i class="fa fa-dot-circle-o text-primary mr-2"></i>Deduction - ({{$deduction->deduction_name}}) </h2>
                                    </td>
                                    <td>
                                        {{$deduction->deduction_amount}}
                                    </td>
                                    <td class="text-right">
                                        <i class="fa fa-minus"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <br/>
                    @if($payroll->provident_fund_contribution != null)
                    <div class="row">
                        <div class="col-md-12 col-12 text-center">
                            <div class="stats-box mb-4">
                                <p style="color: #727272">Additional Details</p>
                                <h4 class="text-primary">For {{$payroll->employee->user->name}} Payment </h4>
                            </div>
                        </div>
                    </div>
                    <p><i class="fa fa-dot-circle-o text-primary mr-2"></i>Provident fund Contribution <span class="float-right">{{($payroll->provident_fund_contribution != null) ? $payroll->provident_fund_contribution:"Not Set"}}</span></p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /Statistics Widget -->
