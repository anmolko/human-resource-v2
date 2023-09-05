@extends('layouts.user_management_master')
@section('title') Employee Management Trash @endsection
@section('css')
    <style>
        .avatar > img {
            height: 100%;
        }
        td.details-controls {
            text-align:center;
            cursor: pointer;
        }
        tr.shown td.details-controls {
            text-align:center;
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

        <!-- Employee Management Trash Table -->
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">User Management</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="{{route('employee.index')}}">Employee Management</a></li>
                            <li class="breadcrumb-item active">Trash</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('employee.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add Employee</a>
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
                                <table class="table table-striped custom-table " id="employee-management">
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
                                    @foreach(@$trashed as $employee)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar">
                                                        <img alt="{{$employee->userTrash->name}}" src="<?php if(!empty($employee->userTrash->image)){ echo '/images/user/'.$employee->userTrash->image; } else { if($employee->userTrash->gender=="male") {echo '/images/profiles/male.png'; } elseif($employee->userTrash->gender=="female") {echo '/images/profiles/female.png'; } elseif($employee->userTrash->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                                    </a>
                                                    <a href="#">{{ucfirst($employee->userTrash->name)}}
                                                        <span>
                                                            @foreach($employee->userTrash->roles as $roles)
                                                                {{ucfirst(\App\Models\Role::find($roles->id)->name)}}
                                                            @endforeach
                                            </span></a>
                                                </h2>
                                            </td>
                                            <td>{{$employee->userTrash->email}}</td>
                                            <td>{{$employee->userTrash->contact}}</td>
                                            <td>{{\Carbon\Carbon::parse($employee->userTrash->created_at)->isoFormat('MMMM Do, YYYY')}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="" class="btn btn-white btn-sm btn-rounded" aria-expanded="false">
                                                        {{(($employee->userTrash->status == 0) ? "De-active":"Active")}}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-restore" href="#"  hrm-restore-action="{{route('employee.restore',$employee->id)}}" data-toggle="modal" data-target="#restore_employee"><i class="fa fa-refresh m-r-5"></i> Restore</a>
                                                        <a class="dropdown-item action-per-delete" href="#"  hrm-delete-per-action="{{route('employee.remove',$employee->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete </a>
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
                        @foreach(@$trashed as $employee)
                            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                                <div class="profile-widget">
                                    <div class="profile-img">
                                        <a href="#" class="avatar">
                                            <img alt="{{$employee->userTrash->name}}" src="<?php if(!empty($employee->userTrash->image)){ echo '/images/user/'.$employee->userTrash->image; } else { if($employee->userTrash->gender=="male") {echo '/images/profiles/male.png'; } elseif($employee->userTrash->gender=="female") {echo '/images/profiles/female.png'; } elseif($employee->userTrash->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                        </a>
                                    </div>
                                    <div class="dropdown profile-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-restore" href="#"  hrm-restore-action="{{route('employee.restore',$employee->id)}}" data-toggle="modal" data-target="#restore_employee"><i class="fa fa-refresh m-r-5"></i> Restore</a>
                                            <a class="dropdown-item action-per-delete" href="#"  hrm-delete-per-action="{{route('employee.remove',$employee->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                                        </div>
                                    </div>
                                    <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{ucfirst($employee->userTrash->name)}}</a></h4>
                                    <div class="small text-muted">
                                        @foreach($employee->userTrash->roles as $roles)
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
        <!-- /Employee Management Table -->

    <!-- /Page Content -->


    <!-- Restore Employee Management Modal -->
    @include('admin.modals.employee.restore')
    <!-- /Restore Employee Management Modal -->

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


        $(document).on('click','.action-per-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-per-action');
            form.attr('action',$(this).attr('hrm-delete-per-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            swal({
                title: "Are You Sure?",
                text: "You will not be able to recover this",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        console.log(response);
                        if(response == 0){
                            swal({
                                title: "Error!",
                                text: "Failed to delete Employee from trash",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                            }, function(){
                                //window.location.href = ""
                                swal.close();
                            })

                        }else{

                            swal("Deleted!", "Employee Deleted Successfully", "success");
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

        $(document).on('click','.action-restore', function (e) {
            e.preventDefault();
            var action = $(this).attr('hrm-restore-action');
            $('.restore-link').attr('href',action);
        })
    </script>
@endsection
