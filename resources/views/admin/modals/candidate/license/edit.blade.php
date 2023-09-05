<div id="edit_candidate_license" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate License Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatelicense','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>License No: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="license_no" id="license_no" required>
                            <div class="invalid-feedback">
                                Please enter the license number.
                            </div>
                            @if($errors->has('license_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('license_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>License Image(front/back): <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="image" id="image" required>
                            <div class="invalid-feedback">
                                Please upload the license image.
                            </div>
                            @if($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>License Type: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="license_type" id="license_type" required>
                            <div class="invalid-feedback">
                                Please enter the license type.
                            </div>
                            @if($errors->has('license_type'))
                                <div class="invalid-feedback">
                                    {{$errors->first('license_type')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Country: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="country" id="license_country" required>
                                <option value disabled selected> Select Country </option>
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
                            <label>Issued Date: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control edit-lis-issued-date" name="issued_date" id="edit-license-issue-datepicker" required>
                            <div class="invalid-feedback">
                                Please enter the license issue date.
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
                            <label>Expiry Date: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control edit-lis-expirary-date" name="expirary_date" id="edit-license-expiry-datepicker" required>
                            <div class="invalid-feedback">
                                Please enter the license expiry date.
                            </div>
                            @if($errors->has('expirary_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('expirary_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks: <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" name="remarks" id="license-remarks" required>
                                            </textarea>
                            <div class="invalid-feedback">
                                Please enter the remarks.
                            </div>
                            @if($errors->has('remarks'))
                                <div class="invalid-feedback">
                                    {{$errors->first('remarks')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-candidate-license">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
