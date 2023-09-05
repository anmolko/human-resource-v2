<div id="add_visa_stamping" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Visa Stamping Process </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'visa-stamp.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_visa_stamp" value="" />
                <input type="hidden" name="job_to_demand_id" id="job_to_demand_id_visa_stamp" value="" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">
                                    Stamping List Option</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Stamping Forward Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control visa_issued_date" name="stamping_forward_date" id="stamping_forward_date" required>
                                    <div class="invalid-feedback">
                                        Please select the stamping Forward Date.
                                    </div>
                                    @if($errors->has('visa_issued_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('visa_issued_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Stamping Collection Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control visa_issued_date" name="stamping_collection_date" id="stamping_collection_date" required>
                                    <div class="invalid-feedback">
                                        Please select the visa expiry date.
                                    </div>
                                    @if($errors->has('visa_expiry_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('visa_expiry_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea type="text" class="form-control" rows="2" name="visa_stamp_remarks" id="stamp_remarks"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the visa stamp remarks
                                    </div>
                                    @if($errors->has('visa_stamp_remarks'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('visa_stamp_remarks')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sub Status Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Sub Status: </label>
                                    <select class="custom-select country select-height" name="sub_status_id" id="stamping_sub_status">
                                        <option value disabled selected> Select Sub Status</option>
                                        @foreach($sub_status as $sub)
                                            <option value="{{$sub->id}}">{{ucwords($sub->name)}} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select the sub status.
                                    </div>
                                    @if($errors->has('sub_status_id'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('sub_status_id')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea type="text" class="form-control" rows="2" name="remarks" id="stamping_remarks"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the remarks
                                    </div>
                                    @if($errors->has('remarks'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('remarks')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-selected-candidate-form">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
