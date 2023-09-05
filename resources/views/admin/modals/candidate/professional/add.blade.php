<div id="add_candidate_professional_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Candidate Professional Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'candidate-professional-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="form-group">
                    <label>Country: <span class="text-danger">*</span></label>
                    <select class="custom-select country select-height" name="candidate_personal_information_id" required>
                        <option value disabled selected> Select Candidate</option>
                        @foreach($candidate_personal as $personal)
                            <option value="{{$personal->id}}">{{ucwords($personal->candidate_firstname)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select the candidate name.
                    </div>
                    @if($errors->has('candidate_info_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('candidate_info_id')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Ref No: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="job_ref_no" required>
                            <div class="invalid-feedback">
                                Please enter the job reference number
                            </div>
                            @if($errors->has('job_ref_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('job_ref_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="company_name" required>
                            <div class="invalid-feedback">
                                Please enter the company name.
                            </div>
                            @if($errors->has('registration_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('registration_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" required>
                            <div class="invalid-feedback">
                                Please enter the address.
                            </div>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{$errors->first('address')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger">*</span></label>
                            <select class="custom-select country select-height" name="country" required>
                                <option value disabled selected> Select Country</option>
                                @foreach($countries as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the country.
                            </div>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category of Job: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="category_of_job" required>
                            <div class="invalid-feedback">
                                Please enter the category of the job
                            </div>
                            @if($errors->has('category_of_job'))
                                <div class="invalid-feedback">
                                    {{$errors->first('category_of_job')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Designation: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="designation" required>
                            <div class="invalid-feedback">
                                Please enter the designation
                            </div>
                            @if($errors->has('designation'))
                                <div class="invalid-feedback">
                                    {{$errors->first('designation')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Duration: <span class="text-danger">*</span></label>
                    <select class="select" name="duration" required>
                        <option value disabled selected> Select Duration</option>
                        <option value="1-5-years"> 1 to 5 years</option>
                        <option value="above-5-years"> Above 5 years </option>
                        <option value="below-1-year"> Below 1 year </option>
                    </select>
                    <div class="invalid-feedback">
                        Please enter the designation
                    </div>
                    @if($errors->has('duration'))
                        <div class="invalid-feedback">
                            {{$errors->first('duration')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From: </label>
                            <input type="text" class="form-control" name="from" id="datepicker-from">
                            <div class="invalid-feedback">
                                Please choose from.
                            </div>
                            @if($errors->has('from'))
                                <div class="invalid-feedback">
                                    {{$errors->first('from')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To: </label>
                            <input type="text" class="form-control" name="to" id="datepicker-to" required>
                            <div class="invalid-feedback">
                                Please choose to.
                            </div>
                            @if($errors->has('to'))
                                <div class="invalid-feedback">
                                    {{$errors->first('to')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-candidate-personal">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
