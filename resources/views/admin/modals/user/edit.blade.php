<!-- Profile Modal -->
<div id="edit_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title capital">Update User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','enctype'=>'multipart/form-data','class'=>'needs-validation updateuser','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-img-wrap edit-img">
                            <img class="inline-block" id="currentedit-img" src="{{asset('/images/profiles/others.png')}}" alt="user-profile" >
                            <div class="fileupload btn">
                                <span class="btn-text">edit</span>
                                <input class="upload" type="file" id="image-edit" onchange="loadEdit(event)" name="image">
                            </div>
                            <div class="invalid-feedback">
                                Please choose a Profile picture.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Please enter your name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                    <input type="hidden" name="user-mgm" value="user-mgm">
                                    <div class="invalid-feedback">
                                        Please enter your email.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <div class="cal-icon">
                                        <input class="form-control dob" id="datetimepicker-edit" name="dob" type="text" required>
                                        <div class="invalid-feedback">
                                            Please enter your Date of Birth.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="select form-control" id="gender" name="gender" required>
                                        <option value="male"> Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select your gender.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" id="address" required>
                            <div class="invalid-feedback">
                                Please enter a your address.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" name="contact" id="contact" required>
                            <div class="invalid-feedback">
                                Please enter a your phone number.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select form-control" name="role_id" id="role_id" required>
                                @foreach($all_roles as $role)
                                    <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select one role for the user.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <div class="invalid-feedback">
                                Please enter a password for the user.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update_users_btn">Update User</button>
                </div>
                {!! Form::close() !!}


            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
