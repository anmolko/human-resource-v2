<div id="add_insurance_agent" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Insurance Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'insurance-agent.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}


                <div class="form-group">
                    <label>Company Name <span class="text-danger">*</span></label>
                    <input class="form-control" name="company_name" type="text" required>
                    <div class="invalid-feedback">
                        Please enter Company Name.
                    </div>
                    @if($errors->has('company_name'))
                        <div class="invalid-feedback">
                            {{$errors->first('company_name')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Company Address <span class="text-danger">*</span></label>
                    <input class="form-control"  name="company_address" type="text" required>
                    <div class="invalid-feedback">
                        Please enter Company Address.
                    </div>
                    @if($errors->has('company_address'))
                        <div class="invalid-feedback">
                            {{$errors->first('company_address')}}
                        </div>
                    @endif
                </div>

                <div class="row">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Contact Number <span class="text-danger">*</span></label>
                            <input class="form-control"  name="company_contact_num" type="number" required>
                            <div class="invalid-feedback">
                                Please enter Company Contact Number.
                            </div>
                            @if($errors->has('company_contact_num'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_contact_num')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Email <span class="text-danger">*</span></label>
                            <input class="form-control"  name="company_email" type="email" required>
                            <div class="invalid-feedback">
                                Please enter Company Email.
                            </div>
                            @if($errors->has('company_email'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_email')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="status"  required>
                                <option value disabled > Select Status</option>
                                <option value="continued" selected> Continued </option>
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

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Personal Information</h4>
                </div>
                <div class="form-group">
                    <label>Full Name </label>
                    <input class="form-control"  name="personal_fullname" type="text">
                    <div class="invalid-feedback">
                        Please enter Full Name.
                    </div>
                    @if($errors->has('personal_fullname'))
                        <div class="invalid-feedback">
                            {{$errors->first('personal_fullname')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Designation </label>
                            <input class="form-control"  name="personal_designation" type="text">
                            <div class="invalid-feedback">
                                Please enter Designation.
                            </div>
                            @if($errors->has('personal_designation'))
                                <div class="invalid-feedback">
                                    {{$errors->first('personal_designation')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Personal Email </label>
                            <input class="form-control" name="personal_email" type="email" >
                            <div class="invalid-feedback">
                                Please enter personal email
                            </div>
                            @if($errors->has('personal_email'))
                                <div class="invalid-feedback">
                                    {{$errors->first('personal_email')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Personal Mobile Num</label>
                            <input class="form-control" name="personal_mobile_num" type="number">
                            <div class="invalid-feedback">
                                Please enter Personal Mobile.
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
                            <label>Personal Contact Num </label>
                            <input class="form-control"  name="personal_contact_num" type="number">
                            <div class="invalid-feedback">
                                Please enter Personal contact number.
                            </div>
                            @if($errors->has('personal_contact_num'))
                                <div class="invalid-feedback">
                                    {{$errors->first('personal_contact_num')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
