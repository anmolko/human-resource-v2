@extends('layouts.account_master')
@section('title') Create Journal Entry @endsection
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


    .scrollbar
    {
        height: 150px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* .force-overflow
    {
        min-height: 450px;
    } */

    table.table.table-striped.custom-table.force-overflow tbody.row tr > td {
    border-top: none;
    }
    .attribute-side-by{
        display: flex;
        justify-content: space-between;
    }

    /*
    *  STYLE 1
    */

    #style-1::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    #style-1::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    #style-1::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
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
                <div class="col">
                    <h3 class="page-title">Create Journal Entry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('journal-entry.index')}}">Journal Entry</a></li>
                        <li class="breadcrumb-item active">Create Journal Entry</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_secondary_group"><i class="fa fa-plus"></i> Add Secondary Group</a>
                </div>


            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <form method="post" action="{{route('journal-entry.store')}}" id="journal-entry-form" class="needs-validation" novalidate=""> -->
                        {!! Form::open(['method'=>'post','route'=>'journal-entry.store','id'=>'journal-entry-form','class'=>'needs-validation','novalidate'=>'']) !!}
                       <!-- @csrf -->
                            <div class="row">
                                <div class="col-sm-6 m-b-20">
                                    <div class="">
                                    <?php
                                     $ref = 'JRN-'.str_pad(time() + 1, 8, "0", STR_PAD_LEFT); ?>
                                        <h4 class="text-uppercase">Reference no. {{$ref}}</h4>
                                            <input class="form-control" type="hidden" value="{{$ref}}" name="ref_no" readonly="">
                                            <input class="form-control" type="hidden" name="total_amount" readonly="">

                                        <ul class="list-unstyled">
                                            <li>Transaction Date:</li>
                                            <div class="cal-icon">
                                                <input class="form-control" id="datetimepicker" name="date" type="text" required>
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
                                <table class="table table-hover table-white journal-entries">
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
                                    <tr>

                                        <td>
                                            <select class="custom-select form-control" name="drcr[]" id="">
                                                <option value="1">Debit</option>
                                                <option value="2">Credit</option>
                                            </select>
                                        </td>

                                        <td>
                                            <select  class="custom-select form-control" id="select_particulars" name="account_title[]" style="width: 300px" required>
                                            <option value disabled selected> Select Particulars</option>
                                            @foreach($secondaryvalue as $value)
                                                <option value="{{$value->id}}">{{ucwords($value->name)}} </option>
                                            @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a particulars name.
                                            </div>


                                        </td>
                                        <td>

                                            <input class="form-control"  style="min-width:100px" name="debit_amount[]" type="number" min="0" step="0.01" id="dr-amt" placeholder="0.00" required>
                                            <div class="invalid-feedback">
                                                Please enter a debit amount.
                                            </div>
                                        </td>

                                        <td>
                                            <input class="form-control" style="min-width:100px" name="credit_amount[]" type="number" id="cr-amt" placeholder="0.00" value="0" readonly="">
                                            <div class="invalid-feedback">
                                                Please enter a credit amount.
                                            </div>
                                        </td>
                                        <td><a href="javascript:void(0)" class="text-success font-18 add-entry" title="Add"><i class="fa fa-plus"></i></a></td>
                                    </tr>

                                        <!-- <td><a href="javascript:void(0)" class="text-danger font-18" title="Remove"><i class="fa fa-trash-o"></i></a></td> -->
                                    </tbody>
                                </table>
                            </div>

                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Narration <span>*</span></label>
                                            <textarea class="form-control" name="narration" id="narration" rows="4" required></textarea>
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
                                <button class="btn btn-primary submit-btn" id="submit_journal_entry"  >Save</button>
                            </div>
                    {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Secondary Group Modal -->
    @include('admin.modals.secondary_groups.add')
    <!-- /Add Secondary Group Modal -->

@endsection
@section('js')
<script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $("#slug").val(Text);
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

            $( "select[name='account_title[]']" ).select2({
                width: 'style',
            });
    });



      $("select[name='drcr[]']").on('change',function(){
        var drInput = $(this).closest('tr').find("td #dr-amt");
        var crInput = $(this).closest('tr').find("td #cr-amt");
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
        $('.journal-entries tbody').find('tr').each(function(rowIndex, r){
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
      $(document).on('click', '.add-entry', function(){

        var selectOptionVal = $('meta[name="account-list"]').attr('content');
        var jsonParse = JSON.parse(selectOptionVal);
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
          $('.journal-entries tbody').append(
            '<tr>' +
               '<td>' +
                  '<select class="custom-select form-control" name="drcr[]" id="">' +
                     '<option value="1">Debit</option>' +
                     '<option value="2" selected>Credit</option>' +
                  '</select>' +
               '</td> ' +
               '<td>' +
                  '<select class="custom-select form-control" name="account_title[]" style="width: 300px" id="select_particular_'+ counter +'">' +
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
          var one = 'select_particular_'+counter;
          dynamicselect(one);




          $('.journal-entries tr:last td').each(function(){

              // console.log('last table');
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


            // $(select_title).select2({
            //     tags: false,
            //     allowClear: true,
            //     placeholder: 'To : Select or Write',
            //     tokenSeparators: [',', ' '],
            //     createTag: function () {
            //         // Disable tagging
            //         return null;
            //     }
            // });

          var stored  =   [];
          var inputs  =   $("input[name='debit_amount[]']");

          if(counter==0){

            $('.journal-entries tr:last td').each(function(){
                // console.log('last table');
                var selectTitle = $(this).find('input');
                if(selectTitle.attr('name')){
                if(selectTitle.attr('name') == 'credit_amount[]'){

                        $.each(inputs,function(k,v){
                                var getVal  =   $(v).val();
                                if(k==0){
                                    selectTitle.attr('value',getVal);

                                }

                        });
                }
                }
            });

          }

          $("select[name='drcr[]']").on('change',function(){
            var drInput = $(this).closest('tr').find("td #dr-amt");
            var crInput = $(this).closest('tr').find("td #cr-amt");
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

      });

      $('#submit_journal_entry').on('click', function(e){
        e.preventDefault();
        var debit = 0;
        var credit = 0;
        var one =0;


        var date = $('#datetimepicker').val();
        var narration = $('#narration').val();
        if(date == "" || date == null || date == "undefined"){
            swal({
                title: 'Journal Entry Warning',
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
                title: 'Journal Entry Warning',
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
            title: 'Journal Entry Warning',
            text: isDup,
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            });


        }else{
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

        }



      });


      function dynamicselect(data){
          $('#'+data).select2({
              width: 'style',
          });
      }

</script>
@endsection
