<div id="edit_health_record" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Candidate Health Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatemedicalrecord','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_medical" readonly/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Candidate Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Candidate Regd Number:</label>
                                            <input type="text" class="form-control" name="registration_no" id="registration_no" required readonly>
                                            <div class="invalid-feedback">
                                                Please select the candidate regd number.
                                            </div>
                                            @if($errors->has('registration_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('registration_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Candidate Name: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control demand-applied-date" name="candidate_name" id="candidate_name" readonly>
                                            <div class="invalid-feedback">
                                                Please enter candidate name.
                                            </div>
                                            @if($errors->has('candidate_name'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('candidate_name')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport Number:</label>
                                            <input type="text" class="form-control" name="passport_no" id="passport_no" readonly>
                                            <div class="invalid-feedback">
                                                Please select the candidate passport number.
                                            </div>
                                            @if($errors->has('passport_number'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('passport_number')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number: <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="mobile_no" id="mobile_no" readonly>
                                            <div class="invalid-feedback">
                                                Please enter candidate mobile number.
                                            </div>
                                            @if($errors->has('mobile_number'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('mobile_number')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Complexion </label>
                                            <input type="text" class="form-control" name="complexion" id="complexion" />
                                            <div class="invalid-feedback">
                                                Please select the candidate complexion number.
                                            </div>
                                            @if($errors->has('complexion'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('complexion')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Blood Group </label>
                                            <select class="custom-select country select-height" name="bloodgroup" id="bloodgroup">
                                                <option value disabled selected> Select Blood Group</option>
                                                <option value="O-pos">O+</option>
                                                <option value="O-neg">O+</option>
                                                <option value="A-pos">A+</option>
                                                <option value="A-neg">A-</option>
                                                <option value="B-pos">B+</option>
                                                <option value="B-neg">B-</option>
                                                <option value="AB-pos">AB+</option>
                                                <option value="AB-neg">AB-</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter candidate blood group.
                                            </div>
                                            @if($errors->has('blood_group'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('blood_group')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Height</label>
                                            <div class="input-group">
                                                <input type="number" min="1" class="form-control" name="height" id="height">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Fts</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please select the candidate height.
                                            </div>
                                            @if($errors->has('height'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('height')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Weight </label>
                                            <div class="input-group">
                                                <input type="number" min="1" class="form-control" name="weight" id="weight">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Kgs</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter candidate weight.
                                            </div>
                                            @if($errors->has('weight'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('weight')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="check_medical" value="yes" id="checkMedical">
                                <label class="form-check-label" for="checkMedical">
                                    Check if you want to edit Medical Information
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Medical Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Medical Report Number</label>
                                            <input type="text" class="form-control medical-report required" name="medical_report_number" id="medical_report_number" readonly>
                                            <div class="invalid-feedback">
                                                Please select the Medical Report Number.
                                            </div>
                                            @if($errors->has('medical_report_num'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('medical_report_num')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Medical Clinic Name</label>
                                            <select class="custom-select country select-height medical-report-select" name="health_clinic_id" id="health_clinic_id" disabled>
                                                <option value disabled selected> Select Medical Clinic</option>
                                                @foreach($clinic_detail as $clinic)
                                                    <option value="{{$clinic->id}}" >{{ucwords($clinic->name)}} </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select Medical Clinic name.
                                            </div>
                                            @if($errors->has('medical_clinic'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('medical_clinic')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issued Date</label>
                                            <input type="text" class="form-control visa_issued_date medical-report" name="report_issued_date" id="report_issued_date_edit" readonly>
                                            <div class="invalid-feedback">
                                                Please select the issued date.
                                            </div>
                                            @if($errors->has('issued_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('issued_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control visa_issued_date medical-report" name="report_expiry_date" id="report_expiry_date_edit" readonly>
                                            <div class="invalid-feedback">
                                                Please select the expiry date.
                                            </div>
                                            @if($errors->has('expiry_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('expiry_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Result </label>
                                    <select class="custom-select country select-height medical-report-select" name="result" id="result" disabled>
                                        <option value disabled selected> Select Result</option>
                                        <option value="fail">Fail</option>
                                        <option value="pass">Pass</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select result.
                                    </div>
                                    @if($errors->has('result'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('result')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Report </label>
                                    <textarea type="text" class="form-control medical-report" rows="2" name="report" id="report" readonly></textarea>
                                    <div class="invalid-feedback">
                                        Please enter report.
                                    </div>
                                    @if($errors->has('report'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('report')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Remarks </label>
                                    <textarea type="text" class="form-control medical-report" rows="2" name="report_remarks" id="report_remarks" readonly></textarea>
                                    <div class="invalid-feedback">
                                        Please enter report.
                                    </div>
                                    @if($errors->has('report_remarks'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('report_remarks')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input medical-report-select" type="checkbox" name="payment_status" value="yes" id="paymentCheck" disabled>
                                                <label class="form-check-label medical-report-select" for="paymentCheck" disabled>
                                                    Medical Payment
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Amount (Nrs) </label>
                                            <input type="text" class="form-control medical-report" name="amount" id="payment_amount" readonly>
                                            <div class="invalid-feedback">
                                                Please enter the payment amount.
                                            </div>
                                            @if($errors->has('amount'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('amount')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Report Image:</label>
                                    <input type="file" class="form-control medical-report-select" name="report_image" disabled>
                                    <div class="invalid-feedback">
                                        Please upload the report image.
                                    </div>
                                    @if($errors->has('report_image'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('report_image')}}
                                        </div>
                                    @endif
                                </div>


                                <div class="col-12 col-md-12 col-lg-9" id="currentImageAppend">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sub Status Information</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Status Applied Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control visa_issued_date medical-report" name="status_applied_date" id="status_applied_date_medical" readonly>
                                    <div class="invalid-feedback">
                                        Please enter status applied date.
                                    </div>
                                    @if($errors->has('status_expiry_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('status_expiry_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Sub Status: <span class="text-danger">*</span></label>
                                    <select class="custom-select country select-height medical-report-select" name="sub_status_id" id="sub_status_medical" disabled>
                                        <option value disabled selected> Select Sub Status</option>
                                        @foreach($sub_status as $sub)
                                            <option value="{{$sub->id}}">{{ucwords($sub->name)}} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select the sub status.
                                    </div>
                                    @if($errors->has('sub_status_id'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('sub_status_id')}}
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea type="text" class="form-control medical-report" rows="2" name="remarks" id="remarks_medical" readonly></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the remarks
                                    </div>
                                    @if($errors->has('remarks'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('remarks')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-medical-candidate-form">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
