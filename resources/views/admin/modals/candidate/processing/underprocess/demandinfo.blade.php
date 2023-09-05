<div id="edit_underprocess_demand_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Change Demand Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation underdemandupdate','novalidate'=>'']) !!}
                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_under" readonly>

                <div class="form-group">
                    <label>Company Name: </label>
                    <select class="custom-select country select-height demand-company-name" name="demand_info_id" id="demand_info_id_underpro">
                        <option value disabled selected> Select Company Name</option>
                        @foreach($demand_info as $demand)
                            <option value="{{$demand->id}}">{{ucwords($demand->company_name)}} </option>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Job Category:</label>
                            <select class="custom-select demand-job-category select-height" name="job_to_demand_id" id="underprocess_job_to_demand_id">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Applied Date: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control visa_issued_date" name="applied_date" required>
                            <div class="invalid-feedback">
                                Please select the applied date.
                            </div>
                            @if($errors->has('applied_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('applied_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-underprocess-demandinfo-update">Submit</button>
                </div>
               {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
