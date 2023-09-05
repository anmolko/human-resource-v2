@extends('layouts.user_management_master')
@section('title') Payroll Items @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }
        .select2-container {
            width: 255px;
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

    @if($errors->has('deduction_amount'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('deduction_amount')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('amount'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('amount')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('month'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('month')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('deduction_name'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('deduction_name')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All Payroll Items</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('employee-payroll.index')}}">Employee Payroll</a></li>
                        <li class="breadcrumb-item active">Payroll Items</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('payroll.trash',@$payroll_info->id)}}" class="btn add-btn margin-right"><i class="fa fa-eye"></i> View all trash </a>

                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <!-- Page Tab -->
        <div class="page-menu">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab_increments">Increments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_bonus">Bonus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_deductions">Deductions</a>
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

                <!-- Add Increment Button -->
                <div class="text-right mb-4 clearfix">
                    <button class="btn btn-primary add-btn" type="button" data-toggle="modal" data-target="#add_increment"><i class="fa fa-plus"></i> Add Increment</button>
                </div>
                <!-- /Add Increment Button -->

                <!-- Payroll Increment Table -->
                <div class="payroll-table">
                    <div class="table-responsive">
                        <table class="table table-hover table-radius" id="increment-index">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Increment Month</th>
                                    <th>Amount</th>
                                    <th>Purpose</th>
{{--                                    <th class="text-right">Action</th>--}}
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($increments as $increment)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="#" class="avatar">
                                                <img alt="{{@$increment->payroll->employee->user->name}}" src="<?php if(!empty($increment->payroll->employee->user->image)){ echo '/images/user/'.$increment->payroll->employee->user->image; } else { if($increment->payroll->employee->user->gender== "male") {echo '/images/profiles/male.png'; } elseif($increment->payroll->employee->user->gender=="female") {echo '/images/profiles/female.png'; } elseif($increment->payroll->employee->user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                            </a>
                                            <a href="#">{{ucwords($increment->payroll->employee->user->name)}}
                                                <span>
                                                {{ucwords($increment->payroll->employee->designation->name)}}
                                                </span></a>
                                        </h2>
                                    </td>
                                    <td>{{ date("F Y", strtotime($increment->month)) }}</td>
                                    <td>{{number_format($increment->amount)}}</td>
                                    <td>{{ucfirst($increment->purpose)}}</td>
{{--                                    <td class="text-right">--}}
{{--                                        <div class="dropdown dropdown-action">--}}
{{--                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                <a class="dropdown-item action-increment-edit" href="#" id="{{@$increment->id}}" hrm-update-action="{{route('increment.update',@$increment->id)}}"  hrm-edit-action="{{route('increment.edit',@$increment->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                <a class="dropdown-item action-increment-delete" href="#"  hrm-delete-action="{{route('increment.destroy',@$increment->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
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

                <!-- Add Bonus Button -->
                <div class="text-right mb-4 clearfix">
                    <button class="btn btn-primary add-btn" type="button" data-toggle="modal" data-target="#add_bonus"><i class="fa fa-plus"></i> Add Bonus</button>
                </div>
                <!-- /Add Bonus Button -->

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
                            @foreach($bonuses as $bonus)
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
                                                <a class="dropdown-item action-bonus-edit" href="#" id="{{@$bonus->id}}" hrm-update-action="{{route('bonus.update',@$bonus->id)}}"  hrm-edit-action="{{route('bonus.edit',@$bonus->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item action-bonus-delete" href="#"  hrm-delete-action="{{route('bonus.destroy',@$bonus->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
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

                <!-- Add Deductions Button -->
                <div class="text-right mb-4 clearfix">
                  <button class="btn btn-primary add-btn" type="button" data-toggle="modal" data-target="#add_deduction"><i class="fa fa-plus"></i> Add Deduction</button>
                </div>
                <!-- /Add Deductions Button -->

                <!-- Payroll Deduction Table -->
                <div class="payroll-table">
                    <div class="table-responsive">
                    <form action="#" method="post" id="deleted-form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="delete">

                    </form>
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
                            @foreach($deductions as $deduction)
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
                                                <a class="dropdown-item action-deduction-edit" href="#" id="{{@$deduction->id}}" hrm-update-action="{{route('deduction.update',@$deduction->id)}}"  hrm-edit-action="{{route('deduction.edit',@$deduction->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item action-deduction-delete" href="#"  hrm-delete-action="{{route('deduction.destroy',@$deduction->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
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

    <!-- Add Increment Modal -->
    @include('admin.modals.payroll.increment.add')
    <!-- /Add Increment Modal -->

    <!-- Edit Increment Modal -->
    @include('admin.modals.payroll.increment.edit')
    <!-- /Edit Increment Modal -->


    <!-- Add Bonus Modal -->
    @include('admin.modals.payroll.bonus.add')
    <!-- /Add Bonus Modal -->

   <!-- Edit Bonus Modal -->
   @include('admin.modals.payroll.bonus.edit')
    <!-- /Edit Bonus Modal -->

   <!-- Add Deduction Modal -->
     @include('admin.modals.payroll.deduction.add')
    <!-- /Add Deduction Modal -->

      <!-- Edit Deduction Modal -->
      @include('admin.modals.payroll.deduction.edit')
    <!-- /Edit Deduction Modal -->

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




            $('#datetimepickermonth').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            })

            $('#datetimepickermonthincrement').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            })

            $('#editdatetimepickermonthincrement').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            })


            $('#datetimepickermonthbonus').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            })

            $('#editdatetimepickermonth').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            })

            $('#editdatetimepickermonthbonus').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            })



        });


        // $(window).on ('load', function (){
        //     $('#deduction-index_wrapper > div.row:nth-child(3n+2)').addClass('card');
        // });

        $(document).on('click','.action-increment-delete', function (e) {
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
                                title: "Warning!",
                                text: "You need to Remove Assigned  First",
                                type: "info",
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

        $(document).on('click','.action-increment-edit', function (e) {
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
                    console.log(dataResult)
                    $("#edit_increment").modal("toggle");
                    $('.updatemonth').attr('value',dataResult.month);
                    $('.updateamount').attr('value',dataResult.amount);
                    $('.updatepurpose').text(dataResult.purpose);

                    $('.updateincrement').attr('action',action);


                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-bonus-delete', function (e) {
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
                                title: "Warning!",
                                text: "You need to Remove Assigned  First",
                                type: "info",
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

        $(document).on('click','.action-bonus-edit', function (e) {
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
                    console.log(dataResult)
                    $("#edit_bonus").modal("toggle");
                    $('.updatename').attr('value',dataResult.name);
                    $('.updatemonth').attr('value',dataResult.month);
                    $('.updateamount').attr('value',dataResult.amount);
                    $('.updatedescription').text(dataResult.description);

                    $('.updatebonus').attr('action',action);


                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });


        $(document).on('click','.action-deduction-delete', function (e) {
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
                                title: "Warning!",
                                text: "You need to Remove Assigned  First",
                                type: "info",
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

        $(document).on('click','.action-deduction-edit', function (e) {
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
                    console.log(dataResult)
                    $("#edit_deduction").modal("toggle");
                    $('.updatename').attr('value',dataResult.deduction_name);
                    $('.updatemonth').attr('value',dataResult.deduction_month);
                    $('.updateamount').attr('value',dataResult.deduction_amount);
                    $('.updatedescription').text(dataResult.deduction_description);


                    $('.updatededuction').attr('action',action);


                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

    </script>
@endsection
