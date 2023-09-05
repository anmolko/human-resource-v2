<div id="add_complain" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Complain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'complain-manager.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Candidate <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="candidate_info_id" required>
                                <option value disabled selected> Select Candidate</option>
                                @foreach($candidate as $personal)
                                    <option value="{{$personal->id}}">{{ucwords($personal->candidate_firstname)}} {{ucwords($personal->candidate_lastname)}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a Candidate to register complaint.
                            </div>
                            @if($errors->has('candidate_info_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('candidate_info_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Passport Number <span class="text-danger">*</span></label>
                            <input class="form-control"  name="passport_num" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Passport Number.
                            </div>
                            @if($errors->has('passport_num'))
                                <div class="invalid-feedback">
                                    {{$errors->first('passport_num')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Job Category <span class="text-danger">*</span></label>
                            <input class="form-control"  name="job_category" type="text" required>
                            <div class="invalid-feedback">
                                Please enter the job category.
                            </div>
                            @if($errors->has('job_category'))
                                <div class="invalid-feedback">
                                    {{$errors->first('job_category')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Name <span class="text-danger">*</span></label>
                            <input class="form-control"  name="company" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Company Name.
                            </div>
                            @if($errors->has('company'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Contact Person <span class="text-danger">*</span></label>
                            <input class="form-control"  name="contact_person" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Contact Person.
                            </div>
                            @if($errors->has('contact_person'))
                                <div class="invalid-feedback">
                                    {{$errors->first('contact_person')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Regd by <span class="text-danger">*</span></label>
                            <input class="form-control" name="regd_by" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Regd by.
                            </div>
                            @if($errors->has('regd_by'))
                                <div class="invalid-feedback">
                                    {{$errors->first('regd_by')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Assignee  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="employee_id" required>
                                <option value disabled selected> Select Assignee</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{ucwords($employee->user->name)}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a Assignee.
                            </div>
                            @if($errors->has('employee_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('employee_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Type  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="type" required>
                                <option value disabled selected> Select Type</option>
                                <option value="accommodation">Accommodation</option>
                                <option value="criminal case">Criminal Case</option>
                                <option value="food">Food</option>
                                <option value="injuries">Injuries</option>
                                <option value="medical">Medical</option>
                                <option value="misunderstanding">Misunderstanding</option>
                                <option value="no job allocation">No Job Allocation</option>
                                <option value="no salary">No Salary</option>
                                <option value="personal">Personal</option>
                                <option value="problem with colleague">Problem With Colleague</option>
                                <option value="return back before visa expiration">Return Back Before Visa Expiration</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a Assignee.
                            </div>
                            @if($errors->has('employee_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('employee_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="middle">
                    <div class="form-group">
                        <label> Set Complain Priority <span class="text-danger">*</span></label><br/>
                        <div class="stars">
                            <input class="star star-5" id="star-5" type="radio" value="5" name="priority"/>
                            <label class="star star-5" for="star-5"></label>
                            <input class="star star-4" id="star-4" type="radio" value="4" name="priority"/>
                            <label class="star star-4" for="star-4"></label>
                            <input class="star star-3" id="star-3" type="radio" value="3" name="priority"/>
                            <label class="star star-3" for="star-3"></label>
                            <input class="star star-2" id="star-2" type="radio" value="2" name="priority"/>
                            <label class="star star-2" for="star-2"></label>
                            <input class="star star-1" id="star-1" type="radio" value="1" name="priority" checked/>
                            <label class="star star-1" for="star-1"></label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="subject" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter the subject.
                            </div>
                            @if($errors->has('subject'))
                                <div class="invalid-feedback">
                                    {{$errors->first('subject')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label> Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter the message.
                            </div>
                            @if($errors->has('message'))
                                <div class="invalid-feedback">
                                    {{$errors->first('message')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Type  <span class="text-danger">*</span></label>
                    <select class="custom-select select-height" name="status" required>
                        <option value disabled selected> Select Status</option>
                        <option value="ignore">Ignore</option>
                        <option value="new">New</option>
                        <option value="pending">Pending</option>
                        <option value="solved">Solved</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a status.
                    </div>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{$errors->first('status')}}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Regd Date <span class="text-danger">*</span></label>
                            <input class="form-control" name="regd_date" id="regd_datepicker" type="text" required>
                            <div class="invalid-feedback">
                                Please enter personal contact.
                            </div>
                            @if($errors->has('regd_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('regd_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Solved Date</label>
                            <input class="form-control" name="solved_date" id="solved_datepicker" type="text">
                            <div class="invalid-feedback">
                                Please enter solved date.
                            </div>
                            @if($errors->has('solved_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('solved_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-advertising-agent">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
