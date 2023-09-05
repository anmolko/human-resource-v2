<!-- /Page Content -->
{!! Form::open(['method'=>'put','route'=>['user.update', $userinfo->id],'enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate'=>'']) !!}
 <!-- Profile Modal -->
    <div id="profile_info" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profile Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-img-wrap edit-img">
                                <img class="inline-block" id="current-img" src="<?php if(!empty($userinfo->image)){ echo '/images/user/'.$userinfo->image; } else { if($userinfo->gender=="male") {echo '/images/profiles/male.png'; } elseif($userinfo->gender=="female") {echo '/images/profiles/female.png'; } elseif($userinfo->gender=="others") {echo '/images/profiles/others.png'; } } ?>" alt="{{$userinfo->name}}" >
                                <div class="fileupload btn">
                                    <span class="btn-text">edit</span>
                                    <input class="upload" type="file" id="image" onchange="loadFile(event)" name="image">
                                </div>
                                <div class="invalid-feedback">
                                    Please choose a Profile picture.
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$userinfo->name}}" required>
                                        <div class="invalid-feedback">
                                            Please enter your name.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{$userinfo->email}}" readonly required>
                                        <div class="invalid-feedback">
                                            Please enter your email.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control" id="datetimepicker" name="dob" type="text" value="{{ $userinfo->dob }}" required>
                                            <div class="invalid-feedback">
                                                Please enter your Date of Birth.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="select form-control" name="gender" required>
                                            <option value="male" {{ ($userinfo->gender == "male") ? "selected":"" }}> Male</option>
                                            <option value="female" {{ ($userinfo->gender == "female") ? "selected":"" }}>
                                               Female</option>
                                            <option value="others" {{ ($userinfo->gender == "others") ? "selected":"" }}>Others</option>
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
                                <input type="text" class="form-control" value="{{$userinfo->address}}" name="address" required>
                                <div class="invalid-feedback">
                                    Please enter a your address.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" class="form-control" value="{{$userinfo->contact}}" name="contact" required>
                                <div class="invalid-feedback">
                                    Please enter a your phone number.
                                </div>
                            </div>
                        </div>
                </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
            </div>
        </div>
    </div>
    <!-- /Profile Modal -->
</form>
