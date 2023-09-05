<div id="add_individual_ticketing" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Candidate Ticketing Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'visa-to-ticket.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_individual" readonly/>
                <input type="hidden" name="job_to_demand_id" id="job_to_demand_id_individual" readonly/>
                <input type="hidden" name="demand_info_id" id="demand_info_id_individual" readonly/>
                <input type="hidden" name="demand_job_info_id" id="demand_job_info_id" readonly/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Ticket No: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ticket_no" id="ticket_no" required>
                                    <div class="invalid-feedback">
                                        Please enter the ticket Number.
                                    </div>
                                    @if($errors->has('ticket_no'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('ticket_no')}}
                                        </div>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label>Ticketing agent: </label>
                                    <select class="custom-select country select-height" name="ticketing_agent_id" id="ticketing_agent_id" >
                                        <option value disabled selected> Select ticketing agent company. </option>
                                        @foreach($ticketing_agents as $agent)
                                            <option value="{{$agent->id}}">{{ucwords($agent->company_name)}} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select the agent ID.
                                    </div>
                                    @if($errors->has('ticketing_agent_id'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('ticketing_agent_id')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Airline Ref number</label>
                                    <select class="custom-select select-height" name="airline_id" id="airline_id">
                                        <option value disabled selected> Select airline ref no </option>

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a State.
                                    </div>
                                    @if($errors->has('airline_id'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('airline_id')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Booking Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control booking_date" name="booking_date" id="booking_date_in">
                                    <div class="invalid-feedback">
                                        Please select the Booking Date.
                                    </div>
                                    @if($errors->has('booking_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('booking_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Booking Time: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="booking_time" id="booking_time_in">
                                    <div class="invalid-feedback">
                                        Please select the Booking Date.
                                    </div>
                                    @if($errors->has('booking_time'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('booking_time')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Booking Description: </label>
                                    <textarea type="text" class="form-control" rows="3" name="booking_description" id="booking_description_in"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the booking description
                                    </div>
                                    @if($errors->has('booking_description'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('booking_description')}}
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
                                    <label>Status Applied Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control visa_issued_date" name="status_applied_date" id="status_applied_date" REQUIRED>
                                    <div class="invalid-feedback">
                                        Please enter status applied date.
                                    </div>
                                    @if($errors->has('status_expiry_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('status_expiry_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Sub Status: <span class="text-danger">*</span></label>
                                    <select class="custom-select country select-height" name="sub_status_id" id="sub_status_individual" required>
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
                                    <textarea type="text" class="form-control" rows="2" name="remarks" id="remarks_individual"></textarea>
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
