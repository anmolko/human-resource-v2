<div id="edit_deduction" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Deduction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatededuction','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                    
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Employee <span class="text-danger">*</span></label>
                            <input type="text" name="employee"  class="form-control" value="{{ucwords(@$payroll_info->employee->user->name)}}" readonly>
                           
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                                <label>Deduction Name <span class="text-danger">*</span></label>
                                <input class="form-control updatename" name="deduction_name" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter deduction name.
                                </div>
                                @if($errors->has('deduction_name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('deduction_name')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Deduction Month<span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control floating updatemonth" id="editdatetimepickermonth" name="deduction_month" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter a deduction month.
                                </div>
                                @if($errors->has('deduction_month'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('deduction_month')}}
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                       
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Deduction Amount<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">NPR</span>
                                </div>
                                <input type="number" name="deduction_amount"  class="form-control updateamount" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a deduction amount.
                                </div>
                                @if($errors->has('deduction_amount'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('deduction_amount')}}
                                    </div>
                                @endif
                            </div>
                           
                        </div>
                        
                    </div>

                </div>

                    <div class="form-group">
                        <label>Deduction Description<span class="text-danger">*</span> </label>
                        <textarea class="form-control updatedescription" name="deduction_description" id="deduction_description" rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Please enter a deduction description.
                        </div>
                        @if($errors->has('deduction_description'))
                            <div class="invalid-feedback">
                                {{$errors->first('deduction_description')}}
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
