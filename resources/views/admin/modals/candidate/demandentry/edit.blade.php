<div id="edit_candidate_demandentry" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Candidate Demand Job Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecandidatedemandentry','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    <label>Updating Candidate data for: <span class="text-danger">*</span></label>
                    <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}">
                    <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Skills:</label>
                            <textarea type="text" class="form-control" rows="2" name="skills" id="skills" required>
                                        </textarea>
                            <div class="invalid-feedback">
                                Please enter the needed skills.
                            </div>
                            @if($errors->has('skills'))
                                <div class="invalid-feedback">
                                    {{$errors->first('skills')}}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Actual Job Category: <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="job_category_id" id="job_category_id" required>
                                <option value disabled selected> Select Job Category </option>
                                @foreach($jobcategory as $cat)
                                    <option value="{{$cat->id}}">{{ucwords($cat->name)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the job category
                            </div>
                            @if($errors->has('job_category_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('job_category_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Salary: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="salary" id="salary" required>
                            <div class="invalid-feedback">
                                Please enter the previous job salary.
                            </div>
                            @if($errors->has('salary'))
                                <div class="invalid-feedback">
                                    {{$errors->first('salary')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input update-enable-demand-entry" type="checkbox" value="" id="invalidChecked" >
                                <label class="form-check-label" for="invalidChecked">
                                    Enable Demand Entry
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Company Name: </label>
                            <select class="custom-select update-demand-company-name select-height" name="demand_info_id" id="demand_info_id" disabled>
                                <option value disabled selected> Select Company Name </option>
                                @foreach($demandinfo as $demand)
                                    <option value="{{$demand->id}}">{{ucwords($demand->company_name)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the company name.
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
                            <label>Job Category:</label>
                            <select class="custom-select update-demand-job-category select-height update_job_to_demand_id" name="job_to_demand_id" id="update_job_to_demand_id" disabled>
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Issued Date:</label>
                            <input type="text" class="form-control update-demand-issue-date" name="issued_date" id="issued_date" readonly>
                            <div class="invalid-feedback">
                                Please select the issued date.
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
                            <label>Current Demand Status Applied Date:</label>
                            <input type="text" class="form-control update-demand-status-applied" name="status_applied_date" id="edit_status_applied_dates" readonly>
                            <div class="invalid-feedback">
                                Please select the status applied date.
                            </div>
                            @if($errors->has('status_applied_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('status_applied_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. of Pax:</label>
                            <input type="number" min="1" class="form-control update-demand-number-pax" name="num_of_pax" id="num_of_pax" readonly>
                            <div class="invalid-feedback">
                                Please enter the number of pax.
                            </div>
                            @if($errors->has('num_of_pax'))
                                <div class="invalid-feedback">
                                    {{$errors->first('num_of_pax')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Agent Name:</label>
                            <select class="custom-select update-demand-agency-name select-height" name="overseas_agent_id" id="overseas_agent_id" disabled>
                                <option value disabled selected> Select Agent Name </option>
                                @foreach($overseasagent as $agent)
                                    <option value="{{$agent->id}}">{{ucwords($agent->fullname)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select the Agent name.
                            </div>
                            @if($errors->has('overseas_agent_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('overseas_agent_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Status:</label>
                            <select class="custom-select update-demand-sub-status select-height" name="sub_status_id" id="sub_status"  disabled>
                                <option value disabled selected> Select Sub Status </option>
                                @foreach($substatus as $substat)
                                    <option value="{{$substat->id}}">{{ucwords($substat->name)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please enter the sub status.
                            </div>
                            @if($errors->has('sub_status_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('sub_status_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Candidate's Receivable Salary from Job:</label>
                            <input type="number" class="form-control update-demand-receivable-salary" name="receivable_salary" id="receivable_salary" readonly/>
                            <div class="invalid-feedback">
                                Please enter the receivable salary.
                            </div>
                            @if($errors->has('receivable_salary'))
                                <div class="invalid-feedback">
                                    {{$errors->first('receivable_salary')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reference Agent's Name:</label>
                            <input type="text" class="form-control update-demand-reference-agent" value="{{$candidate_personal->referenceInfo ? $candidate_personal->referenceInfo->reference_name:'Direct Office'}}" name="reference_agent" readonly/>
                            <div class="invalid-feedback">
                                Please enter the receivable salary.
                            </div>
                            @if($errors->has('receivable_salary'))
                                <div class="invalid-feedback">
                                    {{$errors->first('receivable_salary')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reference Agent's receivable amount:</label>
                            <input type="number" class="form-control update-demand-reference-amount" name="reference_amount" id="reference_amount" readonly/>
                            <div class="invalid-feedback">
                                Please enter the receivable salary.
                            </div>
                            @if($errors->has('receivable_salary'))
                                <div class="invalid-feedback">
                                    {{$errors->first('receivable_salary')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remarks:</label>
                            <textarea type="text" class="form-control update-demand-remarks" name="remarks" id="remarks" readonly>
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
                    <button class="btn btn-primary submit-btn" id="update-candidate-demandentry">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
