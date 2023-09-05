@extends('layouts.user_management_master')
@section('title') Employee Salary Payment @endsection
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

        .print-table tr th{
            text-align: center;
        }
        .print-table tr td{
            text-align: center;
        }
        .print-table tr th:last-child{
            text-align: right;
        }
        .print-table tr td:last-child{
            text-align: right;
        }
        div#payment-single-data-card {
            border: none;
            border-radius: unset;
            background-clip: unset;

        }
        @page { size: auto;  margin: 0mm; }

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
                        <li class="breadcrumb-item active">Employee Salary Payment</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <!-- Search Filter -->
        <form id="salary-payment-form">
            <div class="row filter-row">
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <select class="select floating" name="payroll_id" id="payroll_id">
                                <option disabled selected>Employee Payroll List</option>
                                @foreach($payrolls as $payroll)
                                    <option value="{{$payroll->id}}">{{ucfirst($payroll->employee->user->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="focus-label">Select</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <div class="cal-icon">
                            <input class="form-control floating" name="payment_month" id="datetimepickermonth" type="text">
                        </div>
                        <label class="focus-label">Select Month</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="btn add-btn btn-block" id="make-payment"> Make Payment </a>

                </div>
            </div>
        </form>
    <!-- /Search Filter -->

        <div class="row">
            <div class="col-md-12" id="response-data-load">

            </div>
        </div>

    </div>
    <!-- /Page Content -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datetimepickermonth').datetimepicker({
                format: 'YYYY-MM',
                viewMode: "months",
            });
        });

        function printerDiv(divID) {
            var cssname     = "/backend/assets/css/<?php if(@$theme_data->color){?>{{@$theme_data->color}}<?php }else{ echo "light_grey"; }?>.css";
            var bootstrap   = '<link rel="stylesheet" href="backend/assets/css/bootstrap.min.css" type="text/css">';
            var fontawesome = '<link rel="stylesheet" href="backend/assets/css/font-awesome.min.css" type="text/css">';
            var colorname   = '<link rel="stylesheet" href="'+cssname+'" type="text/css">';
            var stylename   = '<link rel="stylesheet" href="backend/assets/css/style.css" type="text/css">';
            var employeename = document.getElementById("payroll_id");
            var month        = document.getElementById("datetimepickermonth").value;
            var strUser = employeename.options[employeename.selectedIndex].text;

            var getpanel = document.getElementById(divID);
            var MainWindow = window.open('', '', 'height=1000,width=1000');
            MainWindow.document.write('<html><head><title>'+ strUser +' payment slip for '+ month +' </title>');
            MainWindow.document.write(bootstrap);
            MainWindow.document.write(fontawesome);
            MainWindow.document.write(stylename);
            MainWindow.document.write(colorname);
            MainWindow.document.write('</head><body onload="window.print();window.close()">');
            MainWindow.document.write(getpanel.innerHTML);
            MainWindow.document.write('</body></html>');
            MainWindow.document.close();
            setTimeout(function () {
                MainWindow.print();
            }, 500)
            return false;
        }


        $(document).on("click", '#make-payment', function(event){
            event.preventDefault();

            var payrollid     = $("select[name=payroll_id]").val();
            var payment_month = $("#datetimepickermonth").val();
            console.log(payment_month);

            if(payrollid == null || payrollid == undefined){
                swal({
                    title: 'Salary Payment Warning',
                    text: "Please Select a employee to make payment.",
                    type: "info",
                    showCancelButton: false,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
            } else if(payment_month == "" ||payment_month == undefined){
                swal({
                    title: 'Salary Payment Warning',
                    text: "Please Select a month to make payment.",
                    type: "info",
                    showCancelButton: false,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
            } else{
                $.ajax({
                    type: "POST",
                    url: "{{ route('employee-payment.loadmakepayment') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        payroll_id:payrollid,
                        month:payment_month
                    },
                    success: function(data) {
                        $('#response-data-load').html(data);
                    },
                    error: function() {
                        // toastr.warning("Data Not Found");
                    }
                });
            }




        });
    </script>




@endsection
