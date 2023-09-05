<div id="edit_candidate_bank" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Bank Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatebank','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bank Details: <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" name="bank_details" id="bank_details" required>
                                        </textarea>
                            <div class="invalid-feedback">
                                Please enter the bank details.
                            </div>
                            @if($errors->has('bank_details'))
                                <div class="invalid-feedback">
                                    {{$errors->first('bank_details')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cheque Copy: <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="cheque_image" id="cheque_image" required>
                            <div class="invalid-feedback">
                                Please upload cheque image.
                            </div>
                            @if($errors->has('cheque_image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('cheque_image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks: <span class="text-danger">*</span></label>
                            <textarea type="text" class="form-control" name="bank_remarks" id="bank_remarks" required>
                                        </textarea>
                            <div class="invalid-feedback">
                                Please enter the bank remarks.
                            </div>
                            @if($errors->has('bank_remarks'))
                                <div class="invalid-feedback">
                                    {{$errors->first('bank_remarks')}}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>


                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-candidate-bank">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
