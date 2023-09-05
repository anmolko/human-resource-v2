@extends('layouts.account_master')
@section('title') Payment Voucher @endsection
@section('css')
    <style>
        td.details-controls {
            text-align:center;
            cursor: pointer;
        }
        tr.shown td.details-controls {
            text-align:center;
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



    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Payment Voucher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item active">Payment Voucher</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('payment-voucher.create')}}" class="btn add-btn" ><i class="fa fa-plus"></i> Add Payment Voucher</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('payment-voucher.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash </a>
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
                    <!-- Payment Voucher Table -->
                    <table id="payment-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Ref No.</th>
                            <th>Narration</th>
                            <th>Closing Balance</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($payment_voucher as $payment)
                            <tr data-child-value="{{$payment}}">
                                <td class="details-control"><i class="fa fa-plus-square" aria-hidden="true"></i></td>
                                <?php if(@$theme_data->default_date_format=='nepali'){
                                        $pieces = explode("-", $payment->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                    <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                        <td>{{date('j F, Y',strtotime(@$payment->date))}}</td>
                                    <?php }else{?>
                                        <td>{{date('j F, Y',strtotime(@$payment->date))}}</td>
                                    <?php }?>
                                <td><a href="{{route('payment-voucher.print',$payment->ref_no)}}">{{ucwords(@$payment->ref_no)}}</a></td>
                                <td>{{ucwords(@$payment->narration)}}</td>
                                <td>{{ucwords(@$payment->total_amount)}}</td>

                                <td> {{ucwords(App\Models\User::find(@$payment->created_by)->name)}}</td>
                                <td>@if(isset($payment->updated_by))
                                        {{ucwords(App\Models\User::find($payment->updated_by)->name)}}
                                    @else
                                        This is not Updated Yet.
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('payment-voucher.print',$payment->ref_no)}}"><i class="fa fa-eye m-r-5"></i> View</a>
                                            <a class="dropdown-item" href="{{route('payment-voucher.edit',$payment->ref_no)}}" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('payment-voucher.destroy',$payment->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Payment Voucher Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->
@endsection
@section('js')

    <script type="text/javascript">
        function printerDiv(divID) {
            var divElements = document.getElementById(divID).innerHTML;
            var oldPage = document.body.innerHTML;
            document.body.innerHTML =
                "<html><head><title></title></head><body>" +
                divElements + "</body>";
            //Print Page
            window.print();
            //Restore orignal HTML
            document.body.innerHTML = oldPage;

        }
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            function format(mainvalue) {
                var creditname ="";
                var debitname ="";
                var inner_table = '<table class="table table-striped custom-table mb-0 dataTable no-footer"><thead><tr><th>Debit</th><th>Credit</th><th>Debit Amount</th><th>Credit Amount</th></tr></thead><tbody>'
                $.each(mainvalue.payment_particulars, function( index, value ) {

                    if(value.credit==null || value.credit==0){
                        creditname = "-";

                    }else{
                        creditname = value.credit.name;

                    }

                    if(value.debit == null ||  value.debit =="undefined"){
                        debitname = "-";
                    }else{
                        debitname = value.debit.name;

                    }
                    inner_table += '<tr><td class="text-capitalize">'+ debitname +'</td><td class="text-capitalize">'
                        + creditname + '</td><td>'
                        + value.debit_amount + '</td><td>'
                        + value.credit_amount + '</td></tr>';

                })

                return inner_table;
            }

            var table = $('#payment-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            // for all journal entry
            $('#payment-index tbody').off('click', 'td.details-control');
            $('#payment-index tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var tdi = tr.find("i.fa");
                var row = table.row(tr);


                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    tdi.first().removeClass('fa-minus-square');
                    tdi.first().addClass('fa-plus-square');
                } else {
                    // Open this row
                    row.child(format(tr.data('child-value'))).show();
                    tr.addClass('shown');
                    tdi.first().removeClass('fa-plus-square');
                    tdi.first().addClass('fa-minus-square');
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
                                text: "Failed to move Payment vouchers into trash",
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

        });


    </script>
@endsection
