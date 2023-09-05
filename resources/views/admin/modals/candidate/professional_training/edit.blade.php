<div id="edit_candidate_professional_training" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Professional Training Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatetraining','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Certificate No: </label>
                            <input type="text" class="form-control" name="certificate_no" id="certificate_no">
                            <div class="invalid-feedback">
                                Please enter the certificate number.
                            </div>
                            @if($errors->has('certificate_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('certificate_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Training Type: </label>
                            <input type="text" class="form-control" name="training_type" id="training_type">
                            <div class="invalid-feedback">
                                Please enter the training type
                            </div>
                            @if($errors->has('training_type'))
                                <div class="invalid-feedback">
                                    {{$errors->first('training_type')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Institute Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="institute_name" id="institute_name" required>
                            <div class="invalid-feedback">
                                Please enter the name of institute.
                            </div>
                            @if($errors->has('institute_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('institute_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height country" name="country" id="training_country" required>
                                <option value disabled selected> Select Country</option>
                                @foreach($countries as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the name of the country.
                            </div>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Duration: <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="duration" id="training_duration" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">in Months</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter the duration.
                            </div>
                            @if($errors->has('duration'))
                                <div class="invalid-feedback">
                                    {{$errors->first('duration')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Update Certificate Image: </label>
                            <input type="file" class="form-control" name="certificate" id="certificate_edit">
                            <div class="invalid-feedback">
                                Please upload the certificate image.
                            </div>
                            @if($errors->has('certificate'))
                                <div class="invalid-feedback">
                                    {{$errors->first('certificate')}}
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
