<div id="one_reject_modal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-reject"> Reject Candidate </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation rejectcandidate','novalidate'=>'']) !!}
                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_reject" readonly>
                <input type="hidden" name="demand_info_id" id="demand_info_id_reject" readonly>
                <input type="hidden" name="job_to_demand_id" id="job_to_demand_id_reject" readonly>
                <input type="hidden" name="status" id="current_status_reject" readonly>

                <div class="form-group">
                    <label>Sub Status: </label>
                    <select class="custom-select country select-height" name="sub_status_id" id="sub_status_reject" required>
                        <option value disabled selected> Select Sub Status</option>
                        @foreach($sub_status as $sub)
                            <option value="{{$sub->id}}">{{ucwords($sub->name)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select the sub status.
                    </div>
                    @if($errors->has('sub_status'))
                        <div class="invalid-feedback">
                            {{$errors->first('sub_status')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Status Applied Date: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control visa_issued_date" name="status_applied_date" id="status_applied_date_reject" required>
                    <div class="invalid-feedback">
                        Please enter status applied date.
                    </div>
                    @if($errors->has('status_applied_date'))
                        <div class="invalid-feedback">
                            {{$errors->first('status_applied_date')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Remarks: </label>
                    <textarea type="text" class="form-control" rows="2" name="remarks" id="remarks_reject"></textarea>
                    <div class="invalid-feedback">
                        Please enter the remarks
                    </div>
                    @if($errors->has('remarks'))
                        <div class="invalid-feedback">
                            {{$errors->first('remarks')}}
                        </div>
                    @endif
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-reject-back-form">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
