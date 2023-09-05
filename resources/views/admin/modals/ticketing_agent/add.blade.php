<div id="add_ticketing_agent" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ticketing Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'ticketing-agent.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Agent ID <span class="text-danger">*</span></label>
                            <input class="form-control" name="agent_id" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Agent ID.
                            </div>
                            @if($errors->has('agent_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('agent_id')}}
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
                            <label>Address </label>
                            <input class="form-control"  name="address" type="text">
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
                            <label>Contact Number</label>
                            <input class="form-control"  name="contact" type="number">
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

                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email </label>
                            <input class="form-control" name="email" type="email">
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fax Number </label>
                            <input class="form-control"  name="fax_no" type="number" >
                            <div class="invalid-feedback">
                                Please enter Fax Number.
                            </div>
                            @if($errors->has('fax_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('fax_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Postal Address </label>
                            <input class="form-control" name="postal_address" type="text" >
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
                            <label>Website </label>
                            <input class="form-control" name="website" type="text">
                            <input class="form-control" name="status" type="hidden" value="continued">
                            <div class="invalid-feedback">
                                Please enter website link.
                            </div>
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{$errors->first('website')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Choose Airlines Managed by Agent/Company</h4>
                </div>

                <div class="row mb-4">
                    @foreach($airlines as $airline)
                        <div class="col-md-3 col-6 text-center ">
                            <label class="select-label">
                                <input type="checkbox" value="{{$airline->id}}" name="airline_detail_id[]">
                                <span>{{$airline->reference_no}}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div>
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Contact Personal Details</h4>
                </div>


                <div class="form-group">
                    <label>Fullname</label>
                    <input class="form-control" name="fullname" type="text" >
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
                            <label>Designation</label>
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
                            <label>Personal Contact</label>
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
                            <label>Personal Mobile</label>
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
                            <label>Personal Email</label>
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
