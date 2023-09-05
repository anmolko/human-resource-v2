@extends('layouts.master')
@section('title') User Profile @endsection
@section('css')
    <style>

        /*.pro-overview .personal-info li .title{*/
        /*    width: 40% !important;*/
        /*}*/

        /*.complete-btn{*/
        /*    background: #35BA67;*/
        /*    border: 1px solid #2fa65c;*/
        /*}*/
        .action-circle .material-icons{
            color: #fff;
        }
        .padding-bottom{
            padding-bottom: 5px;
        }
    </style>
@endsection
@section('content')

    @if(session('success'))

        <div class="notification-popup success">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{session('success')}}</span>
            </p>
        </div>
    @endif

    @if(session('error'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{session('error')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('image'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('image')}}</span>
            </p>
        </div>
    @endif
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a data-target="#profile_info" data-toggle="modal" href="#"><img alt="{{$userinfo->name}}" src="<?php if(!empty($userinfo->image)){ echo '/images/user/'.$userinfo->image; } else { if($userinfo->gender=="male") {echo '/images/profiles/male.png'; } elseif($userinfo->gender=="female") {echo '/images/profiles/female.png'; } elseif($userinfo->gender=="others") {echo '/images/profiles/others.png'; } } ?>" /></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ ucfirst($userinfo->name)  }}</h3>
{{--                                                <h6 class="text-muted">Information Technology</h6>--}}
                                                <small class="text-muted"> Assigned roles:
                                                    {{ucfirst($userrole->name)}}
                                                </small>
                                                <div class="staff-id">Module Assigned : {{ $modules_count  }}</div>
                                                <div class="staff-id">Permission Assigned : {{ $permission_count  }}</div>
                                                <div class="small doj text-muted">Date of Join : {{\Carbon\Carbon::parse($userinfo->created_at)->isoFormat('MMMM Do, YYYY')}}</div>
                                                <div class="staff-msg"><a href="mailto:{{$userinfo->email}}" class="btn btn-custom" >Send Mail</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text"><a href="tel:{{$userinfo->contact}}">{{$userinfo->contact}}</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text"><a href="mailto:{{$userinfo->email}}">{{$userinfo->email}}</a></div>
                                                </li>
                                                <li>
                                                    <div class="title">Birthday:</div>
                                                    <div class="text">{{\Carbon\Carbon::parse($userinfo->dob)->isoFormat('MMMM Do, YYYY')}}</div>
                                                </li>

                                                <li>
                                                    <div class="title">Gender:</div>
                                                    <div class="text">{{ucfirst($userinfo->gender)}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Status:</div>
                                                    <div class="text">
                                                        {{($userinfo->status == 1) ? "Active": "De-active"}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Last Active:</div>
                                                    <div class="text">
                                                        {{\Carbon\Carbon::parse($userinfo->last_login_at)->isoFormat('MMMM Do, YYYY, h:mm:ss a')}}</div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
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
                                    <ul class="personal-info">
                                        @foreach($userrole->modules as $module)
                                            <li>
                                                <div class="title">{{$module->name}}</div>
                                                    <div class="text">
                                                        @foreach($module->permissions as $permission)
                                                        <div class="padding-bottom">
                                                        <span class="task-action-btn task-check">
                                                                <span class="action-circle large btn-custom complete-btn" title="">
                                                                    <i class="material-icons">check</i>
                                                                </span>
                                                            </span>
                                                        <span class="task-label">{{ucfirst($permission->name)}}</span><br/>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                            </li>
                                            <hr/>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Profile Info Tab -->
        </div>

        <!-- Add Secondary Group Modal -->
        @include('admin.modals.profile.edit')
        <!-- /Add Secondary Group Modal -->
@endsection
@section('js')
                <script>
                    var loadFile = function(event) {
                        var image = document.getElementById('image');
                        var replacement = document.getElementById('current-img');
                        replacement.src = URL.createObjectURL(event.target.files[0]);
                    };

                    <?php if(@$theme_data->default_date_format=='nepali'){ ?>

                    $('#datetimepicker').nepaliDatePicker({
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 10,
                        dateFormat :'YYYY-MM-DD',
                        language: "english",
                    });

                    <?php }else if(@$theme_data->default_date_format=='english'){ ?>


                    $('#datetimepicker').datetimepicker({
                        format: 'YYYY-MM-DD'

                    })

                    <?php }else{?>
                    $('#datetimepicker').datetimepicker({
                        format: 'YYYY-MM-DD'
                    })

                    <?php }?>

                </script>

@endsection
