<div id="edit_candidate_language" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Language Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatelanguage','novalidate'=>'']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Language:</label>
                            <select class="custom-select select-height" name="language" id="language" required>
                                <option value disabled> Select language </option>
                                <option value="english"> English </option>
                                <option value="nepali"> Nepali </option>
                                <option value="hindi"> Hindi </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Speaking:</label>
                            <select class="custom-select select-height" name="speaking" id="speaking" required>
                                <option value disabled> Select Speaking </option>
                                <option value="excellent"> Excellent </option>
                                <option value="good"> Good </option>
                                <option value="basic"> Basic </option>
                                <option value="poor"> Poor </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reading:</label>
                            <select class="custom-select select-height" name="reading" id="reading" required>
                                <option value disabled> Select Reading </option>
                                <option value="excellent"> Excellent </option>
                                <option value="good"> Good </option>
                                <option value="basic"> Basic </option>
                                <option value="poor"> Poor </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Writing:</label>
                            <select class="custom-select select-height" name="writing" id="writing" required>
                                <option value disabled> Select Writing </option>
                                <option value="excellent"> Excellent </option>
                                <option value="good"> Good </option>
                                <option value="basic"> Basic </option>
                                <option value="poor"> Poor </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-candidate-language">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
