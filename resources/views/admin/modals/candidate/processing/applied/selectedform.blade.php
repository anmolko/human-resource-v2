<div id="applied_to_selected" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Change Applied to Selected</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateselected','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sub Status Information</h4>
                            </div>
                            <div class="card-body">

                                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id" readonly/>
                                <div class="form-group">
                                    <label>Sub Status: </label>
                                    <select class="custom-select country select-height" name="sub_status_id" id="applied_sub_status">
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
                                    <textarea type="text" class="form-control" rows="2" name="remarks" id="applied_remarks"></textarea>
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

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Change only if you want to update demand offer details</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Candidate Demand Information</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Applied Date: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control demand-applied-date" name="status_applied_date" id="applied_status_applied_date" required>
                                            <div class="invalid-feedback">
                                                Please select the Status applied date.
                                            </div>
                                            @if($errors->has('status_applied_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('status_applied_date')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Company Name: </label>
                                            <select class="custom-select country select-height demand-company-name" name="demand_info_id" id="applied_demand_info_id">
                                                <option value disabled selected> Select Company Name</option>
                                                @foreach($demand_info as $demand)
                                                    <option value="{{$demand->id}}">{{ucwords($demand->company_name)}} </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the sub status.
                                            </div>
                                            @if($errors->has('demand_info_id'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('demand_info_id')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Salary: </label>
                                            <input type="number" class="form-control" name="receivable_salary" id="applied_receivable_salary">
                                            <div class="invalid-feedback">
                                                Please enter salary.
                                            </div>
                                            @if($errors->has('salary'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('salary')}}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Job Category:</label>
                                            <select class="custom-select job_to_demand_cat select-height" name="job_to_demand_id" id="applied_job_to_demand_id">
                                                <option value disabled selected> Select Job Category </option>

                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the related job category.
                                            </div>
                                            @if($errors->has('job_to_demand_id'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('job_to_demand_id')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Attach Interview date here if needed</h4>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Interview date Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label> Interview Date: </label>
                                    <input type="text" class="form-control demand-applied-date" name="interview_date" >
                                    <div class="invalid-feedback">
                                        Please select the interview date.
                                    </div>
                                    @if($errors->has('interview_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('interview_date')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea type="text" class="form-control" rows="4" name="interview_remarks"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the remarks
                                    </div>
                                    @if($errors->has('interview_remarks'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('interview_remarks')}}
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
