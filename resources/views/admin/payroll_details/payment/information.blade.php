{{--salary slip details--}}
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <ul class="breadcrumb">
                <li class="breadcrumb-item">{{$payroll->employee->user->name}}'s Salary payment details</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <div class="btn-group btn-group-sm">
{{--                <button class="btn btn-white">CSV</button>--}}
{{--                <button class="btn btn-white">PDF</button>--}}
                <button class="btn btn-white" onclick="printerDiv('payment-single-data-card')"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row" id="payment-single-data">
    <div class="col-md-12">
        <div class="card" id="payment-single-data-card">
            <div class="card-body">
                <h4 class="payslip-title">Payslip for the month of {{\Carbon\Carbon::parse($payroll_month)->isoFormat('MMMM, YYYY')}}</h4>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <img src="{{asset('images/company/'.$company_data->company_logo)}}" class="inv-logo" alt="">
                    </div>
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">Payslip #{{str_replace("-","",$payroll_month)}}</h3>
                            <ul class="list-unstyled">
                                <li>Generated On: <span>{{\Carbon\Carbon::parse($paymentdetails->created_at)->isoFormat('MMMM Do, YYYY')}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <ul class="list-unstyled mb-0">
                            <li><h4 class="mb-0"><strong>{{$company_data->company_name}}</strong></h4></li>
                            <li>{{$company_data->company_address}}</li>
                            <li>{{$company_data->email}}</li>
                            <li> {{$company_data->phone}}, {{$company_data->mobile}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
{{--                            <h3 class="text-uppercase">Payslip #{{str_replace("-","",$payroll_month)}}</h3>--}}
                            <ul class="list-unstyled">
                            <li><h4 class="mb-0"><strong>{{$payroll->employee->user->name}}</strong></h4></li>
                            <li><span>{{$payroll->employee->designation->name}}</span></li>
                            <li>Department: {{$payroll->employee->department->name}}</li>
                            <li>Joined Date: {{\Carbon\Carbon::parse($payroll->employee->created_at)->isoFormat('MMMM Do, YYYY')}}</li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <h4 class="m-b-10"><strong>Earnings</strong></h4>
                            <table class="table table-bordered custom-table mb-0 print-table">
                                <thead>
                                <tr>
                                    <th>Items</th>
                                    <th>Debit (-)</th>
                                    <th>Credit (+)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><strong>Basic Salary</strong> </td>
                                    <td><i class="fa fa-minus"></i></td>
                                    <td>{{($payroll->basic_salary != null) ? $payroll->basic_salary:"Not Set"}}</td>
                                </tr>
                                <tr>
                                    <td><strong>House Rent Allowance</strong> </td>
                                    <td><i class="fa fa-minus"></i></td>
                                    <td>{{($payroll->house_rent_allowance != null) ? $payroll->house_rent_allowance:"Not Set"}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Medical Allowance</strong> </td>
                                    <td><i class="fa fa-minus"></i></td>
                                    <td>{{($payroll->medical_allowance != null) ? $payroll->medical_allowance:"Not Set"}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Special Allowance</strong> </td>
                                    <td><i class="fa fa-minus"></i></td>
                                    <td>{{($payroll->special_allowance != null) ? $payroll->special_allowance:"Not Set"}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Other Allowance</strong> </td>
                                    <td><i class="fa fa-minus"></i></td>
                                    <td>{{($payroll->other_allowance != null) ? $payroll->other_allowance:"Not Set"}}</td>
                                </tr>
                                @foreach($bonuses as $bonus)
                                <tr>
                                    <td><strong>Bonus ({{$bonus->name}})</strong> </td>
                                    <td><i class="fa fa-minus"></i></td>
                                    <td>{{$bonus->amount}}</td>
                                </tr>
                                @endforeach
                                @foreach($increments as $increment)
                                    <tr>
                                        <td><strong>Increment from {{\Carbon\Carbon::parse($increment->month)->isoFormat('MMMM YYYY')}}</strong> </td>
                                        <td><i class="fa fa-minus"></i></td>
                                        <td>{{$increment->amount}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td><strong> Tax Deduction </strong> </td>
                                    <td>{{($payroll->tax_deduction != null) ? $payroll->tax_deduction:"Not Set"}}</td>
                                    <td><i class="fa fa-minus"></i></td>
                                </tr>
                                <tr>
                                    <td><strong> Provident Fund Deduction </strong> </td>
                                    <td>{{($payroll->provident_fund_deduction != null) ? $payroll->provident_fund_deduction:"Not Set"}}</td>
                                    <td><i class="fa fa-minus"></i></td>
                                </tr>
                                <tr>
                                    <td><strong> Other Deduction </strong> </td>
                                    <td>{{($payroll->other_deduction != null) ? $payroll->other_deduction:"Not Set"}}</td>
                                    <td><i class="fa fa-minus"></i></td>
                                </tr>
                                @foreach($deductions as $deduction)
                                    <tr>
                                        <td><strong> Deduction - ({{$deduction->deduction_name}}) </strong> </td>
                                        <td>{{$deduction->deduction_amount}}</td>
                                        <td><i class="fa fa-minus"></i></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row invoice-payment">
                            <div class="col-sm-7">
                                <br/>
                                @if($payroll->provident_fund_contribution != null)
                                    <div class="invoice-info">
                                        <h5>Additional Details</h5>
                                        <p><i class="fa fa-dot-circle-o text-primary mr-2"></i>Provident fund Contribution - {{($payroll->provident_fund_contribution != null) ? $payroll->provident_fund_contribution:"Not Set"}}</p>
                                        <p><i class="fa fa-dot-circle-o text-primary mr-2"></i>Total Provident fund  - {{($paymentdetails->provident_fund != null) ? $paymentdetails->provident_fund:"Not Set"}}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-5">
                                <div class="m-b-20">
                                    <div class="table-responsive no-border">
                                        <table class="table mb-0">
                                            <tbody>
                                            <tr>
                                                <th>Gross Salary:</th>
                                                <td class="text-right">{{$paymentdetails->gross_salary}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total Deduction: </th>
                                                <td class="text-right">{{$paymentdetails->total_deduction}}</td>
                                            </tr>
                                            <tr>
                                                <th>Net Salary(Paid Salary):</th>
                                                <td class="text-right"><h5>{{$paymentdetails->net_salary}}</h5></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-12 col-xl-12 d-flex">
    <div class="card flex-fill">
        <div class="card-body">
            <h4 class="card-title">Payment History Details</h4>
            <div class="statistics">
                <div class="row">
                    <div class="col-md-12 col-12 text-center">
                        <div class="stats-box mb-4">
                            <p style="color: #727272">All Past Salary Payment details for </p>
                            <h3 class="text-primary">{{$payroll->employee->user->name}}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="table-responsive">
                    <table class="table custom-table mb-0">
                        <thead>
                        <tr>
                            <th>Month </th>
                            <th>Basic Salary </th>
                            <th>Gross Salary </th>
                            <th>Total Deduction </th>
                            <th>Net Salary (paid) </th>
                            <th>Provident Fund </th>
                            <th>Payment Amount </th>
                            <th>Payment Type </th>
                            <th class="text-right">Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allcurrentpayment as $all)
                            <tr>
                                <td>
                                    <h2>{{\Carbon\Carbon::parse($all->payment_month)->isoFormat('MMMM YYYY')}}</h2>
                                </td>
                                <td>
                                    {{$all->basic_salary}}
                                </td>
                                <td>
                                    {{$all->gross_salary}}
                                </td>
                                <td>
                                    {{$all->total_deduction}}
                                </td>
                                <td>
                                    {{$all->net_salary}}
                                </td>
                                <td>
                                    {{$all->provident_fund}}
                                </td>
                                <td>
                                    {{$all->payment_amount}}
                                </td>
                                <td>
{{--                                    {{$all->secondary_group_id}}--}}
                                    {{\App\Models\SecondaryGroup::find($all->secondary_group_id)->name}}
                                </td>
                                <td class="text-right">
                                    {{$all->note}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

