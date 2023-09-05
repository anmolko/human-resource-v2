<div id="add_individual_visa" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Individual Visa Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               {!! Form::open(['route' => 'visa.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

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
                                            <input type="text" class="form-control" name="candidate_regd_number" id="candidate_regd_number" required readonly>
                                            <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_individual" readonly>
                                            <input type="hidden" name="demand_info_id" id="demand_info_id" readonly>
                                            <input type="hidden" name="demand_job_info_id" id="demand_job_info_id_individual" readonly>

                                            <div class="invalid-feedback">
                                                Please select the candidate regd number.
                                            </div>
                                            @if($errors->has('candidate_regd_number'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('candidate_regd_number')}}
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
                                            <input type="text" class="form-control" name="passport_number" id="passport_number" readonly>
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
                                            <input type="number" class="form-control" name="mobile_number" id="mobile_number" readonly>
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
                            <div class="card-header">
                                <h4 class="card-title mb-0">Visa Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Visa Number: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="visa_number" required>
                                            <div class="invalid-feedback">
                                                Please select the visa number.
                                            </div>
                                            @if($errors->has('visa_number'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('visa_number')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Visa Ref Number: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="visa_ref_number" required>
                                            <div class="invalid-feedback">
                                                Please enter visa ref number.
                                            </div>
                                            @if($errors->has('visa_ref_number'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('visa_ref_number')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Visa's Job Category:</label>
                                            <select class="custom-select job_to_demand_cat select-height" name="job_to_demand_id" id="visa_job_to_demand_id">
                                                <option value disabled selected> Select Job Category </option>

                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the related job category.
                                            </div>
                                            @if($errors->has('job_to_demand_id'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('job_to_demand_id')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label>Visa Type: <span class="text-danger">*</span></label>
                                    <select class="custom-select select-height" name="visa_type" required>
                                        <option value disabled selected> Select Visa Type</option>
                                        <option value="single_entry">Single Entry</option>
                                        <option value="multiple_entry">Multiple Entry</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        Please enter visa type.
                                    </div>
                                    @if($errors->has('visa_type'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('visa_type')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Purpose:</label>
                                    <input type="text" class="form-control" name="purpose" required>
                                    <div class="invalid-feedback">
                                        Please enter the purpose.
                                    </div>
                                    @if($errors->has('purpose'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('purpose')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issued Date: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="issue_date" id="visa_issued_date" required>
                                            <div class="invalid-feedback">
                                                Please enter visa issued date.
                                            </div>
                                            @if($errors->has('visa_issued_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('visa_issued_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="expiry_date" id="visa_expiry_date" required>
                                            <div class="invalid-feedback">
                                                Please enter visa expiry date.
                                            </div>
                                            @if($errors->has('visa_expiry_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('visa_expiry_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Duration of residency:</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="residency_duration" id="residency_duration">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Years</span>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please choose days.
                                                </div>
                                            </div>
                                            @if($errors->has('duration_of_residency'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('duration_of_residency')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea class="form-control" name="remarks" rows="4"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the necessary remarks.
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sub Status Information</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Sub Status: </label>
                                    <select class="custom-select country select-height" name="sub_status_id" id="selected_sub_status">
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

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Issued Date: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control visa_issued_date" name="status_applied_date" id="substat_applied_date" required>
                                            <div class="invalid-feedback">
                                                Please enter status applied date.
                                            </div>
                                            @if($errors->has('status_expiry_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('status_expiry_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea type="text" class="form-control" rows="2" name="status_remarks" id="selected_remarks"></textarea>
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
                    <button class="btn btn-primary submit-btn" id="individual_visa_info_submit">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
