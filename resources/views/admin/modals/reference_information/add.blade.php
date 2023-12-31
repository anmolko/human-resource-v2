<div id="add_reference_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Reference Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'reference-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="profile-img-wrap edit-img">
                    <img class="inline-block" id="current-img" src="{{asset('/images/profiles/others.png')}}" alt="demand-image" >
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" id="image" onchange="loadFile(event)" name="image">
                    </div>
                    <div class="invalid-feedback">
                        Please choose a Reference Information Image.
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Reference Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="name" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Reference Name.
                            </div>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Optional Name </label>
                            <input class="form-control" name="optional_name" type="text" >
                            <div class="invalid-feedback">
                                Please enter Optional Name.
                            </div>
                            @if($errors->has('optional_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('optional_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Branch Office  <span class="text-danger">*</span></label>
                    <select class="custom-select select-height select2" name="branch_office_id" required>
                        <option value disabled selected> Select Branch Office </option>
                                @foreach($branchoffices as $branchoffice)
                                    <option value="{{$branchoffice->id}}">{{ucwords($branchoffice->branch_office_name)}} </option>
                                @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a branch office.
                    </div>
                    @if($errors->has('branch_office_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('branch_office_id')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Company Name <span class="text-danger">(if applicable)</span></label>
                    <input class="form-control" name="company" type="text">
                    <div class="invalid-feedback">
                        Please enter Company Name.
                    </div>
                    @if($errors->has('company'))
                        <div class="invalid-feedback">
                            {{$errors->first('company')}}
                        </div>
                    @endif
                </div>


                <div class="row">
                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Country <span class="text-danger">*</span></label>
                            <select class="custom-select country" name="country" required>
                                <option value disabled selected> Select Country</option>
{{--                                @foreach($countries as $key => $value)--}}
{{--                                    <option value="{{$key}}">{{ucwords($value)}} </option>--}}
{{--                                @endforeach--}}
                            </select>
                            <div class="invalid-feedback">
                                Please select a Country.
                            </div>
{{--                            @if($errors->has('country'))--}}
                                <div class="invalid-feedback">
{{--                                    {{$errors->first('country')}}--}}
                                </div>
{{--                            @endif--}}
                        </div>
                    </div> -->

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" name="country" value="NP" type="hidden" required>

                            <input class="form-control" name="email" type="email" autocomplete="new-email" required>
                            <div class="invalid-feedback">
                                Please enter the Email.
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
                            <label>Address <span class="text-danger">*</span></label>
                            <input class="form-control" name="address" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Address.
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
                            <label>Contact No. </label>
                            <input class="form-control" name="contact_no" type="number" >
                            <div class="invalid-feedback">
                                Please enter contact number.
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
                            <label>Mobile No. </label>
                            <input class="form-control" name="mobile_no" type="number" >
                            <div class="invalid-feedback">
                                Please enter mobile number.
                            </div>
                            @if($errors->has('mobile_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('mobile_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Identification document Image (citizenship or passport):</label>
                            <input type="file" class="form-control" name="identification_image" id="identification_image">
                            <div class="invalid-feedback">
                                Please upload the passport image.
                            </div>
                            @if($errors->has('passport_image'))
                                <div class="invalid-feedback">
                                    {{$errors->first('passport_image')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Assign Role </label>
                            {!! Form::select('role_id',  $roles, null,['class'=>'custom-select select-height mb-3 select2','data-id'=>'create','placeholder'=>'Select role']) !!}
                            <small class="text-primary">Role selected agents can login as a user in the system.</small>

                            <div class="invalid-feedback">
                                Please select a role.
                            </div>
                            @if($errors->has('mobile_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('mobile_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="password-create">Password</label>
                            <input class="form-control password" name="password" type="password" autocomplete="new-password">
                            <div class="invalid-feedback">
                                Please enter the password.
                            </div>
                            @if($errors->has('contact_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('contact_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <input class="form-control" name="status" value="continued" type="hidden" required>

                    <!-- <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status  <span class="text-danger">*</span></label>
                            <select class="custom-select select-height" name="status" required>
                                <option value disabled selected> Select Status </option>
                                <option value="continued"> Continued </option>
                                <option value="discontinued"> Dis-continued </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the status.
                            </div>
{{--                            @if($errors->has('status'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('status')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
                        </div>
                    </div> -->
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="name_of_professional" value="" id="invalidCheck" >
                        <label class="form-check-label" for="invalidCheck">
                            Name of professional organization registered (if any)
                        </label>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                            <label>Name of organization <span class="text-danger">*</span></label>
                            <input class="form-control name_of_organization" name="name_of_organization" type="text" readonly>
                            <div class="invalid-feedback">
                                Please enter name of organization.
                            </div>
                            @if($errors->has('name_of_organization'))
                                <div class="invalid-feedback">
                                    {{$errors->first('name_of_organization')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Membership No. <span class="text-danger">*</span></label>
                            <input class="form-control membership_no" name="membership_no" type="text" readonly>
                            <div class="invalid-feedback">
                                Please enter membership no.
                            </div>
                            @if($errors->has('membership_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('membership_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-reference">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
