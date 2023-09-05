<div id="add_employee_payroll" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee Payroll</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'employee-payroll.store','method'=>'post','id'=>'employee_create_payroll','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="form-group">
                    <label >Select Employee <span class="text-danger">*</span></label>
                    <select class="custom-select select-height" name="employee_id" required>
                        <option value disabled selected> Select employee</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{ucwords($employee->user->name)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a Employee to add payroll.
                    </div>
                    @if($errors->has('country'))
                        <div class="invalid-feedback">
                            {{$errors->first('country')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Employee Type <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="employee_type" required>
                                <option value disabled selected> Select Employee Type</option>
                                <option value="provision">Provision</option>
                                <option value="permanent">Permanent</option>
                                <option value="full time">Full Time</option>
                                <option value="part time">Part Time</option>
                                <option value="adhoc">Adhoc</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select Employee Type.
                            </div>
                            @if($errors->has('employee_type'))
                                <div class="invalid-feedback">
                                    {{$errors->first('employee_type')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Basic Salary <span class="text-danger">*</span></label>
                            <input class="form-control" name="basic_salary" id="create_basic_salary" type="number" required>
                            <div class="invalid-feedback">
                                Please enter the basic salary.
                            </div>
                            @if($errors->has('basic_salary'))
                                <div class="invalid-feedback">
                                    {{$errors->first('basic_salary')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Allowance Information</h4>
                </div>

                <div class="form-group">
                    <label>Provident Fund Contribution</label>
                    <input class="form-control" name="provident_fund_contribution" id="create_provident_fund_contribution" type="number">
                    <div class="invalid-feedback">
                        Please enter the provident fund contribution.
                    </div>
                    @if($errors->has('provident_fund_contribution'))
                        <div class="invalid-feedback">
                            {{$errors->first('provident_fund_contribution')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>House rent allowance </label>
                            <input class="form-control" name="house_rent_allowance" id="create_house_rent_allowance" type="number">
                            <div class="invalid-feedback">
                                Please enter a house rent allowance.
                            </div>
                            @if($errors->has('house_rent_allowance'))
                                <div class="invalid-feedback">
                                    {{$errors->first('house_rent_allowance')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Medical Allowance</label>
                            <input class="form-control" name="medical_allowance" id="create_medical_allowance" type="number">
                            <div class="invalid-feedback">
                                Please enter the medical allowance.
                            </div>
                            @if($errors->has('medical_allowance'))
                                <div class="invalid-feedback">
                                    {{$errors->first('medical_allowance')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Special Allowance <span class="text-danger">*</span></label>
                            <input class="form-control" name="special_allowance" id="create_special_allowance" type="number">
                            <div class="invalid-feedback">
                                Please enter Special Allowance.
                            </div>
                            @if($errors->has('special_allowance'))
                                <div class="invalid-feedback">
                                    {{$errors->first('special_allowance')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Other allowance</label>
                            <input class="form-control" name="other_allowance" id="create_other_allowance" type="number">
                            <div class="invalid-feedback">
                                Please enter other allowance.
                            </div>
                            @if($errors->has('other_allowance'))
                                <div class="invalid-feedback">
                                    {{$errors->first('other_allowance')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Deduction Information</h4>
                </div>

                <div class="form-group">
                    <label>Tax Deduction </label>
                    <input class="form-control" name="tax_deduction" id="create_tax_deduction" type="number">
                    <div class="invalid-feedback">
                        Please enter tax deduction.
                    </div>
                    @if($errors->has('tax_deduction'))
                        <div class="invalid-feedback">
                            {{$errors->first('tax_deduction')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Provident Fund Deduction</label>
                            <input class="form-control" name="provident_fund_deduction" id="create_provident_fund_deduction" type="number">
                            <div class="invalid-feedback">
                                Please enter the provident fund deduction.
                            </div>
                            @if($errors->has('provident_fund_deduction'))
                                <div class="invalid-feedback">
                                    {{$errors->first('provident_fund_deduction')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Other Deduction</label>
                            <input class="form-control" name="other_deduction" id="create_other_deduction" type="number">
                            <div class="invalid-feedback">
                                Please enter the other deduction.
                            </div>
                            @if($errors->has('other_deduction'))
                                <div class="invalid-feedback">
                                    {{$errors->first('other_deduction')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Total Provident Fund</h4>
                </div>

                <div class="form-group">
                    <label>Total Provident fund</label>
                    <input class="form-control" name="total_provident_fund" id="create_total_provident_fund" value="0" type="number" readonly>
                    <div class="invalid-feedback">
                        Please enter the provident fund deduction.
                    </div>
                    @if($errors->has('total_provident_fund'))
                        <div class="invalid-feedback">
                            {{$errors->first('total_provident_fund')}}
                        </div>
                    @endif
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Total Salary Details</h4>
                </div>

                <div class="form-group">
                    <label>Gross Salary</label>
                    <input class="form-control" name="gross_salary" id="create_gross_salary" value="0" type="number" readonly>
                    <div class="invalid-feedback">
                        Please enter the gross.
                    </div>
                    @if($errors->has('gross_salary'))
                        <div class="invalid-feedback">
                            {{$errors->first('gross_salary')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Total Deductions</label>
                    <input class="form-control" name="total_deductions" id="create_total_deductions" value="0" type="number" disabled>
                </div>

                <div class="form-group">
                    <label>Net Salary</label>
                    <input class="form-control" name="net_salary" id="create_net_salary" value="0" type="number" readonly>
                    <div class="invalid-feedback">
                        Please enter the net salary.
                    </div>
                    @if($errors->has('net_salary'))
                        <div class="invalid-feedback">
                            {{$errors->first('net_salary')}}
                        </div>
                    @endif
                </div>


                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-employee-payroll">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
