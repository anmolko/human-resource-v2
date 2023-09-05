@extends('layouts.user_management_master')
@section('title') Payroll Items Trash @endsection
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
                            <h3 class="page-title">Payroll Items</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee-payroll.index')}}">Employee Payroll</a></li>
                                <li class="breadcrumb-item"><a href="{{route('employee-payroll.addalldetails',@$payroll_info->id)}}">Payroll Items</a></li>
                                <li class="breadcrumb-item active">Payroll Items Trash</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <form action="#" method="post" id="deleted-form" >
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">

                </form>

                <!-- Page Tab -->
                <div class="page-menu">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tab_increments">Increments Trash</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_bonus">Bonus Trash</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_deductions">Deductions Trash</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Tab -->

                <!-- Tab Content -->
                <div class="tab-content">
					
                    <!-- Increment Tab -->
                    <div class="tab-pane show active" id="tab_increments">
                    
                      
                        <!-- Payroll Increment Table -->
                        <div class="payroll-table">
                            <div class="table-responsive">
                                <table class="table table-hover table-radius" id="increment-index">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Increment Month</th>
                                            <th>Amount</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($trashedIncrements as $increment)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar">
                                                        <img alt="{{@$increment->payroll->employee->user->name}}" src="<?php if(!empty($increment->payroll->employee->user->image)){ echo '/images/user/'.$increment->payroll->employee->user->image; } else { if($increment->payroll->employee->user->gender=="male") {echo '/images/profiles/male.png'; } elseif($increment->payroll->employee->user->gender=="female") {echo '/images/profiles/female.png'; } elseif($increment->payroll->employee->user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                                    </a>
                                                    <a href="#">{{ucwords($increment->payroll->employee->user->name)}}
                                                        <span>
                                                        {{ucwords($increment->payroll->employee->designation->name)}}
                                                        </span></a>
                                                </h2>
                                            </td>
                                            <td>{{ date("F Y", strtotime($increment->month)) }}</td>
                                            <td>{{number_format($increment->amount)}}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-increment-restore" href="#"  hrm-restore-action="{{route('increment.restore',$increment->id)}}" data-toggle="modal" data-target="#restore_increment"><i class="fa fa-refresh m-r-5"></i> Restore</a>
                                                        <a class="dropdown-item action-increment-per-delete" href="#"  hrm-delete-per-action="{{route('increment.remove',$increment->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /Payroll Increment Table -->
                        
                    </div>
                    <!-- Additions Tab -->
                    
                    <!-- Bonus Tab -->
                    <div class="tab-pane" id="tab_bonus">
                    
                      
                        <!-- Payroll Bonus Table -->
                        <div class="payroll-table ">
                            <div class="table-responsive">
                                <table class="table table-hover table-radius" id="bonus-index">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Bonus Name</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($trashedBonuses as $bonus)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar">
                                                        <img alt="{{@$bonus->payroll->employee->user->name}}" src="<?php if(!empty($bonus->payroll->employee->user->image)){ echo '/images/user/'.$bonus->payroll->employee->user->image; } else { if($bonus->payroll->employee->user->gender=="male") {echo '/images/profiles/male.png'; } elseif($bonus->payroll->employee->user->gender=="female") {echo '/images/profiles/female.png'; } elseif($bonus->payroll->employee->user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                                    </a>
                                                    <a href="#">{{ucwords($bonus->payroll->employee->user->name)}}
                                                        <span>
                                                        {{ucwords($bonus->payroll->employee->designation->name)}}
                                                        </span></a>
                                                </h2>
                                            </td>
                                            <td>{{ucwords($bonus->name)}}</td>
                                            <td>{{ date("F Y", strtotime($bonus->month)) }}</td>
                                            <td>{{number_format($bonus->amount)}}</td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-bonus-restore" href="#"  hrm-restore-action="{{route('bonus.restore',$bonus->id)}}" data-toggle="modal" data-target="#restore_bonus"><i class="fa fa-refresh m-r-5"></i> Restore</a>
                                                        <a class="dropdown-item action-bonus-per-delete" href="#"  hrm-delete-per-action="{{route('bonus.remove',$bonus->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /Payroll Bonus Table -->
                        
                    </div>
                    <!-- /Bonus Tab -->
                    
                    <!-- Deductions Tab -->
                    <div class="tab-pane" id="tab_deductions">
                    
                        <!-- Payroll Deduction Table -->
                        <div class="payroll-table">
                            <div class="table-responsive">
                            
                                <table class="table table-hover table-radius"  id="deduction-index">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Deduction Name</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($i=1)
                                    @foreach($trashedDeductions as $deduction)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar">
                                                        <img alt="{{@$deduction->payroll->employee->user->name}}" src="<?php if(!empty($deduction->payroll->employee->user->image)){ echo '/images/user/'.$deduction->payroll->employee->user->image; } else { if($deduction->payroll->employee->user->gender=="male") {echo '/images/profiles/male.png'; } elseif($deduction->payroll->employee->user->gender=="female") {echo '/images/profiles/female.png'; } elseif($deduction->payroll->employee->user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                                    </a>
                                                    <a href="#">{{ucwords($deduction->payroll->employee->user->name)}}
                                                        <span>
                                                        {{ucwords($deduction->payroll->employee->designation->name)}}
                                                        </span></a>
                                                </h2>
                                            </td>
                                            <td>{{ucwords($deduction->deduction_name)}}</td>
                                            <td>{{ date("F Y", strtotime($deduction->deduction_month)) }}</td>
                                            <td>{{number_format($deduction->deduction_amount)}}</td>
                                           
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-deduction-restore" href="#"  hrm-restore-action="{{route('deduction.restore',$deduction->id)}}" data-toggle="modal" data-target="#restore_deduction"><i class="fa fa-refresh m-r-5"></i> Restore</a>
                                                        <a class="dropdown-item action-deduction-per-delete" href="#"  hrm-delete-per-action="{{route('deduction.remove',$deduction->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /Payroll Deduction Table -->
                        
                    </div>
                    <!-- /Deductions Tab -->
                    
                </div>
                <!-- Tab Content -->


        </div>
            <!-- /Page Content -->

            <!-- Restore Increment Modal -->
            @include('admin.modals.payroll.increment.restore')
            <!-- /Restore Increment  Modal -->

             <!-- Restore Deduction Modal -->
             @include('admin.modals.payroll.deduction.restore')
            <!-- /Restore Deduction  Modal -->

            <!-- Restore Bonus Modal -->
            @include('admin.modals.payroll.bonus.restore')
            <!-- /Restore Bonus  Modal -->

