<div id="edit_agent" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Overseas Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateoverseas','novalidate'=>'','enctype'=>'multipart/form-data']) !!}


                <div class="profile-img-wrap edit-img">
                    <img class="inline-block" id="edit-current-img" src="{{asset('/images/profiles/others.png')}}" alt="agent-profile" >
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" id="editimage" onchange="editLoadFile(event)" name="image">
                    </div>
                    <div class="invalid-feedback">
                        Please choose a Agent picture.
                    </div>
                </div>
                <div class="form-group">
                    <label>Client Number <span class="text-danger">*</span></label>
                    <input class="form-control" id="client_no" name="client_no" value="" type="text" readonly required>
                    <div class="invalid-feedback">
                        Please enter Client Number.
                    </div>
                    @if($errors->has('client_no'))
                        <div class="invalid-feedback">
                            {{$errors->first('client_no')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    {!! Form::label('type_of_company','Type of Company:'); !!} &nbsp;&nbsp;
                    <label>
                        {!! Form::radio('type_of_company', 'company', true) !!}
                        Company
                    </label>&nbsp;&nbsp;
                    <label>
                        {!! Form::radio('type_of_company', 'individual') !!}
                        Individual
                    </label>
                </div>

                <div class="form-group">
                    <label>Company Name <span class="text-danger">*</span></label>
                    <input class="form-control" id="company_name" name="company_name" type="text" required>
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
                    <label>Company Address </label>
                    <input class="form-control" id="company_address" name="company_address" type="text">
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
                            <label class="col-form-label">Country </label>
                            <select class="custom-select updatecountry" name="country" id="editcountry">
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
                            <label class="col-form-label">State</label>
                            <select class="custom-select" name="state" id="editstate">
                                <option value disabled selected> Select State</option>

                            </select>
                            <div class="invalid-feedback">
                                Please select a state.
                            </div>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{$errors->first('state')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Contact Number </label>
                            <input class="form-control" id="company_contact_num" name="company_contact_num" type="number" >
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

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Fax Number</label>
                            <input class="form-control" id="fax_num" name="fax_num" type="number" >
                            <div class="invalid-feedback">
                                Please enter Company Fax Number.
                            </div>
                            @if($errors->has('fax_num'))
                                <div class="invalid-feedback">
                                    {{$errors->first('fax_num')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Company Email <span class="text-danger">*</span></label>
                            <input class="form-control" id="company_email" name="company_email" type="email" required>
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
                            <label>Website </label>
                            <input class="form-control" id="website" name="website" type="text" >
                            <div class="invalid-feedback">
                                Please enter Company Website.
                            </div>
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{$errors->first('website')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Postal Address </label>
                            <input class="form-control" id="postal_address" name="postal_address" type="text" >
                            <div class="invalid-feedback">
                                Please enter Postal Address.
                            </div>
                            @if($errors->has('postal_address'))
                                <div class="invalid-feedback">
                                    {{$errors->first('postal_address')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="status" id="status" required>
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
                    </div>
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Personal Information</h4>
                </div>
                <div class="form-group">
                    <label>Full Name </label>
                    <input class="form-control" id="fullname" name="fullname" type="text" >
                    <div class="invalid-feedback">
                        Please enter Full Name.
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
                            <label>Designation </label>
                            <input class="form-control" id="designation" name="designation" type="text" >
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
                            <label>Personal Email </label>
                            <input class="form-control" id="personal_email" name="personal_email" type="email" >
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
                            <label>Personal Mobile Num </label>
                            <input class="form-control" id="personal_mobile" name="personal_mobile" type="number" >
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
                            <input class="form-control" id="personal_contact_num" name="personal_contact_num" type="number" >
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
