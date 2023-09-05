<div id="edit_police_report_entry" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Police Report Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatepolicereportss','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Issued Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="issued" id="datepicker-report-issued-edit" required>
                            <div class="invalid-feedback">
                                Please enter the issued date.
                            </div>
                            @if($errors->has('issued'))
                                <div class="invalid-feedback">
                                    {{$errors->first('issued')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stamping date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="stamping_date" id="datepicker-report-stamp-edit" required>
                            <div class="invalid-feedback">
                                Please select the stamping date.
                            </div>
                            @if($errors->has('stamping_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('stamping_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Registration Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control regis-edit" name="registration_number"  required>
                            <div class="invalid-feedback">
                                Please enter the registration number.
                            </div>
                            @if($errors->has('registration_number'))
                                <div class="invalid-feedback">
                                    {{$errors->first('registration_number')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Expiry Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control report-expiry-date" name="expiry_date" id="datepicker-report-expiry-edit" required>
                            <div class="invalid-feedback">
                                Please select completed on date.
                            </div>
                            @if($errors->has('completed_on'))
                                <div class="invalid-feedback">
                                    {{$errors->first('completed_on')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Police report image: </label>
                            <input type="file" class="form-control" name="image" id="report-image">
                            <div class="invalid-feedback">
                                Please upload the police report image.
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>




                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-candidate-demandentry">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
