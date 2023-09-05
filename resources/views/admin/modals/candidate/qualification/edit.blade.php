<div id="edit_candidate_qualifications" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Professional Training Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatequalification','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>School/College Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="school_college_name" id="school_college_name" required>
                            <div class="invalid-feedback">
                                Please enter the School/college name
                            </div>
                            @if($errors->has('school_college_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('school_college_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Academic Level: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="academic_level" id="academic_level" required>
                                <option value disabled selected> Select Academic Level </option>
                                <option value="bachelors"> Bachelors  </option>
                                <option value="post-graduate"> Post Graduate  </option>
                                <option value="higher-secondary"> Higher Secondary </option>
                                <option value="lower-secondary"> Lower Secondary  </option>
                                <option value="SLC"> SLC </option>
                                <option value="none"> None </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the academic level.
                            </div>
                            @if($errors->has('academic_level'))
                                <div class="invalid-feedback">
                                    {{$errors->first('academic_level')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="qualification_address" required>
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
                            <label>Completed On: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control completed-on" name="completed_on" id="edit-datepicker-completed-on" required>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Division: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="division" id="division" required>
                                <option value disabled selected> Select Division </option>
                                <option value="distinction"> Distinction </option>
                                <option value="first-division"> First Division </option>
                                <option value="second-division"> Second Division </option>
                                <option value="third-division"> Third Division </option>
                                <option value="fail"> Fail </option>
                                <option value="none"> None </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the division.
                            </div>
                            @if($errors->has('division'))
                                <div class="invalid-feedback">
                                    {{$errors->first('division')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Result: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="result" id="result" required>
                                <option value disabled selected> Select Result </option>
                                <option value="pass"> Pass </option>
                                <option value="fail"> Fail </option>
                                <option value="waiting"> Waiting </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the result.
                            </div>
                            @if($errors->has('result'))
                                <div class="invalid-feedback">
                                    {{$errors->first('result')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Study Document Image: </label>
                            <input type="file" class="form-control" name="document" id="document">
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
                    <button class="btn btn-primary submit-btn" id="update-candidate-qualification">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
