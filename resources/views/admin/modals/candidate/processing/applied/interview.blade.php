<div id="assign_interview_date" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Assign Interview Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--                {!! Form::open(['route' => 'candidate-professional-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}--}}

                <div class="form-group">
                    <label>Interview Date: </label>
                    <input type="text" class="form-control interview-date" name="interview_date" required>
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

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-interview-update">Submit</button>
                </div>
                {{--                {!! Form::close() !!}--}}
            </div>
        </div>
    </div>
</div>
