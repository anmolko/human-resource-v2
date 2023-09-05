@extends('layouts.account_master')
@section('title') Edit Contra Voucher @endsection
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
        .select2-results{
            text-transform: capitalize;
        }
        .select2-selection__rendered{
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
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Edit Contra Voucher</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('contra-voucher.index')}}">Contra Voucher</a></li>
                        <li class="breadcrumb-item active">Edit Contra Voucher</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['method'=>'put','route'=>['contra-voucher.update', $editcontraentries->id],'id'=>'contra-entry-form','class'=>'needs-validation','novalidate'=>'']) !!}
                        <div class="row">
                            <div class="col-sm-6 m-b-20">
                                <div class="">
                                    <h4 class="text-uppercase">Voucher no. {{@$editcontraentries->ref_no}}</h4>
                                    <input class="form-control" type="hidden" value="{{$editcontraentries->ref_no}}" name="ref_no" readonly="">
                                    <input class="form-control" type="hidden" name="total_amount" value="{{$editcontraentries->total_amount}}">

                                    <ul class="list-unstyled">
                                        <li>Transaction Date:</li>
                                        <div class="cal-icon">
                                            <input class="form-control" id="datetimepicker" name="date" value="{{@$editcontraentries->date}}" type="text" required>

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
                            <table class="table table-hover table-white contra-entries">
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
                                @if(!empty(@$editcontraentries))
                                    @foreach(@$editcontraentries->contraParticulars as $contraparticulars)
                                        <input class="form-control" type="hidden" name="particular_id[]" value="{{$contraparticulars->id}}">
                                        <tr>
                                            <td>
                                                <select class="custom-select form-control" name="drcr[]" id="<?php echo $count; ?>">
                                                    <?php if(@$contraparticulars->to_credit_id != null){ ?>
                                                    <option value="2" <?php if(@$contraparticulars->to_credit_id != null)  echo "selected"; ?>>Credit</option>
                                                    <?php } ?>
                                                    <?php if(@$contraparticulars->by_debit_id != null){ ?>
                                                    <option value="1" <?php if(@$contraparticulars->by_debit_id != null) echo "selected"; ?>>Debit</option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <?php
                                            if(@$contraparticulars->to_credit_id != null){ ?>
                                            <td>
                                                <select  class="custom-select form-control" name="account_title[]" style="width: 300px" id="account_title_<?php echo $count; ?>" required>
                                                    @foreach($secondaryvalue as $value)
                                                        <?php if(@$contraparticulars->to_credit_id == $value->id){ ?>
                                                        <option value="{{$value->id}}" <?php if(@$contraparticulars->to_credit_id == $value->id) echo "selected"; ?>>{{ucwords($value->name)}} </option>
                                                        <?php } ?>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a particulars name.
                                                </div>
                                            </td>

                                            <?php } ?>

                                            <?php
                                            if(@$contraparticulars->by_debit_id != null){ ?>
                                            <td>
                                                <select  class="custom-select form-control" name="account_title[]" style="width: 300px" id="account_title_<?php echo $count; ?>" required>
                                                    @foreach($secondaryvalue as $value)
                                                        <?php if(@$contraparticulars->by_debit_id == $value->id){ ?>
                                                        <option value="{{$value->id}}" <?php if(@$contraparticulars->by_debit_id == $value->id) echo "selected"; ?>>{{ucwords($value->name)}} </option>
                                                        <?php } ?>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select a particulars name.
                                                </div>
                                            </td>

                                            <?php } ?>

                                            <td>

                                                <input class="form-control"  style="min-width:100px" name="debit_amount[]" type="number" min="0" step="0.01" id="dr-amt" placeholder="0.00" value="{{$contraparticulars->debit_amount}}" <?php if($contraparticulars->debit_amount==0) echo "readonly";?> required>
                                                <div class="invalid-feedback">
                                                    Please enter a debit amount.
                                                </div>
                                            </td>

                                            <td>
                                                <input class="form-control" style="min-width:100px" name="credit_amount[]" type="number" id="cr-amt" placeholder="0.00"  value="{{$contraparticulars->credit_amount}}" required <?php if($contraparticulars->credit_amount==0) echo "readonly";?>>
                                                <div class="invalid-feedback">
                                                    Please enter a credit amount.
                                                </div>
                                            </td>
                                            <?php
                                            // last iteration
                                            if( $count == count( $editcontraentries->contraParticulars ) - 1) { ?>
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
                                        <textarea class="form-control" name="narration" id="narration" rows="4" required>{{@$editcontraentries->narration}}</textarea>
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
                            <button class="btn btn-primary submit-btn" id="submit_contra_entry" >Update</button>
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

            var from = "<?php echo $company_data->from ?>";
            var to = "<?php echo $company_data->to ?>";
            <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                disableBefore: from,
                disableAfter: to,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            <?php }else if(@$theme_data->default_date_format=='english'){ ?>


            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: from,
                maxDate: to
            })

            <?php }else{?>
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: from,
                maxDate: to
            })

            <?php }?>

        });

        $("select[name='drcr[]']").on('change',function(){
            var drInput = $(this).closest('tr').find("td #dr-amt");
            var crInput = $(this).closest('tr').find("td #cr-amt");
            var count = $(this).attr('id');
            var titlename = "#account_title_"+count;
            if($(this).val() == '1'){
                drInput.attr('readonly',false);
                drInput.attr('required','required');

                crInput.attr('readonly',true);
                crInput.removeAttr('required','required');

            }else{
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
            $('.contra-entries tbody').find('tr').each(function(rowIndex, r){
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
            });
            return is_duplicate;
        }


        var counter =0;
        var continuedcount = <?php echo $count ?>;
        $(document).on('click', '.add-entry', function(){
            var isDuplicate = checkIfDuplicate();
            var selectOptionVal = $('meta[name="account-list"]').attr('content');
            var jsonParse = JSON.parse(selectOptionVal);
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
                $('.contra-entries tbody').append(
                    '<tr>' +
                    '<td>' +
                    '<select class="custom-select form-control" name="drcr[]" id="'+ continuedcount +'">' +
                    '<option value="1" selected>Debit</option>' +
                    '<option value="2">Credit</option>' +
                    '</select>' +
                    '</td> ' +
                    '<td>' +
                    '<select class="custom-select form-control" name="account_title[]" style="width: 300px" id="account_title_'+ continuedcount +'">' +
                    '</select>' +
                    '</td>' +
                    '<td>' +
                    '<input class="form-control"  style="min-width:100px" name="debit_amount[]" type="number" min="0" step="0.01" id="dr-amt" placeholder="0.00" value="0" required>' +
                    '<div class="invalid-feedback">'+
                    'Please enter a debit amount.'+
                    '</div>'+
                    '</td>' +
                    '<td>' +
                    '<input class="form-control" style="min-width:100px" name="credit_amount[]" type="number" id="cr-amt" placeholder="0.00" value="0" readonly="" >' +
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
                var one = 'account_title_'+continuedcount;
                dynamicselect(one);


                $('.contra-entries tr:last td').each(function(){
                    var selectTitle = $(this).find('select');
                    if(selectTitle.attr('name')){
                        if(selectTitle.attr('name') == 'account_title[]'){
                            for(var i = 0; i < jsonParse.length; i++) {
                                selectTitle.append($('<option>',{
                                    value: jsonParse[i]['id'],
                                    text: jsonParse[i]['name']
                                }));
                            }
                        }
                    }
                });

                var stored  =   [];
                var inputs  =   $("input[name='debit_amount[]']");

                $("select[name='drcr[]']").on('change',function(){
                    var drInput   = $(this).closest('tr').find("td #dr-amt");
                    var crInput   = $(this).closest('tr').find("td #cr-amt");
                    if($(this).val() == '1'){
                        drInput.attr('readonly',false);
                        drInput.attr('required','required');

                        crInput.attr('readonly',true);
                        crInput.removeAttr('required','required');

                    }else{
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


        $('#submit_contra_entry').on('click', function(e){
            e.preventDefault();
            var debit = 0;
            var credit = 0;
            var one =0;

            var date = $('#datetimepicker').val();
            var narration = $('#narration').val();
            if(date == "" || date == null || date == "undefined"){
                swal({
                    title: 'Contra Voucher Warning',
                    text: "Please select the transaction date to proceed",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
                return;
            }

            if(narration == "" || narration == null || narration == "undefined"){
                swal({
                    title: 'Contra Voucher Warning',
                    text: "Please write the narration to proceed",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
                return;
            }

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
                    title: 'Contra Voucher Warning',
                    text: isDup,
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                });
            }else{
                if(credit===debit){
                    $('input[name="total_amount"]').attr('value',credit);
                    $('#contra-entry-form').submit();
                }else {
                    swal({
                        title: 'Contra Voucher Warning',
                        text: "Debit and Credit amount should be equal",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            }
        });

        function dynamicselect(data){
            $('#'+data).select2({
                width: 'style',
            });
        }
    </script>
@endsection
