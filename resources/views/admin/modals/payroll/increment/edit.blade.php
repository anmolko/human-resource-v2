<div id="edit_increment" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Increment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateincrement','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                    
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Employee <span class="text-danger">*</span></label>
                            <input type="text" name="employee"  class="form-control" value="{{ucwords(@$payroll_info->employee->user->name)}}" readonly>
                           
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Increment Month<span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control floating updatemonth" id="editdatetimepickermonthincrement" name="month" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter a increment month.
                                </div>
                                @if($errors->has('month'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('month')}}
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>

                
                    <div class="form-group">
                        <label>Increment Amount<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">NPR</span>
                            </div>
                            <input type="number" name="amount"  class="form-control updateamount" required>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                            <div class="invalid-feedback">
                                Please enter a increment amount.
                            </div>
                            @if($errors->has('amount'))
                                <div class="invalid-feedback">
                                    {{$errors->first('amount')}}
                                </div>
                            @endif
                        </div>
                        
                    </div>
                  

                    <div class="form-group">
                        <label>Increment Purpose<span class="text-danger">*</span> </label>
                        <textarea class="form-control updatepurpose" name="purpose" id="purpose" rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Please enter a increment purpose.
                        </div>
                        @if($errors->has('purpose'))
                            <div class="invalid-feedback">
                                {{$errors->first('purpose')}}
                            </div>
                        @endif
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Update</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
