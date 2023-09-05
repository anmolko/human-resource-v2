@extends('layouts.user_management_master')
@section('title') Employee Payroll @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }

        .select2-container {
            width: 355px;
        }

        .add-btn{
            margin-right: 10px;
        }

        .select-height{
            height:44px;
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

    @if($errors->has('employee_id'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('employee_id')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee Payroll</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee Payroll</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee_payroll"><i class="fa fa-plus"></i> Add Employee Payroll </a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('employee-payroll.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <form action="#" method="post" id="deleted-form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="delete">

                    </form>
                    <!-- Employee Payroll Table -->
                    <table id="payroll-salary-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Employee Type</th>
                            <th>Basic Salary</th>
                            <th>Net Salary</th>
                            <th>Gross Salary</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($payrolls as $payroll)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@\App\Models\Employee::find($payroll->employee_id)->user->name)}}</td>
                                <td>{{ucwords(@$payroll->employee_type)}}</td>
                                <td>{{@$payroll->basic_salary}}</td>
                                <td>{{($payroll->net_salary != null) ? $payroll->net_salary : "N/A"}}</td>
                                <td>{{($payroll->gross_salary != null) ? $payroll->gross_salary : "N/A"}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-view" href="#"  id="{{$payroll->id}}" hrm-view-action="{{route('employee-payroll.show',$payroll->id)}}" data-toggle="modal" data-target="#view_employee_payroll"><i class="fa fa-eye m-r-5"></i> View </a>
                                            <a class="dropdown-item" id="{{$payroll->id}}" href="{{route('employee-payroll.addalldetails',$payroll->id)}}"><i class="fa fa-plus m-r-5"></i> Add Payroll details </a>
                                            <a class="dropdown-item action-edit" href="#" id="{{@$payroll->id}}" hrm-update-action="{{route('employee-payroll.update',@$payroll->id)}}"  hrm-edit-action="{{route('employee-payroll.edit',@$payroll->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('employee-payroll.destroy',@$payroll->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Employee Payroll Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Employee Payroll Modal -->
    @include('admin.modals.payroll.salary.add')
    <!-- /Add Employee Payroll Modal -->

    <!-- view Employee Payroll Modal -->
    @include('admin.modals.payroll.salary.view')
    <!-- /view Employee Payroll Modal -->

    <!-- edit Employee Payroll Modal -->
    @include('admin.modals.payroll.salary.edit')
    <!-- /edit Employee Payroll Modal -->

    <!-- Forbidden Employee Payroll Modal -->
    @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Employee Payroll Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#payroll-salary-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

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
                        swal("Trashed!", "Moved to Trash Successfully", "success");
                        $(response).remove();
                        window.location.reload();
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

        $(document).on('click','.action-edit', function (e) {
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
                    // console.log(dataResult)
                    $("#edit_employee_payroll").modal("toggle");
                    $('#employee_id option[value="'+dataResult.edit.employee_id+'"]').prop('selected', true);
                    $('#employee_type option[value="'+dataResult.edit.employee_type+'"]').prop('selected', true);
                    $('#basic_salary').attr('value',dataResult.edit.basic_salary);

                    if(dataResult.edit.provident_fund_contribution !== null){
                        $('#provident_fund_contribution').attr('value',dataResult.edit.provident_fund_contribution);
                    }

                    if(dataResult.edit.house_rent_allowance !== null){
                        $('#house_rent_allowance').attr('value',dataResult.edit.house_rent_allowance);
                    }
                    if(dataResult.edit.medical_allowance !== null){
                        $('#medical_allowance').attr('value',dataResult.edit.medical_allowance);
                    }
                    if(dataResult.edit.special_allowance !== null){
                        $('#special_allowance').attr('value',dataResult.edit.special_allowance);
                    }
                    if(dataResult.edit.other_allowance !== null){
                        $('#other_allowance').attr('value',dataResult.edit.other_allowance);
                    }

                    var taxdeduct, providentdeduct, otherdeduct, totaldeduct;
                    if(dataResult.edit.tax_deduction !== null){
                        $('#tax_deduction').attr('value',dataResult.edit.tax_deduction);
                        taxdeduct = dataResult.edit.tax_deduction;
                    }else{
                        taxdeduct = 0;
                    }
                    if(dataResult.edit.provident_fund_deduction !== null){
                        $('#provident_fund_deduction').attr('value',dataResult.edit.provident_fund_deduction);
                        providentdeduct = dataResult.edit.provident_fund_deduction;
                    }else{
                        providentdeduct = 0;
                    }
                    if(dataResult.edit.other_deduction !== null){
                        $('#other_deduction').attr('value',dataResult.edit.other_deduction);
                        otherdeduct = dataResult.edit.other_deduction;
                    }else{
                        otherdeduct = 0;
                    }

                    totaldeduct = (+taxdeduct + +providentdeduct + +otherdeduct);
                    $('#total_deductions').attr('value',totaldeduct);

                    if(dataResult.edit.total_provident_fund !== null){
                        $('#total_provident_fund').attr('value',dataResult.edit.total_provident_fund);
                    }
                    if(dataResult.edit.net_salary !== null){
                        $('#net_salary').attr('value',dataResult.edit.net_salary);
                    }
                    if(dataResult.edit.gross_salary !== null){
                        $('#gross_salary').attr('value',dataResult.edit.gross_salary);
                    }
                    $('.updateemployeepayroll').attr('action',action);

                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $('#view_employee_id').text(dataResult.show.employee.user.name);
                    $('#view_employee_type').text(dataResult.show.employee_type);
                    $('#view_basic_salary').text(dataResult.show.basic_salary);

                    if(dataResult.show.house_rent_allowance !== null){
                        $('#view_house_rent_allowance').text(dataResult.show.house_rent_allowance);
                    }else{
                        $('#view_house_rent_allowance').text('N/A');
                    }

                    if(dataResult.show.medical_allowance !== null){
                        $('#view_medical_allowance').text(dataResult.show.medical_allowance);
                    }else{
                        $('#view_medical_allowance').text('N/A');
                    }

                    if(dataResult.show.special_allowance !== null){
                        $('#view_special_allowance').text(dataResult.show.special_allowance);
                    }else{
                        $('#view_special_allowance').text('N/A');
                    }

                    if(dataResult.show.provident_fund_contribution !== null){
                        $('#view_provident_fund_contribution').text(dataResult.show.provident_fund_contribution);
                    }else{
                        $('#view_provident_fund_contribution').text('N/A');
                    }

                    if(dataResult.show.other_allowance !== null){
                        $('#view_other_allowance').text(dataResult.show.other_allowance);
                    }else{
                        $('#view_other_allowance').text('N/A');
                    }

                    var taxdeduct, providentdeduct, otherdeduct, totaldeduct;

                    if(dataResult.show.tax_deduction !== null){
                        $('#view_tax_deduction').text(dataResult.show.tax_deduction);
                        taxdeduct = dataResult.show.tax_deduction;
                    }else{
                        $('#view_tax_deduction').text('N/A');
                        taxdeduct = 0;
                    }

                    if(dataResult.show.provident_fund_deduction !== null){
                        $('#view_provident_fund_deduction').text(dataResult.show.provident_fund_deduction);
                        providentdeduct = dataResult.show.provident_fund_deduction;
                    }else{
                        $('#view_provident_fund_deduction').text('N/A');
                        providentdeduct = 0;
                    }

                    if(dataResult.show.other_deduction !== null){
                        $('#view_other_deduction').text(dataResult.show.other_deduction);
                        otherdeduct = dataResult.show.other_deduction;
                    }else{
                        $('#view_other_deduction').text('N/A');
                        otherdeduct = 0;
                    }

                    totaldeduct = (+taxdeduct + +providentdeduct + +otherdeduct);

                    if(dataResult.show.total_provident_fund !== null){
                        $('#view_total_provident_fund').text(dataResult.show.total_provident_fund);
                    }else{
                        $('#view_total_provident_fund').text('N/A');
                    }

                    if(dataResult.show.net_salary !== null){
                        $('#view_net_salary').text(dataResult.show.net_salary);
                    }else{
                        $('#view_net_salary').text('N/A');
                    }

                    $('#view_total_deductions').text(totaldeduct);

                    if(dataResult.show.gross_salary !== null){
                        $('#total_gross_salary').text(dataResult.show.gross_salary);
                    }else{
                        $('#total_gross_salary').text('N/A');
                    }
                }
            });
        });

        //For Calculation
        $(document).on("keyup", "#employee_create_payroll", function() {
            calculation();
        });

        $(document).on("keyup", "#employee_edit_payroll", function() {
            edit_calculation();
        });

        function calculation() {
            var basic_salary = ($("#create_basic_salary").val() !== undefined) ? $("#create_basic_salary").val(): 0;
            var house_rent_allowance = ($("#create_house_rent_allowance").val() !== undefined) ? $("#create_house_rent_allowance").val(): 0;
            var medical_allowance = ($("#create_medical_allowance").val() !== undefined) ? $("#create_medical_allowance").val(): 0;
            var special_allowance = ($("#create_special_allowance").val() !== undefined) ? $("#create_special_allowance").val(): 0;
            var provident_fund_contribution = ($("#create_provident_fund_contribution").val() !== undefined) ? $("#create_provident_fund_contribution").val(): 0;
            var other_allowance = ($("#create_other_allowance").val() !== undefined) ? $("#create_other_allowance").val(): 0;
            var tax_deduction = ($("#create_tax_deduction").val() !== undefined) ? $("#create_tax_deduction").val(): 0;
            var provident_fund_deduction = ($("#create_provident_fund_deduction").val() !== undefined) ? $("#create_provident_fund_deduction").val(): 0;
            var other_deduction = ($("#create_other_deduction").val() !== undefined) ? $("#create_other_deduction").val(): 0;

            var gross_salary = (+basic_salary + +house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance);

            var total_deduction = (+tax_deduction + +provident_fund_deduction + +other_deduction);

            $("#create_total_provident_fund").attr('value',+provident_fund_contribution + +provident_fund_deduction);

            $("#create_gross_salary").attr('value',gross_salary);
            $("#create_total_deductions").attr('value',total_deduction);
            $("#create_net_salary").attr('value',+gross_salary - +total_deduction);
        }

        function edit_calculation() {
            var basic_salary = ($("#basic_salary").val() !== undefined) ? $("#basic_salary").val(): 0;
            var house_rent_allowance = ($("#house_rent_allowance").val() !== undefined) ? $("#house_rent_allowance").val(): 0;
            var medical_allowance = ($("#medical_allowance").val() !== undefined) ? $("#medical_allowance").val(): 0;
            var special_allowance = ($("#special_allowance").val() !== undefined) ? $("#special_allowance").val(): 0;
            var provident_fund_contribution = ($("#provident_fund_contribution").val() !== undefined) ? $("#provident_fund_contribution").val(): 0;
            var other_allowance = ($("#other_allowance").val() !== undefined) ? $("#other_allowance").val(): 0;
            var tax_deduction = ($("#tax_deduction").val() !== undefined) ? $("#tax_deduction").val(): 0;
            var provident_fund_deduction = ($("#provident_fund_deduction").val() !== undefined) ? $("#provident_fund_deduction").val(): 0;
            var other_deduction = ($("#other_deduction").val() !== undefined) ? $("#other_deduction").val(): 0;

            var gross_salary = (+basic_salary + +house_rent_allowance + +medical_allowance + +special_allowance + +other_allowance);

            var total_deduction = (+tax_deduction + +provident_fund_deduction + +other_deduction);

            $("#total_provident_fund").attr('value',+provident_fund_contribution + +provident_fund_deduction);

            $("#gross_salary").attr('value',gross_salary);
            $("#total_deductions").attr('value',total_deduction);
            $("#net_salary").attr('value',+gross_salary - +total_deduction);
        }


    </script>
@endsection
