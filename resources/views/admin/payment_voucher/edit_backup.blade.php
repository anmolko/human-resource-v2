@extends('layouts.account_master')
@section('title') Edit Payment Entry @endsection
@section('css')
    <style>
        .cal-icon{
            width:50%;
        }
        .group-button-journal{
            display: flex;
            justify-content: space-between;
        }

        .custom-select{
            text-transform: capitalize;
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

    @if($errors->has('ref_no'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('ref_no')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('narration'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('narration')}}</span>
            </p>
        </div>
    @endif

    @if($errors->has('date'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('date')}}</span>
            </p>
        </div>
    @endif


    <!-- Page Content -->
    <div class="content container-fluid">
        <meta name="account-list" content="{{ $secondaryvalue }}">
        <meta name="account-list-bank" content="{{ $credit_bank }}">
        <meta name="account-list-cash" content="{{ $credit_cash }}">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Edit Payment Voucher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('payment-voucher.index')}}">Payment Voucher</a></li>
                        <li class="breadcrumb-item active">Edit Payment Voucher</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'put','route'=>['payment-voucher.update', $editpaymententries->id],'id'=>'payment-entry-form','class'=>'needs-validation','novalidate'=>'']) !!}
                        <div class="row">
                            <div class="col-sm-6 m-b-20">
                                <div class="">
                                    <h4 class="text-uppercase">Voucher no. {{@$editpaymententries->ref_no}}</h4>
                                    <input class="form-control" type="hidden" value="{{$editpaymententries->ref_no}}" name="ref_no" readonly="">
                                    <input class="form-control" type="hidden" name="total_amount" value="{{$editpaymententries->total_amount}}">

                                    <ul class="list-unstyled">
                                        <li>Transaction Date:</li>
                                        <div class="cal-icon">
                                            <input class="form-control" id="datetimepicker" name="date" value="{{@$editpaymententries->date}}" type="text" required>

                                            <div class="invalid-feedback">
                                                Please choose a date.
                                            </div>
                                            @if($errors->has('date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('date')}}
                                                </div>
                                            @endif



                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-white payment-entries">
                                <thead>
                                <tr>
                                    <th>DR/CR </th>
                                    <th >Particulars</th>
                                    <th >Debit Amount</th>
                                    <th>Credit Amount</th>
                                    <th> </th>
                                </tr>
                                </thead>
                                <tbody>

                                @php $count = 0;  @endphp
                                @if(!empty(@$editpaymententries))
                                    @foreach(@$editpaymententries->PaymentParticulars as $PaymentParticulars)
                                        <input class="form-control" type="hidden" name="particular_id[]" value="{{$PaymentParticulars->id}}">
                                        <tr>
                                            <td>
                                                <select class="custom-select form-control" name="drcr[]" id="<?php echo $count; ?>">
                                                    <option value="1" <?php if(@$PaymentParticulars->by_debit_id != null) echo "selected"; ?>>Debit</option>
                                                    <option value="2" <?php if(@$PaymentParticulars->to_credit_id != null)  echo "selected"; ?>>Credit</option>
                                                </select>
                                            </td>
                                            <?php
                                            if(@$PaymentParticulars->by_debit_id != null){ ?>
                                            <td>
                                                <select  class="custom-select form-control" name="account_title[]" id="account_title_<?php echo $count; ?>" required>
                                                    @foreach($secondaryvalue as $value)
                                                        <option value="{{$value->id}}" <?php if(@$PaymentParticulars->by_debit_id == $value->id) echo "selected"; ?>>{{ucwords($value->name)}} </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a particulars name.
                                                </div>
                                            </td>

                                            <?php } ?>

                                            <?php
                                            if(@$PaymentParticulars->to_credit_id != null){ ?>
                                            <td>
                                                <select  class="custom-select form-control" name="account_title[]" id="account_title_<?php echo $count; ?>" required>
                                                    <optgroup label="Cash">
                                                    @foreach($credit_cash as $value)
                                                        <option value="{{$value->id}}" <?php if(@$PaymentParticulars->to_credit_id == $value->id) echo "selected"; ?>>{{ucwords($value->name)}} </option>
                                                    @endforeach
                                                    </optgroup>
                                                    <optgroup label="Bank">
                                                        @foreach($credit_bank as $value)
                                                            <option value="{{$value->id}}" <?php if(@$PaymentParticulars->to_credit_id == $value->id) echo "selected"; ?>>{{ucwords($value->name)}} </option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a particulars name.
                                                </div>
                                            </td>

                                            <?php } ?>

                                            <td>

                                                <input class="form-control"  style="min-width:100px" name="debit_amount[]" type="number" min="0" step="0.01" id="dr-amt" placeholder="0.00" value="{{$PaymentParticulars->debit_amount}}" <?php if($PaymentParticulars->debit_amount==0) echo "readonly";?> required>
                                                <div class="invalid-feedback">
                                                    Please enter a debit amount.
                                                </div>
                                            </td>

                                            <td>
                                                <input class="form-control" style="min-width:100px" name="credit_amount[]" type="number" id="cr-amt" placeholder="0.00"  value="{{$PaymentParticulars->credit_amount}}" required <?php if($PaymentParticulars->credit_amount==0) echo "readonly";?>>
                                                <div class="invalid-feedback">
                                                    Please enter a credit amount.
                                                </div>
                                            </td>
                                            <?php
                                            // last iteration
                                            if( $count == count( $editpaymententries->PaymentParticulars ) - 1) { ?>
                                            <td><a href="javascript:void(0)" class="text-success font-18 add-entry" title="Add"><i class="fa fa-plus"></i></a></td>

                                            <?php } ?>

                                        </tr>



                                        @php $count = $count + 1;   @endphp


                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>


                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Narration <span>*</span></label>
                                        <textarea class="form-control" name="narration" rows="4" required>{{@$editpaymententries->narration}}</textarea>
                                        <div class="invalid-feedback">
                                            Please enter a narration.
                                        </div>
                                        @if($errors->has('narration'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('narration')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="submit_payment_entry" >Update</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
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


            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'

            })
        });

        $("select[name='drcr[]']").on('change',function(){
            var drInput = $(this).closest('tr').find("td #dr-amt");
            var crInput = $(this).closest('tr').find("td #cr-amt");
            var count = $(this).attr('id');
            var titlename = "#account_title_"+count;
            if($(this).val() == '1'){
                var selectoptions = $(titlename);
                var selectOptionVals = $('meta[name="account-list"]').attr('content');
                var jsonParsed = JSON.parse(selectOptionVals);
                selectoptions.empty();
                for(var i = 0; i < jsonParsed.length; i++) {
                    selectoptions.append(
                        '<option value="'+ jsonParsed[i]['id'] +'">'+ jsonParsed[i]['name'] + '</option>'
                    );

                }
                drInput.attr('readonly',false);
                drInput.attr('required','required');


                crInput.attr('readonly',true);
                crInput.removeAttr('required','required');

            }else{
                var selectoption = $(titlename);
                var cashOptionVal = $('meta[name="account-list-cash"]').attr('content');
                var bankOptionVal = $('meta[name="account-list-bank"]').attr('content');
                var cashParse = JSON.parse(cashOptionVal);
                var bankParse = JSON.parse(bankOptionVal);
                selectoption.empty();
                var cashappend =  $("<optgroup label='Cash'>");
                for(var i = 0; i < cashParse.length; i++) {
                    var foocash = '<option value="'+ cashParse[i]['id'] +'">'+ cashParse[i]['name'] + '</option>';
                    cashappend.append(foocash);
                }
                selectoption.append(cashappend);

                var bankappend =  $("<optgroup label='Bank'>");
                for(var i = 0; i < bankParse.length; i++) {
                    var foobank = '<option value="'+ bankParse[i]['id'] +'">'+ bankParse[i]['name'] + '</option>';
                    bankappend.append(foobank);
                }
                selectoption.append(bankappend);
                drInput.attr('readonly',true);
                drInput.removeAttr('required','required');

                crInput.attr('readonly',false);
                crInput.attr('required','required');

            }
            drInput.val('0');
            crInput.val('0');
        });


        /*
        * @description:   Validation in Journal Entry
                             -Checks if duplicated account title is inputted
                             -Checks if credit or debit amount in not zero
        */
        function checkIfDuplicate(){
            var accountTitles =  [];
            var tAccountTitle = NaN;
            var is_duplicate = NaN;
            var amount = 0;
            $('.payment-entries tbody').find('tr').each(function(rowIndex, r){
                amount = 0;
                $(this).find('td ').each(function (colIndex, c) {
                    var selectAccountTitle = $(this).find("select");
                    var input = $(this).find("input:enabled");
                    if(input.attr('type')==='number' && amount==0){
                        amount = input.val() == ''?0:input.val();
                    }
                    // console.log(amount);
                    if(selectAccountTitle.attr('name')=='account_title[]'){
                        tAccountTitle = selectAccountTitle.val();
                    }

                });

                if(tAccountTitle == null || tAccountTitle==""){
                    is_duplicate = 'Please select the particulars';
                    return true;
                }

                if(amount <= 0){
                    is_duplicate = 'CR/DR amount must be greater than zero';
                    return true;
                }



                if(tAccountTitle){
                    if($.inArray(tAccountTitle,accountTitles) != -1){
                        is_duplicate = 'Duplicate Account Title Detected';
                        return true;
                    }else{
                        accountTitles.push(tAccountTitle);
                    }
                }
            });
            return is_duplicate;
        }


        var counter =0;
        var continuedcount = <?php echo $count ?>;
        $(document).on('click', '.add-entry', function(){
            var isDuplicate = checkIfDuplicate();
            if(isDuplicate){
                swal({
                    title: 'Journal Entry Warning',
                    text: isDuplicate,
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
                //   alert(isDuplicate)
            }else{
                $('.payment-entries tbody').append(
                    '<tr>' +
                    '<td>' +
                    '<select class="custom-select form-control" name="drcr[]" id="'+ continuedcount +'">' +
                    '<option value="1">Debit</option>' +
                    '<option value="2" selected>Credit</option>' +
                    '</select>' +
                    '</td> ' +
                    '<td>' +
                    '<select class="custom-select form-control" name="account_title[]" id="account_title_'+ continuedcount +'">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input class="form-control"  style="min-width:100px" name="debit_amount[]" type="number" min="0" step="0.01" id="dr-amt" placeholder="0.00" value="0" readonly="">' +
                    '<div class="invalid-feedback">'+
                    'Please enter a debit amount.'+
                    '</div>'+
                    '</td>' +
                    '<td>' +
                    '<input class="form-control" style="min-width:100px" name="credit_amount[]" type="number" id="cr-amt" placeholder="0.00" value="0" required>' +
                    '<div class="invalid-feedback">'+
                    'Please enter a credit amount.'+
                    '</div>'+
                    '</td>' +
                    '<td class="group-button-journal">' +
                    '<a href="javascript:void(0)" class="text-success font-18 add-entry" title="Add"><i class="fa fa-plus"></i></a>' +
                    '<a href="javascript:void(0)" class="delete-entry text-danger font-18" title="Remove"><i class="fa fa-trash-o"></i></a>'+
                    '</td>' +
                    '</tr>'
                );


                $('.payment-entries tr:last td').each(function(){
                    var name = "#account_title_"+continuedcount;
                    var selectoptioned = $(name);
                    var cashOptionVal = $('meta[name="account-list-cash"]').attr('content');
                    var bankOptionVal = $('meta[name="account-list-bank"]').attr('content');
                    var cashParse = JSON.parse(cashOptionVal);
                    var bankParse = JSON.parse(bankOptionVal);
                    selectoptioned.empty();
                    var cashappend =  $("<optgroup label='Cash'>");
                    for(var i = 0; i < cashParse.length; i++) {
                        var foocash = '<option value="'+ cashParse[i]['id'] +'">'+ cashParse[i]['name'] + '</option>';
                        cashappend.append(foocash);
                    }
                    selectoptioned.append(cashappend);

                    var bankappend =  $("<optgroup label='Bank'>");
                    for(var i = 0; i < bankParse.length; i++) {
                        var foobank = '<option value="'+ bankParse[i]['id'] +'">'+ bankParse[i]['name'] + '</option>';
                        bankappend.append(foobank);
                    }
                    selectoptioned.append(bankappend);
                });

                var stored  =   [];
                var inputs  =   $("input[name='debit_amount[]']");

                $("select[name='drcr[]']").on('change',function(){
                    var drInput   = $(this).closest('tr').find("td #dr-amt");
                    var crInput   = $(this).closest('tr').find("td #cr-amt");
                    var second    = continuedcount-1;
                    var titlename = "#account_title_"+second;
                    if($(this).val() == '1'){
                        var selectoptions = $(titlename);
                        var selectOptionVals = $('meta[name="account-list"]').attr('content');
                        var jsonParsed = JSON.parse(selectOptionVals);
                        selectoptions.empty();
                        for(var i = 0; i < jsonParsed.length; i++) {
                            selectoptions.append(
                                '<option value="'+ jsonParsed[i]['id'] +'">'+ jsonParsed[i]['name'] + '</option>'
                            );
                        }
                        drInput.attr('readonly',false);
                        drInput.attr('required','required');

                        crInput.attr('readonly',true);
                        crInput.removeAttr('required','required');

                    }else{
                        var selectoption = $(titlename);
                        var cashOptionVal = $('meta[name="account-list-cash"]').attr('content');
                        var bankOptionVal = $('meta[name="account-list-bank"]').attr('content');
                        var cashParse = JSON.parse(cashOptionVal);
                        var bankParse = JSON.parse(bankOptionVal);
                        selectoption.empty();
                        var cashappend =  $("<optgroup label='Cash'>");
                        for(var i = 0; i < cashParse.length; i++) {
                            var foocash = '<option value="'+ cashParse[i]['id'] +'">'+ cashParse[i]['name'] + '</option>';
                            cashappend.append(foocash);
                        }
                        selectoption.append(cashappend);

                        var bankappend =  $("<optgroup label='Bank'>");
                        for(var i = 0; i < bankParse.length; i++) {
                            var foobank = '<option value="'+ bankParse[i]['id'] +'">'+ bankParse[i]['name'] + '</option>';
                            bankappend.append(foobank);
                        }
                        selectoption.append(bankappend);
                        drInput.attr('readonly',true);
                        drInput.removeAttr('required','required');

                        crInput.attr('readonly',false);
                        crInput.attr('required','required');

                    }
                    drInput.val('0');
                    crInput.val('0');
                });

            }
            $('.delete-entry').click(function(){
                $(this).parent().parent().remove();
            });

            counter = counter +1;
            continuedcount = continuedcount + 1;
        });


        $('#submit_journal_entry').on('click', function(e){
            e.preventDefault();
            var debit = 0;
            var credit = 0;
            var one =0;
            $('input[name="credit_amount[]"]').each(function() {
                credit += parseInt($(this).val()) ;


            });

            $('input[name="debit_amount[]"]').each(function() {
                debit += parseInt($(this).val());

            });


            var data= '';
            var isDup = checkIfDuplicate();
            if(isDup){

                swal({
                    title: 'Journal Entry Warning',
                    text: isDup,
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });


            }

            if(credit===debit){

                $('input[name="total_amount"]').attr('value',credit);
                $('#journal-entry-form').submit();
            }else{

                swal({
                    title: 'Journal Entry Warning',
                    text: "Debit and Credit amount should be equal",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });


            }


        });
    </script>
@endsection