@endsection

@section('js')

<script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#deduction-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            $('#bonus-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });


            $('#increment-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

        });

        $(document).on('click','.action-bonus-per-delete', function (e) {
        e.preventDefault();
        var form = $('#deleted-form');
        var action = $(this).attr('hrm-delete-per-action');
        form.attr('action',$(this).attr('hrm-delete-per-action'));
        $url = form.attr('action');
        var form_data = form.serialize();
        // $('.deleterole').attr('action',action);
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
                if(response == 0){
                swal({
                    title: "Warning.",
                    text: "You need to Remove Assigned  Entry",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    //window.location.href = ""
                    swal.close();
                })

                }else{

                swal("Deleted!", "Deleted Successfully", "success");
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

    $(document).on('click','.action-bonus-restore', function (e) {
    e.preventDefault();
        var action = $(this).attr('hrm-restore-action');
        $('.restore-link').attr('href',action);
    })


    $(document).on('click','.action-increment-restore', function (e) {
    e.preventDefault();
        var action = $(this).attr('hrm-restore-action');
        $('.restore-link').attr('href',action);
    })

    $(document).on('click','.action-increment-per-delete', function (e) {
        e.preventDefault();
        var form = $('#deleted-form');
        var action = $(this).attr('hrm-delete-per-action');
        form.attr('action',$(this).attr('hrm-delete-per-action'));
        $url = form.attr('action');
        var form_data = form.serialize();
        // $('.deleterole').attr('action',action);
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
                if(response == 0){
                swal({
                    title: "Warning.",
                    text: "You need to Remove Assigned  Entry",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    //window.location.href = ""
                    swal.close();
                })

                }else{

                swal("Deleted!", "Deleted Successfully", "success");
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


    $(document).on('click','.action-deduction-per-delete', function (e) {
        e.preventDefault();
        var form = $('#deleted-form');
        var action = $(this).attr('hrm-delete-per-action');
        form.attr('action',$(this).attr('hrm-delete-per-action'));
        $url = form.attr('action');
        var form_data = form.serialize();
        // $('.deleterole').attr('action',action);
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
                if(response == 0){
                swal({
                    title: "Warning.",
                    text: "You need to Remove Assigned  Entry",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    //window.location.href = ""
                    swal.close();
                })

                }else{

                swal("Deleted!", "Deleted Successfully", "success");
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

    $(document).on('click','.action-deduction-restore', function (e) {
    e.preventDefault();
        var action = $(this).attr('hrm-restore-action');
        $('.restore-link').attr('href',action);
    })

</script>
@endsection
