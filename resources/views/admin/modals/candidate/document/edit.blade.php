<div id="edit_candidate_document" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Bank Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatedocument','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Resume: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="resume" id="resume" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the resume value.
                            </div>
                            @if($errors->has('resume'))
                                <div class="invalid-feedback">
                                    {{$errors->first('resume')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Original Passport: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="original_passport" id="original_passport" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the original passport value.
                            </div>
                            @if($errors->has('original_passport'))
                                <div class="invalid-feedback">
                                    {{$errors->first('original_passport')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Passport Xerox Copy: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="passport_xerox_copy" id="passport_xerox_copy" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the passport Xerox copy value.
                            </div>
                            @if($errors->has('passport_xerox_copy'))
                                <div class="invalid-feedback">
                                    {{$errors->first('passport_xerox_copy')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Academic Certificates: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="academic_certificates" id="academic_certificates" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the academic certificate value.
                            </div>
                            @if($errors->has('academic_certificates'))
                                <div class="invalid-feedback">
                                    {{$errors->first('academic_certificates')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Original Academic Certificates: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="original_academic" id="original_academic" required>
                                <option value disabled selected> Choose One </option>
                                <option value="original"> Original </option>
                                <option value="copy"> Copy </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the original academic certificate value.
                            </div>
                            @if($errors->has('original_academic'))
                                <div class="invalid-feedback">
                                    {{$errors->first('original_academic')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Professional Training: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="professional_training" id="professional_training" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the professional training value.
                            </div>
                            @if($errors->has('professional_training'))
                                <div class="invalid-feedback">
                                    {{$errors->first('professional_training')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Work Certificates: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="work_certificates" id="work_certificates" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the work certificates value.
                            </div>
                            @if($errors->has('work_certificates'))
                                <div class="invalid-feedback">
                                    {{$errors->first('work_certificates')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Medical Reports: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="medical_reports" id="medical_reports" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the medical reports value.
                            </div>
                            @if($errors->has('medical_reports'))
                                <div class="invalid-feedback">
                                    {{$errors->first('medical_reports')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Original Driving License: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="original_driving_license" id="original_driving_license" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the original driving license value.
                            </div>
                            @if($errors->has('original_driving_license'))
                                <div class="invalid-feedback">
                                    {{$errors->first('original_driving_license')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Driving License Copy: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="driving_license_copy" id="driving_license_copy" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the driving license copy value.
                            </div>
                            @if($errors->has('driving_license_copy'))
                                <div class="invalid-feedback">
                                    {{$errors->first('driving_license_copy')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Photographs: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="photographs" id="photographs" required>
                                <option value disabled selected> Choose One </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the photographs value.
                            </div>
                            @if($errors->has('photographs'))
                                <div class="invalid-feedback">
                                    {{$errors->first('photographs')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Photograph Image:</label>
                            <input type="file" class="form-control" name="photograph_image" id="photograph_image">
                            <div class="invalid-feedback">
                                Please upload the photograph image.
                            </div>
                            @if($errors->has('photograph_image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('photograph_image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Passport Image:</label>
                            <input type="file" class="form-control" name="passport_image" id="passport_image">
                            <div class="invalid-feedback">
                                Please upload the passport image.
                            </div>
                            @if($errors->has('passport_image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('passport_image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Signature Image:</label>
                            <input type="file" class="form-control" name="signature_image" id="signature_image">
                            <div class="invalid-feedback">
                                Please upload the signature image.
                            </div>
                            @if($errors->has('signature_image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('signature_image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-candidate-document">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
