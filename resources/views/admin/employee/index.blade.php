@extends('layouts.user_management_master')
@section('title') Employee @endsection
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
        .personal-info li .title{
            width:30%;
        }

        .profile-img-wrap{
            position: unset;
        }
        .profile-view .profile-img {
            margin-bottom: 20px;
        }

        .profile-view .profile-img-wrap {
                display: contents;
            }

            .staff-msg {
                    margin-top: 20px;
                    margin-bottom: 20px;
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
                        <h3 class="page-title">Employee Management</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                            <li class="breadcrumb-item active">Employee Management</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('employee.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add Employee</a>
                        <a href="{{route('employee.trash')}}" class="btn add-btn margin-right"><i class="fa fa-eye"></i> Trash </a>
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
                                <table class="table table-striped custom-table" id="employee-management">
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
                                    @foreach(@$employees as $employee)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar">
                                                        <img alt="{{$employee->user->name}}" src="<?php if(!empty($employee->user->image)){ echo '/images/user/'.$employee->user->image; } else { if($employee->user->gender=="male") {echo '/images/profiles/male.png'; } elseif($employee->user->gender=="female") {echo '/images/profiles/female.png'; } elseif($employee->user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                                    </a>
                                                    <a href="#">{{ucfirst($employee->user->name)}}
                                                        <span>
                                                            @foreach($employee->user->roles as $roles)
                                                                {{ucfirst(\App\Models\Role::find($roles->id)->name)}}
                                                            @endforeach
                                                        </span></a>
                                                </h2>
                                            </td>
                                            <td>{{$employee->user->email}}</td>
                                            <td>{{$employee->user->contact}}</td>
                                            <td>{{\Carbon\Carbon::parse($employee->user->created_at)->isoFormat('MMMM Do, YYYY')}}</td>
                                            <td>
                                                <div class="dropdown">

                                                    <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        {{(($employee->user->status == 0) ? "De-active":"Active")}}
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        @if($employee->user->status == 0)
                                                            <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$employee->user->id)}}" href="#" id="1">Active</a>
                                                        @else
                                                            <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$employee->user->id)}}" href="#" id="0">De-active</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-view" href="#" hrm-view-action="{{route('employee.show',$employee->id)}}" data-toggle="modal" data-target="#view_employee"><i class="fa fa-eye m-r-5"></i> View </a>
                                                        <a class="dropdown-item " href="{{route('employee.edit',$employee->id)}}"  ><i class="fa fa-edit m-r-5"></i> Edit </a>
                                                        <a class="dropdown-item action-delete"  href="#" hrm-delete-action="{{route('employee.destroy',$employee->id)}}" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                        @foreach(@$employees as $employee)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="#" class="avatar">
                                            <img alt="{{$employee->user->name}}" src="<?php if(!empty($employee->user->image)){ echo '/images/user/'.$employee->user->image; } else { if($employee->user->gender=="male") {echo '/images/profiles/male.png'; } elseif($employee->user->gender=="female") {echo '/images/profiles/female.png'; } elseif($employee->user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                        </a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-view" href="#" hrm-view-action="{{route('employee.show',$employee->id)}}" data-toggle="modal" data-target="#view_employee"><i class="fa fa-eye m-r-5"></i> View </a>
                                            <a class="dropdown-item " href="{{route('employee.edit',$employee->id)}}"  ><i class="fa fa-edit m-r-5"></i> Edit </a>
                                            <a class="dropdown-item action-delete"  href="#" hrm-delete-action="{{route('employee.destroy',$employee->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{ucfirst($employee->user->name)}}</a></h4>
                                    <div class="small text-muted">
                                        @foreach($employee->user->roles as $roles)
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


    <!-- /Page Wrapper -->

     <!-- View Employee Modal -->
     @include('admin.modals.employee.show')
        <!-- /View Employee Modal -->


@endsection
@section('js')

    <script type="text/javascript">

        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

           $('#employee-management').DataTable({
                paging: true,
                searching: true,
                oSearch: {"sSearch": ""},
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
                    text: "Setting the employee status to De-active will prevent them from logging in. \n \n Set their status to active to enable the login feature!",
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
                        swal("Success!", "Employee Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update employee status",
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
                        title: 'Employee Management Warning',
                        text: "Error. Could not confirm the status of the employee.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        }


        $(document).on('click','.action-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    // console.log(dataResult.userrole);
                    console.log(dataResult.editemployee);

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
                    $('#user-father').text(dataResult.editemployee.father_name);
                    $('#user-mother').text(dataResult.editemployee.mother_name);
                    $('#user-marital-status').text(dataResult.editemployee.marital_status);
                    $('#user-department').text(dataResult.editemployee.department.name);
                    $('#user-designation').text(dataResult.editemployee.designation.name);
                    $('#user-job-status').text(dataResult.editemployee.job_status);

                    if(dataResult.editemployee.cv !== null){
                        $('#view-cv').html('<a href="{{url('/cv/download/')}}/'+dataResult.editemployee.cv+'"'
                        +'class="btn btn-success btn-xs btn-flat" data-toggle="tooltip" data-original-title="Click to download cv"><i class="icon fa fa-cloud-download"> Download CV</i></a>');


                    }else{
                        $('#view-cv').text('N/A');
                    }

                    if(dataResult.editemployee.citizenship !== null){
                        $('#view-citizenship').html('<a href="{{url('/citizenship/download/')}}/'+dataResult.editemployee.citizenship+'"'
                        +'class="btn btn-success btn-xs btn-flat" data-toggle="tooltip" data-original-title="Click to download citizenship"><i class="icon fa fa-cloud-download"> Download</i></a>');


                    }else{
                        $('#view-citizenship').text('N/A');
                    }

                    $('#user-role').text('Assigned role: ' + dataResult.userrole.name);
                    $('#user-module').text('Assigned Module: ' + dataResult.modulecount);
                    $('#user-permission').text('Permission Assigned: ' + dataResult.permissioncount);
                    $('#user-dateofjoin').text('Date of Join: ' + dataResult.dateofjoin);
                    $('#user-email').attr('href', 'mailto:'+dataResult.edituser.email);
                    $('#user-contact').attr('href', 'tel:'+dataResult.edituser.contact).text(dataResult.edituser.contact);
                    $('#user-mobile').attr('href', 'tel:'+dataResult.editemployee.contact_no).text(dataResult.editemployee.contact_no);
                    $('#user-emergency').attr('href', 'tel:'+dataResult.editemployee.emergency_contact).text(dataResult.editemployee.emergency_contact);
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
                                text: "Failed to move Employee into trash",
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

    </script>
@endsection
