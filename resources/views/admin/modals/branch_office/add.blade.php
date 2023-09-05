<div id="add_branch_office" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Branch Office</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'branch-office.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}
                    
                    <div class="form-group">
                        <label>Ref No. <span class="text-danger">*</span></label>
                        <input class="form-control" name="ref_no" type="text" required>
                        <div class="invalid-feedback">
                            Please enter ref no.
                        </div>
                        @if($errors->has('ref_no'))
                            <div class="invalid-feedback">
                                {{$errors->first('ref_no')}}
                            </div>
                        @endif
                    </div>
              
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Branch Office Name <span class="text-danger">*</span></label>
                                <input class="form-control"  name="branch_office_name" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter branch office name.
                                </div>
                                @if($errors->has('branch_office_name'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('branch_office_name')}}
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label> Address <span class="text-danger">*</span></label>
                                <input class="form-control"  name="address" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter  Address.
                                </div>
                                @if($errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('address')}}
                                    </div>
                                @endif
                            </div>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Contact Number <span class="text-danger">*</span></label>
                                <input class="form-control"  name="contact_no" type="number" required>
                                <div class="invalid-feedback">
                                    Please enter  Contact Number.
                                </div>
                                @if($errors->has('contact_no'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('contact_no')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status  </label>
                                <select class="custom-select select-height" name="status"  >
                                    <option value="discontinued"  selected> Select Status</option>
                                    <option value="continued"> Continued </option>
                                    <option value="discontinued"> Dis-Continued </option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a Status.
                                </div>
                                @if($errors->has('status'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('status')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Remarks </label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="4" ></textarea>
                        <div class="invalid-feedback">
                            Please enter a remarks.
                        </div>
                        @if($errors->has('remarks'))
                            <div class="invalid-feedback">
                                {{$errors->first('remarks')}}
                            </div>
                        @endif
                    </div>
                    
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>