@extends('layouts.account_master')
@section('title') Single Contra Voucher @endsection
@section('css')
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Single Contra Voucher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item active">Single Contra Voucher</li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">

                    <!-- Contra Voucher Table -->
                    <table id="contra-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Ref No.</th>
                            <th>Narration</th>
                            <th>Closing Balance</th>
                            <th>Created By</th>
                            <th>Updated By</th>

                        </tr>
                        </thead>
                        <tbody>

                        @php($i=1)
                        @foreach($contra_voucher as $contra)
                            <tr data-child-value="{{$contra}}">
                                <td class="details-control"><i class="fa fa-plus-square" aria-hidden="true"></i></td>
                                <?php if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $contra->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                    <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                <td>{{date('j F, Y',strtotime(@$contra->date))}}</td>
                                <?php }else{?>
                                <td>{{date('j F, Y',strtotime(@$contra->date))}}</td>
                                <?php }?>
                                <td>{{ucwords(@$contra->ref_no)}}</td>
                                <td>{{ucwords(@$contra->narration)}}</td>
                                <td>{{ucwords(@$contra->total_amount)}}</td>

                                <td> {{ucwords(App\Models\User::find(@$contra->created_by)->name)}}</td>
                                <td>@if(isset($contra->updated_by))
                                        {{ucwords(App\Models\User::find($contra->updated_by)->name)}}
                                    @else
                                        This is not Updated Yet.
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /Contra Voucher Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

@endsection

@section('js')

    <script type="text/javascript">
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
                $.each(mainvalue.contra_particulars, function( index, value ) {

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

            var table = $('#contra-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            // for all journal entry
            $('#contra-index tbody').off('click', 'td.details-control');
            $('#contra-index tbody').on('click', 'td.details-control', function () {
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



    </script>
@endsection
