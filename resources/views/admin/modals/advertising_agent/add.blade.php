<div id="add_advertising_agent" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Advertising Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'advertising-agent.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Registration No <span class="text-danger">*</span></label>
                            <input class="form-control" name="registration_no" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Registration Number.
                            </div>
                            @if($errors->has('registration_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('registration_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label>Company Name <span class="text-danger">*</span></label>
                                <input class="form-control"  name="company_name" type="text" required>
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
                            <label>Address <span class="text-danger">*</span></label>
                            <input class="form-control"  name="address" type="text" required>
                            <div class="invalid-feedback">
                                Please enter the address.
                            </div>
                            @if($errors->has('address'))
                                <div class="invalid-feedback">
                                    {{$errors->first('address')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label >Country <span class="text-danger">*</span></label>
                            <select class="custom-select" name="country" id="country" required>
                                <option value disabled selected> Select Country</option>
                                @foreach($countries as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a Country.
                            </div>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country')}}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input class="form-control"  name="contact" type="number" required>
                            <div class="invalid-feedback">
                                Please enter Contact Number.
                            </div>
                            @if($errors->has('contact'))
                                <div class="invalid-feedback">
                                    {{$errors->first('contact')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                         <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="email" type="email" required>
                            <div class="invalid-feedback">
                                Please enter Clinic Email.
                            </div>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>Status  <span class="text-danger">*</span></label>
                    <select class="custom-select select-height" name="status"  required>
                        <option value disabled selected> Select Status</option>
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

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Contact Personal Details</h4>
                </div>


                <div class="form-group">
                    <label>Fullname <span class="text-danger">*</span></label>
                    <input class="form-control" name="fullname" type="text">
                    <div class="invalid-feedback">
                        Please enter Fullname.
                    </div>
                    @if($errors->has('fullname'))
                        <div class="invalid-feedback">
                            {{$errors->first('fullname')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Designation <span class="text-danger">*</span></label>
                            <input class="form-control" name="designation" type="text">
                            <div class="invalid-feedback">
                                Please enter Designation.
                            </div>
                            @if($errors->has('designation'))
                                <div class="invalid-feedback">
                                    {{$errors->first('designation')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Personal Contact <span class="text-danger">*</span></label>
                            <input class="form-control" name="personal_contact" type="number">
                            <div class="invalid-feedback">
                                Please enter personal contact.
                            </div>
                            @if($errors->has('personal_contact'))
                                <div class="invalid-feedback">
                                    {{$errors->first('personal_contact')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Personal Mobile <span class="text-danger">*</span></label>
                            <input class="form-control" name="personal_mobile" type="number">
                            <div class="invalid-feedback">
                                Please enter Personal mobile.
                            </div>
                            @if($errors->has('personal_mobile'))
                                <div class="invalid-feedback">
                                    {{$errors->first('personal_mobile')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Personal Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="personal_email" type="email">
                            <div class="invalid-feedback">
                                Please enter personal email.
                            </div>
                            @if($errors->has('personal_email'))
                                <div class="invalid-feedback">
                                    {{$errors->first('personal_email')}}
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
