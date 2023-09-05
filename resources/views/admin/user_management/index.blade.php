@extends('layouts.user_management_master')
@section('title') User Management @endsection
@section('css')
    <style>
        .personal-profile{
            width: 50px;
            height: 50px;
        }
        .avatar > img {
            height: 100%;
        }

        #select2-gender-container{
            text-transform: capitalize;
        }

        #select2-role_id-container{
            text-transform: capitalize;
        }
        .capital{
            text-transform: capitalize;
        }

        .margin-right{
            margin-right: 5px;
        }
        .title {
            text-transform: capitalize;
        }
        span.task-label {
            text-transform: capitalize;
        }
        i.white{
            color: #fff!important;
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

        <!-- Page Content -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">User Management</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                            <li class="breadcrumb-item active">User Management</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i> Add User</a>
                        <a href="{{route('user.trash')}}" class="btn add-btn margin-right"><i class="fa fa-eye"></i> Trash </a>
                        <div class="view-icons">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item">
                                    <a href="#my-grid" data-toggle="tab"  class="grid-view nav-link btn btn-link"><i class="fa fa-th"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="#my-list" data-toggle="tab"  class="nav-link list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                                </li>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
{{--            <div class="row filter-row">--}}
{{--                <div class="col-sm-6 col-md-3">--}}
{{--                    <div class="form-group form-focus">--}}
{{--                        <input type="text" class="form-control floating">--}}
{{--                        <label class="focus-label">Employee ID</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6 col-md-3">--}}
{{--                    <div class="form-group form-focus">--}}
{{--                        <input type="text" class="form-control floating">--}}
{{--                        <label class="focus-label">Employee Name</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6 col-md-3">--}}
{{--                    <div class="form-group form-focus select-focus">--}}
{{--                        <select class="select floating">--}}
{{--                            <option>Select Designation</option>--}}
{{--                            <option>Web Developer</option>--}}
{{--                            <option>Web Designer</option>--}}
{{--                            <option>Android Developer</option>--}}
{{--                            <option>Ios Developer</option>--}}
{{--                        </select>--}}
{{--                        <label class="focus-label">Designation</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-sm-6 col-md-3">--}}
{{--                    <a href="#" class="btn btn-success btn-block"> Search </a>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!-- /Search Filter -->

            <div class="tab-content profile-tab-content">
                <!-- Projects Tab -->
                <div id="my-list" class="tab-pane fade show active">
                    <div class="row" id="employee-list">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <form action="#" method="post" id="deleted-form" >
                                    {{csrf_field()}}
                                    <input name="_method" type="hidden" value="delete">

                                </form>
                                <table class="table table-striped custom-table" id="user-management">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th class="text-nowrap">Join Date</th>
                                        <th>Status</th>
                                        <th class="text-right no-sort">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(@$all_user as $user)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar">
                                                        <img alt="{{$user->name}}" src="<?php if(!empty($user->image)){ echo '/images/user/'.$user->image; } else { if($user->gender=="male") {echo '/images/profiles/male.png'; } elseif($user->gender=="female") {echo '/images/profiles/female.png'; } elseif($user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                                    </a>
                                                    <a href="#">{{ucfirst($user->name)}}
                                                        <span>
                                                            @foreach($user->roles as $roles)
                                                                {{ucfirst(\App\Models\Role::find($roles->id)->name)}}
                                                            @endforeach
                                                        </span></a>
                                                </h2>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->contact}}</td>
                                            <td>{{\Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM Do, YYYY')}}</td>
                                            <td>
                                                <div class="dropdown">

                                                    <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        {{(($user->status == 0) ? "De-active":"Active")}}
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        @if($user->status == 0)
                                                            <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$user->id)}}" href="#" id="1">Active</a>
                                                        @else
                                                            <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$user->id)}}" href="#" id="0">De-active</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-view" href="#" hrm-view-action="{{route('user.show',$user->id)}}" data-toggle="modal" data-target="#view_user"><i class="fa fa-eye m-r-5"></i> View </a>
                                                        <a class="dropdown-item action-edits" href="#" hrm-update-action="{{route('user.update',$user->id)}}"  hrm-edit-action="{{route('user.edit',$user->id)}}" data-toggle="modal" data-target="#edit_user"><i class="fa fa-edit m-r-5"></i> Edit </a>
                                                        <a class="dropdown-item action-delete"  href="#" hrm-delete-action="{{route('user.destroy',$user->id)}}" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Projects Tab -->

                <!-- Task Tab -->
                <div id="my-grid" class="tab-pane fade">
                    <div class="row staff-grid-row" id="employee-grid">
                        @foreach(@$all_user as $user)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="#" class="avatar">
                                            <img alt="{{$user->name}}" src="<?php if(!empty($user->image)){ echo '/images/user/'.$user->image; } else { if($user->gender=="male") {echo '/images/profiles/male.png'; } elseif($user->gender=="female") {echo '/images/profiles/female.png'; } elseif($user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                        </a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-view" href="#" hrm-view-action="{{route('user.show',$user->id)}}" data-toggle="modal" data-target="#view_user"><i class="fa fa-eye m-r-5"></i> View </a>
                                            <a class="dropdown-item action-edits"  href="#" hrm-update-action="{{route('user.update',$user->id)}}"  hrm-edit-action="{{route('user.edit',$user->id)}}" data-toggle="modal" data-target="#edit_user"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('user.destroy',$user->id)}}" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{ucfirst($user->name)}}</a></h4>
                                    <div class="small text-muted">
                                        @foreach($user->roles as $roles)
                                            {{ucfirst(\App\Models\Role::find($roles->id)->name)}}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- /Task Tab -->

            </div>
        </div>
        <!-- /Page Content -->

        <!-- Add User Modal -->
        @include('admin.modals.user.create')
       <!-- /Add User Modal -->

        <!-- Edit User Modal -->
        @include('admin.modals.user.edit')
        <!-- /Edit User Modal -->

        <!-- View User Modal -->
        @include('admin.modals.user.show')
        <!-- /View User Modal -->



    <!-- /Page Wrapper -->


@endsection
@section('js')

    <script type="text/javascript">
        var loadFile = function(event) {
            var image = document.getElementById('image');
            var replacement = document.getElementById('current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadEdit = function(event) {
            var image = document.getElementById('image-edit');
            var replacement = document.getElementById('currentedit-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

           $('#user-management').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
            <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('#datetimepicker-edit').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }else if(@$theme_data->default_date_format=='english'){ ?>


            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'

            });

            <?php }else{?>
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            <?php }?>

        });

        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == 0){
                swal({
                    title: "Are You Sure?",
                    text: "Setting the user status to De-active will prevent them from logging in. \n \n Set their status to active to enable the login feature!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    statusupdate(url,status);
                });
            }else{
                statusupdate(url,status);
            }

        });

        $(document).on('click','.action-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be moved to trash",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 0){
                            swal({
                                title: "Error!",
                                text: "Failed to move User into trash",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                            }, function(){
                                //window.location.href = ""
                                swal.close();
                            })
                        }else{
                            swal("Trashed!", "Moved to Trash Successfully", "success");
                            // toastr.success('file deleted Successfully');
                            $(response).remove();
                            window.location.reload();
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            })

        })

        $(document).on('click','.action-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult.userrole);

                    if(dataResult.edituser.image == null && dataResult.edituser.gender === "male"){
                        src = '/images/profiles/male.png';
                    }else if(dataResult.edituser.image == null && dataResult.edituser.gender === "female"){
                        src = '/images/profiles/female.png';
                    }else if(dataResult.edituser.image == null && dataResult.edituser.gender === "others"){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/user/'+dataResult.edituser.image;
                    }
                    $('#user-image').attr('src',src);
                    $('#user-name').text(dataResult.edituser.name);
                    $('#user-role').text('Assigned role: ' + dataResult.userrole.name);
                    $('#user-module').text('Assigned Module: ' + dataResult.modulecount);
                    $('#user-permission').text('Permission Assigned: ' + dataResult.permissioncount);
                    $('#user-dateofjoin').text('Date of Join: ' + dataResult.dateofjoin);
                    $('#user-email').attr('href', 'mailto:'+dataResult.edituser.email);
                    $('#user-contact').attr('href', 'tel:'+dataResult.edituser.contact).text(dataResult.edituser.contact);
                    $('#email-display').text(dataResult.edituser.email).attr('href', 'mailto:'+dataResult.edituser.email);
                    $('#user-dob').text(dataResult.dob);
                    $('#user-gender').text(dataResult.edituser.gender);
                    $('#user-last-active').text(dataResult.last_login);
                    $('#user-status').text((dataResult.edituser.status == 0) ? "De-Active":"Active");
                    var modules_permissions='';
                    $.each(dataResult.userrole.modules, function (index, single_m) {
                             modules_permissions +='<li><div class="title">'+single_m.name+'</div><div class="text">'
                                $.each(single_m.permissions, function (index, single_p) {
                                    modules_permissions += '<div class="padding-bottom">'
                                        +'<span class="task-action-btn task-check">'
                                        + '<span class="action-circle large btn-custom complete-btn" title="">'
                                        +'<i class="material-icons white">check</i>'
                                        +'</span>'
                                        +'</span>'
                                        +'<span class="task-label">'+' '+single_p.name+'</span><br/>'
                                    +'</div>';
                                });

                                modules_permissions += '</div></li><hr/>';

                    });
                    $('#roles-permission').html(modules_permissions);



                }
            });
        });

        $(document).on('click','.action-edits', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            // console.log(action)
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    // console.log(dataResult);
                    var src;
                    var role_id;
                    var role_name;

                    $.each(dataResult.roles, function (index, c) {
                       role_name = c.name;
                       role_id = c.id;
                    });
                    if(dataResult.image == null && dataResult.gender === "male"){
                        src = '/images/profiles/male.png';
                    }else if(dataResult.image == null && dataResult.gender === "female"){
                        src = '/images/profiles/female.png';
                    }else if(dataResult.image == null && dataResult.gender === "others"){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/user/'+dataResult.image;
                    }
                    $('#name').attr('value',dataResult.name);
                    $('.modal-title').text("Update "+dataResult.name+"'s Information");
                    $('#email').attr('value',dataResult.email);
                    $('.dob').attr('value',dataResult.dob);
                    $('#gender option[value="'+dataResult.gender+'"]').prop('selected', true);
                    $('#select2-gender-container').text(dataResult.gender);
                    $('#address').attr('value',dataResult.address);
                    $('#contact').attr('value',dataResult.contact);
                    $('#role_id option[value="'+role_id+'"]').prop('selected', true);
                    $('#select2-role_id-container').text(role_name);
                    $('#currentedit-img').attr('src',src);
                    $('#password').attr('placeholder',"Type here when you want to change password");
                    $('.updateuser').attr('action',action);
                }
            });
        });

        function statusupdate(url,status){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "PATCH",
                cache: false,
                data:{
                    status: status,
                },
                success: function(dataResult){
                    if(dataResult == "yes"){
                        swal("Success!", "User Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update User status",
                            type: "error",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        }, function(){
                            //window.location.href = ""
                            swal.close();
                        })
                    }
                },
                error: function() {
                    swal({
                        title: 'User Management Warning',
                        text: "Error. Could not confirm the status of the user.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        }

    </script>
@endsection
