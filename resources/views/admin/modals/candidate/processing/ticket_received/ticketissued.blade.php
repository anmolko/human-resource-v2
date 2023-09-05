<div id="edit_ticket_issued" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Change Ticket Issued Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation ticketissuedfrom','novalidate'=>'']) !!}
                <input type="hidden" name="candidate_personal_information_id" id="candidate_personal_information_id_ticket_issued" readonly/>
                <input type="hidden" name="job_to_demand_id" id="job_to_demand_id_ticket_issued" readonly/>
                <input type="hidden" name="booking_date" id="booking_date_issued" readonly/>
                <input type="hidden" name="booking_description" id="booking_description_issued" readonly/>

                <div class="form-group">
                    <label>Ticket Status: </label>
                    <select class="custom-select country select-height" name="ticket_status" id="ticket_status_issued">
                        <option value disabled selected> Select Ticket Status</option>
                            <option value="issued">Ticket Issued</option>
                            <option value="removed">Remove Issued</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select the Ticket status.
                    </div>
                    @if($errors->has('ticket_status'))
                        <div class="invalid-feedback">
                            {{$errors->first('ticket_status')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Ticket Issued/Removed Date: </label>
                    <input type="text" class="form-control visa_issued_date" name="ticket_status_date" id="ticket_status_date" required>
                    <div class="invalid-feedback">
                        Please enter the ticket issued/removed date.
                    </div>
                    @if($errors->has('ticket_status_date'))
                        <div class="invalid-feedback">
                            {{$errors->first('ticket_status_date')}}
                        </div>
                    @endif
                </div>

                <div class="submit-section">
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<?php
