<!-- Profile Modal -->
<div id="view_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-view">
                                    <div class="profile-img-wrap">
                                        <div class="profile-img">
                                            <a href="#"><img alt="/images/profiles/others.png" id="user-image" /></a>
                                        </div>
                                    </div>
                                    <div class="profile-basic">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="profile-info-left">
                                                    <h3 class="user-name m-t-0 mb-0 capital" id="user-name">one</h3>
                                                    <small class="text-muted capital" id="user-role"> Assigned roles:
                                                        two
                                                    </small>
                                                    <div class="staff-id capital" id="user-module">Module Assigned : three</div>
                                                    <div class="staff-id capital" id="user-permission">Permission Assigned : four</div>
                                                    <div class="small doj text-muted capital" id="user-dateofjoin">Date of Join : Five</div>
                                                    <div class="staff-msg"><a href="mailto:" class="btn capital btn-custom" id="user-email" >Send Mail</a></div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <ul class="personal-info">
                                                    <li>
                                                        <div class="title">Phone:</div>
                                                        <div class="text"><a href="tel:seven" id="user-contact">seven</a></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Email:</div>
                                                        <div class="text"><a href="mailto:eight" id="email-display">eight</a></div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Birthday:</div>
                                                        <div class="text" id="user-dob">Nine</div>
                                                    </li>

                                                    <li>
                                                        <div class="title">Gender:</div>
                                                        <div class="text capital" id="user-gender">Ten</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Status:</div>
                                                        <div class="text capital" id="user-status">
                                                            eleven</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">Last Active:</div>
                                                        <div class="text" id="user-last-active">
                                                            twelve</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card tab-box">
                    <div class="row user-tabs">
                        <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item"><a href="#modules_permission" data-toggle="tab" class="nav-link active">Modules & Permission</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="tab-content">

                    <!-- Profile Info Tab -->
                    <div id="modules_permission" class="pro-overview tab-pane fade show active">
                        <div class="row">
                            <div class="col-md-12 d-flex">
                                <div class="card profile-box flex-fill">
                                    <div class="card-body">
                                        <h3 class="card-title">Assigned Modules & Permissions Info</a></h3>
                                        <ul class="personal-info" id="roles-permission">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Profile Info Tab -->
                </div>


            </div>
        </div>
    </div>
</div>
<!-- /Profile Modal -->
