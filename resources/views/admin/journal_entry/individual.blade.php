@extends('layouts.account_master')
@section('title') View Journal Voucher @endsection
@section('css')
<style>
    div#payment-single-data-card {
        border: none;
        border-radius: unset;
        background-clip: unset;

    }
    @page { size: auto;  margin: 0mm; }
</style>
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Journal Entry Voucher Info</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('journal-entry.index')}}">Journal Entry Voucher</a></li>
                        <li class="breadcrumb-item active">View Voucher Information</li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="row align-items-center report-groups">
            <div class="col">
            </div>
            <div class="col-auto float-right ml-auto">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" id="generate-pdf">PDF</button>
                    <button class="btn btn-white" onclick="printerDiv('payment-single-data-card')"><i class="fa fa-print fa-lg"></i> Print</button>
                </div>
            </div>
        </div>

        <div class="row" id="payment-single-data">
    <div class="col-md-12">
        <div class="card" id="payment-single-data-card">
            <div class="card-body">
                <div class="text-center">
                    <img src="<?php if(@$company_data->company_logo){?>{{asset('/images/company/'.@$company_data->company_logo)}}<?php }else{?>{{asset('/backend/assets/img/logo2.png')}}<?php }?>" class="inv-logo" alt="">
                </div>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <ul class="list-unstyled">
                            <li>{{ (@$company_data->company_name) ? ucwords(@$company_data->company_name) : 'CanoSoft Technologies'}}</li>
                            <li>{{(@$company_data->company_address) ? ucwords(@$company_data->company_address) : 'Putalisadak, Kathmandu'}}</li>
                            <li>{{(@$company_data->email) ? @$company_data->email : 'info@canosoft.com.np'}}</li>
                            <li>{{(@$company_data->phone) ? @$company_data->phone.' , ' : '9860809978 ,'}} {{(@$company_data->mobile) ? @$company_data->mobile : '9860809978'}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase ref_id">{{ucwords(@$journal_voucher->ref_no)}}</h3>
                            <input type="hidden" name="ref_id" id="ref_id" value="{{$journal_voucher->ref_no}}"/>
                            <ul class="list-unstyled">
                                <li>Type: <span class="voucher-type">Journal entry Voucher</span></li>
                                <li>Today's Date: <span class="current-date">{{\Carbon\Carbon::now()->toFormattedDateString()}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="single-payment" class="ledger-table table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Narration</th>
                            <th>Closing Balance</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php if(@$theme_data->default_date_format=='nepali'){
                                    $pieces = explode("-", $journal_voucher->date);
                                    echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                    <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                <td>{{date('j F, Y',strtotime(@$journal_voucher->date))}}</td>
                                <?php }else{?>
                                <td>{{date('j F, Y',strtotime(@$journal_voucher->date))}}</td>
                                <?php }?>
                                <td>{{ucwords(@$journal_voucher->narration)}}</td>
                                <td>{{ucwords(@$journal_voucher->total_amount)}}</td>
                            </tr>
                            <tr>
                                <td colspan="8">
                                    <table class="table table-striped custom-table mb-0 dataTable no-footer">
                                        <thead>
                                            <tr>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Debit Amount</th>
                                                <th>Credit Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(@$journal_voucher->journalParticulars as $pp)
                                            <?php
                                            if($pp->credit==null){
                                                $creditname = "-";
                                            }else{
                                                $creditname = $pp->credit->name;
                                            }

                                            if($pp->debit == null){
                                                $debitname = "-";
                                            }else{
                                                $debitname = $pp->debit->name;
                                            } ?>
                                            <tr>
                                                <td class="text-capitalize">{{$debitname}}</td>
                                                <td class="text-capitalize">{{$creditname}}</td>
                                                <td>{{$pp->debit_amount}}</td>
                                                <td>{{$pp->debit_amount}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row" style="padding-top: 15px;">
                    <div class="col-sm-7 m-b-20">
                        <ul class="list-unstyled">
                            <li>Receiver's Signature: </li>
                        </ul>
                    </div>
                    <div class="col-sm-5 m-b-20">
                        <ul class="list-unstyled">
                            <li>Authorized Signature:</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    </div>
@endsection


@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
            var nep = NepaliFunctions.GetCurrentBsDate();
            var nepali_date = NepaliFunctions.GetBsFullDate(nep,false);
            $('.current-date').text(nepali_date);
            <?php }?>
        });

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

        var cache_width = $('#payment-single-data-card').width();
        var a4 = [595.28, 841.89];

        $(document).on("click", '#generate-pdf', function () {
            // $("#ledger-single-data-card").width((a4[0] * 1.33333)).css('max-width', 'none');
            var text = $('.ref_id').text();
            // console.log(text.trim());
            var name = text.trim();
            // console.log(name);
            // Aqui ele cria a imagem e cria o pdf
            html2canvas($('#payment-single-data-card'), {
                onrendered: function (canvas) {
                    var imgData = canvas.toDataURL('image/png');
                    var imgWidth = 210;
                    var pageHeight = 295;
                    var imgHeight = canvas.height * imgWidth / canvas.width;
                    var heightLeft = imgHeight;
                    var doc = new jsPDF('p', 'mm');
                    var position = 5; // give some top padding to first page

                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft >= 0) {
                        position += heightLeft - imgHeight; // top padding for other pages
                        doc.addPage();
                        doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }
                    doc.save(name+'-payment-details.pdf');
                }
            });
        });

    </script>
@endsection
