<div id="edit_candidate_professional_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Professional Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidateprofessional','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Ref No: </label>
                            <input type="text" class="form-control" name="job_ref_no" id="job_ref_no">
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
                            <input type="text" class="form-control" name="company_name" id="company_name" required>
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
                            <label>Address: </label>
                            <input type="text" class="form-control" name="address" id="address">
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
                            <select class="custom-select select country select-height" name="country" id="country" required>
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
                            <label>Category of Job: </label>
                            <input type="text" class="form-control" name="category_of_job" id="category_of_job">
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
                            <label>Designation: </label>
                            <input type="text" class="form-control" name="designation" id="designation">
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


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From: </label>
                            <input type="text" class="form-control update-from" name="from" id="edit-datepicker-from">
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
                            <input type="text" class="form-control update-to" name="to" id="edit-datepicker-to" required>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Duration (in years): </label>
                            <input type="text" class="form-control" name="duration" id="duration_professional_edit" readonly>
                            <div class="invalid-feedback">
                                Please enter the designation
                            </div>
                            @if($errors->has('duration'))
                                <div class="invalid-feedback">
                                    {{$errors->first('designation')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Document Image: </label>
                            <input type="file" class="form-control" name="document" id="document_image">
                            <div class="invalid-feedback">
                                Please upload the document image.
                            </div>
                            @if($errors->has('document'))
                                <div class="invalid-feedback">
                                    {{$errors->first('document')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-candidate-professional">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
