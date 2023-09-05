<div id="edit_job_demand" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add JObs to Demand Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatejobsdemand','novalidate'=>'']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Demand Ref No. <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="demand_information_id" id="demand_information_id" required>
                                <option value disabled selected> Select Demand Ref No.</option>
                                @foreach($demands as $demand)
                                    <option value="{{$demand->id}}">{{ucwords($demand->ref_no)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select Demand Ref number.
                            </div>
                            @if($errors->has('demand_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('demand_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Name <span class="text-danger">*</span></label>
                            <input class="form-control select-company" name="company_name" id="company_name_jobs" type="text" readonly>
                            <div class="invalid-feedback">
                                Please enter Company Name.
                            </div>
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Client Name <span class="text-danger">*</span></label>
                            <input class="form-control select-client-name" name="client_name" id="client_name" type="text" readonly>
                            <div class="invalid-feedback">
                                Please enter Company Name.
                            </div>
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="job_status" id="job_status"> Completed
                                </label>
                            </div>
                            <div class="invalid-feedback">
                                Please select the status
                            </div>
                            @if($errors->has('job_status'))
                                <div class="invalid-feedback">
                                    {{$errors->first('job_status')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="las la-folder-plus"></i> Add Jobs</h4>
                </div>
                <div class="form-group">
                    <label>Job Category <span class="text-danger">*</span></label>
                    <select class="custom-select" id="job_category_id" name="job_category_id" required>
                        <option value disabled selected> Select Job Category.</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ucwords($category->name)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select Job Category.
                    </div>
                    @if($errors->has('job_category_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('job_category_id')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Requirements <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" id="requirements" name="requirements" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">per person</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter requirements
                            </div>
                            @if($errors->has('requirements'))
                                <div class="invalid-feedback">
                                    {{$errors->first('requirements')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Minimum Qualification <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="min_qualification" id="min_qualification" required>
                                <option value disabled selected> Select Min Qualification.</option>
                                <option value="primary-education">Primary Education </option>
                                <option value="secondary-education">Secondary Education</option>
                                <option value="slc-pass">SLC Pass</option>
                                <option value="intermediate-pass">Intermediate Pass</option>
                                <option value="bachelor-pass">Bachelor Pass</option>
                                <option value="post-graduate-pass">Post Graduate Pass</option>
                                <option value="none">None</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a state.
                            </div>
                            @if($errors->has('min_qualification'))
                                <div class="invalid-feedback">
                                    {{$errors->first('min_qualification')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Contact Period <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="contact_period" id="contact_period" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">per Yr</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter the contact period.
                            </div>
                            @if($errors->has('contact_period'))
                                <div class="invalid-feedback">
                                    {{$errors->first('contact_period')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Working <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="working" id="working" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">per days/weeks</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter the working per days/weeks
                            </div>
                            @if($errors->has('working'))
                                <div class="invalid-feedback">
                                    {{$errors->first('working')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Holidays </label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="holidays" id="holidays"  />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">per days/year</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter the holidays per days/year.
                            </div>
                            @if($errors->has('holidays'))
                                <div class="invalid-feedback">
                                    {{$errors->first('holidays')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Hours <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" class="form-control" name="hours" id="hours" required />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">per days</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter the hours per days
                            </div>
                            @if($errors->has('hours'))
                                <div class="invalid-feedback">
                                    {{$errors->first('hours')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Overtime  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="overtime" id="overtime" required>
                                <option value disabled selected> Select Overtime </option>
                                <option value="yes"> Yes </option>
                                <option value="no"> No </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the overtime status.
                            </div>
                            @if($errors->has('overtime'))
                                <div class="invalid-feedback">
                                    {{$errors->first('overtime')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Overtime per month </label>
                            <div class="input-group">
                                <input type="number" min="0" class="form-control" name="overtime_per_month" id="overtime_per_month"  />
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">per month</span>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please enter the overtime per month
                            </div>
                            @if($errors->has('overtime_per_month'))
                                <div class="invalid-feedback">
                                    {{$errors->first('overtime_per_month')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Category  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="currency" id="currency" required>
                                <option value disabled selected> Select Currency </option>
                                @foreach(@$country_settings as $country_setting)

                                    <option value="{{@$country_setting->currency}}"> {{ucwords(@$country_setting->country)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a Currency.
                            </div>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{$errors->first('currency')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Accommodation  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="accommodation" id="accommodation" required>
                                <option value disabled selected> Select accommodation </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a accommodation option.
                            </div>
                            @if($errors->has('accommodation'))
                                <div class="invalid-feedback">
                                    {{$errors->first('accommodation')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Food Facilities  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="food_facilities" id="food_facilities" required>
                                <option value disabled selected> Select Food facilities </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a Food facilities option.
                            </div>
                            @if($errors->has('food_facilities'))
                                <div class="invalid-feedback">
                                    {{$errors->first('food_facilities')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Tickets  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="ticket" id="ticket" required>
                                <option value disabled selected> Select Tickets </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a Ticket.
                            </div>
                            @if($errors->has('ticket'))
                                <div class="invalid-feedback">
                                    {{$errors->first('ticket')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Salary <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" min="1" class="form-control" name="salary" id="salary" required />
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">per month</span>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                        Please enter the salary per month
                    </div>
                    @if($errors->has('salary'))
                        <div class="invalid-feedback">
                            {{$errors->first('salary')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Category Amount <span class="small text-danger">(Amount given to candidate if selected and deployed)</span></label>
                    <div class="input-group">
                        <input type="number" min="1" class="form-control" name="category_amount" id="category_amount" />
                    </div>
                    <div class="invalid-feedback">
                        Please enter the Category Amount.
                    </div>
                    @if($errors->has('category_amount'))
                        <div class="invalid-feedback">
                            {{$errors->first('category_amount')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Commission Amount <span class="small text-danger">(Amount given to oversea agent)</span></label>
                    <div class="input-group">
                        <input type="number" min="1" class="form-control" name="commission_amount" id="commission_amount" />
                    </div>
                    <div class="invalid-feedback">
                        Please enter the Commission Amount.
                    </div>
                    @if($errors->has('commission_amount'))
                        <div class="invalid-feedback">
                            {{$errors->first('commission_amount')}}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Medical In  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="medical_in" id="medical_in" required>
                                <option value disabled selected> Select Medical In </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the medical in.
                            </div>
                            @if($errors->has('medical_in'))
                                <div class="invalid-feedback">
                                    {{$errors->first('medical_in')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Medical Company <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="medical_company" id="medical_company" required>
                                <option value disabled selected> Select Medical company </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select medical company.
                            </div>
                            @if($errors->has('medical_company'))
                                <div class="invalid-feedback">
                                    {{$errors->first('medical_company')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Insurance In  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="insurance_in" id="insurance_in" required>
                                <option value disabled selected> Select Insurance In </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the Insurance in.
                            </div>
                            @if($errors->has('insurance_in'))
                                <div class="invalid-feedback">
                                    {{$errors->first('insurance_in')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Insurance Company <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="insurance_company" id="insurance_company" required>
                                <option value disabled selected> Select Medical company </option>
                                <option value="company"> Company </option>
                                <option value="self"> Self </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select Insurance company.
                            </div>
                            @if($errors->has('insurance_company'))
                                <div class="invalid-feedback">
                                    {{$errors->first('insurance_company')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="las la-exclamation-circle"></i> For Malaysia Only</h4>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Levy </label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="levy" id="levy"> Yes
                                </label>
                            </div>
                            <div class="invalid-feedback">
                                Please choose levy option
                            </div>
                            @if($errors->has('levy'))
                                <div class="invalid-feedback">
                                    {{$errors->first('levy')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Levy Amount </label>
                            <input class="form-control" min="0" value="0" name="levy_amount" id="levy_amount" type="number">
                            <div class="invalid-feedback">
                                Please enter the Levy amount.
                            </div>
                            @if($errors->has('levy_amount'))
                                <div class="invalid-feedback">
                                    {{$errors->first('levy_amount')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Remarks </label>
                    <textarea class="form-control" name="remarks" id="remarks" rows="4" ></textarea>
                    <div class="invalid-feedback">
                        Please enter document status remarks
                    </div>
                    @if($errors->has('remarks'))
                        <div class="invalid-feedback">
                            {{$errors->first('remarks')}}
                        </div>
                    @endif
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-jobs">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
