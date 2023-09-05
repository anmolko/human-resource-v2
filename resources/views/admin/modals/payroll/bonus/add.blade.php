<div id="add_bonus" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bonus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['route' => 'bonus.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                    
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Employee <span class="text-danger">*</span></label>
                            <input type="text" name="employee"  class="form-control" value="{{ucwords(@$payroll_info->employee->user->name)}}" readonly>
                            <input type="hidden" name="payroll_id"  class="form-control" value="{{@$payroll_info->id}}" >
                          
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                                <label>Bonus Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter bonus name.
                                </div>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="d-block">Bonus Month<span class="text-danger">*</span></label>
                            <div class="cal-icon">
                                <input class="form-control floating" id="datetimepickermonthbonus" name="month" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter a bonus month.
                                </div>
                                @if($errors->has('month'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('month')}}
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                       
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Bonus Amount<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">NPR</span>
                                </div>
                                <input type="number" name="amount"  class="form-control" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a bonus amount.
                                </div>
                                @if($errors->has('amount'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('amount')}}
                                    </div>
                                @endif
                            </div>
                           
                        </div>
                        
                    </div>

                </div>

                    <div class="form-group">
                        <label>Bonus Description<span class="text-danger">*</span> </label>
                        <textarea class="form-control" name="description" id="description" rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Please enter a bonus description.
                        </div>
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{$errors->first('description')}}
                            </div>
                        @endif
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>