<div id="edit_agent" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Company Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateoverseas','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    <label>Company Name <span class="text-danger">*</span></label>
                    <input class="form-control" name="title" id="title" type="text" required>
                    <div class="invalid-feedback">
                        Please enter Company Name.
                    </div>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{$errors->first('title')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Address </label>
                            <input class="form-control" name="address" id="address" type="text">
                            <div class="invalid-feedback">
                                Please enter Company Address.
                            </div>
                            @if($errors->has('company_address'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_address')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Overseas Agent </label>
                            {!! Form::select('overseas_agent_id', $agents, null,['class'=>'form-select mb-3 select2','id'=>'overseas_agent_id','placeholder'=>'Select overseas agent']) !!}

                            <div class="invalid-feedback">
                                Please select a agent.
                            </div>
                            @if($errors->has('overseas_agent_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('overseas_agent_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label">Country </label>
                            <select class="custom-select updatecountry select2" name="country" id="country">
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
                            <label class="col-form-label">State </label>
                            <select class="custom-select select2" name="country_state_id" id="country_state_id">
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
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" name="phone" id="phone" type="text" required>
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
                            <label>Mobile Number </label>
                            <input class="form-control" name="mobile" id="mobile" type="text" >
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
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="email" id="email" type="email" required>
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
                            <label>Company Fax Number </label>
                            <input class="form-control" name="fax_number" id="fax_number" type="number" >
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
                            <label>Website </label>
                            <input class="form-control" name="website" id="website" type="text" >
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="status" id="status"  required>
                                <option value disabled > Select Status</option>
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

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
