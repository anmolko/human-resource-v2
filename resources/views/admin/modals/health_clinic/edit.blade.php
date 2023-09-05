<div id="edit_health_clinic" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Insurance Agent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatehealthclinic','novalidate'=>'']) !!}

                <div class="form-group">
                    <label>Clinic Name <span class="text-danger">*</span></label>
                    <input class="form-control" name="name" id="name" type="text" required>
                    <div class="invalid-feedback">
                        Please enter Clinic Name.
                    </div>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Address <span class="text-danger">*</span></label>
                    <input class="form-control"  name="address" id="address" type="text" required>
                    <div class="invalid-feedback">
                        Please enter Clinic Address.
                    </div>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{$errors->first('address')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label >Country <span class="text-danger">*</span></label>
                            <select class="custom-select select-height updatecountry" name="country" id="country" required>
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
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input class="form-control"  name="contact" id="contact" type="number" required>
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
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="email" id="email" type="email" required>
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
                            <label>Status  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="status" id="status"  required>
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
                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>If registered to any Health Association</h4>
                </div>
                <div class="form-group">
                    <label>Name of Organization </label>
                    <input class="form-control"  name="organization_name" id="organization_name" type="text" >
                    <div class="invalid-feedback">
                        Please enter Organization Name.
                    </div>
                    @if($errors->has('organization_name'))
                        <div class="invalid-feedback">
                            {{$errors->first('organization_name')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Membership Number </label>
                    <input class="form-control"  name="membership_number" id="membership_number" type="text" >
                    <div class="invalid-feedback">
                        Please enter Membership Number.
                    </div>
                    @if($errors->has('membership_number'))
                        <div class="invalid-feedback">
                            {{$errors->first('membership_number')}}
                        </div>
                    @endif
                </div>


                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-clinic">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
