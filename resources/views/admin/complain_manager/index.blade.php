@extends('layouts.master')
@section('title') Complain Manager @endsection
@section('css')
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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

        .middle{
            margin: 0 auto;
            text-align: center;
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

    @if($errors->has('name'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('name')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Complain Manager</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Complain Manager</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_complain"><i class="fa fa-plus"></i> Add Complain </a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('complain-manager.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                            <a class="nav-link active" data-toggle="tab" href="#tab_pending">Pending</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_solved">Solved</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Tab -->

        <!-- Tab Content -->
        <div class="tab-content">

            <!-- Pending Tab -->
            <div class="tab-pane show active" id="tab_pending">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form action="#" method="post" id="deleted-form" >
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="delete">

                            </form>
                            <!-- Complain Manager Table -->
                            <table id="complain-manager-index" class="table table-striped custom-table mb-0 ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Candidate Name</th>
                                    <th>Passport number</th>
                                    <th>Job Category</th>
                                    <th>Company</th>
                                    <th>Assignee</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($pending_complain as $complain)
                                    <tr>
                                        <td> {{$i++}} </td>
                                        <td><a href="{{route('candidate-personal-info.addalldetails',$complain->candidate_info_id)}}">{{ucwords(\App\Models\CandidatePersonalInformation::find($complain->candidate_info_id)->candidate_firstname)}} {{ucwords(\App\Models\CandidatePersonalInformation::find($complain->candidate_info_id)->candidate_lastname)}}</a></td>
                                        <td>{{ucwords(@$complain->passport_num)}}</td>
                                        <td>{{ucwords(@$complain->job_category)}}</td>
                                        <td>{{ucwords(@$complain->company)}}</td>
                                        <td>{{ucwords(@\App\Models\Employee::find($complain->employee_id)->user->name)}}</td>
                                        <td class="text-right">
                                            <div class="flex-shrink-0 ms-4">
                                                <ul class="list-inline tasks-list-menu mb-0">
                                                    <li class="list-inline-item">
                                                        <a class="action-edit" href="#" id="{{@$complain->id}}" hrm-view-action="{{route('complain-manager.show',$complain->id)}}" data-toggle="modal" data-target="#view_complain_manager">
                                                            <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                                    <li class="list-inline-item">
                                                        <a class="action-edit" href="#"  id="{{@$complain->id}}" hrm-update-action="{{route('complain-manager.update',@$complain->id)}}"  hrm-edit-action="{{route('complain-manager.edit',@$complain->id)}}" data-toggle="modal">
                                                            <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                                    <li class="list-inline-item">
                                                        <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('complain-manager.destroy',@$complain->id)}}" >
                                                            <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                            <!-- /Complain Manager Table -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- Additions Tab -->

            <!-- Pending Tab -->
            <div class="tab-pane" id="tab_solved">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form action="#" method="post" id="deleted-form" >
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="delete">

                            </form>
                            <!-- Complain Manager Table -->
                            <table id="complain-manager-solved" class="table table-striped custom-table mb-0 ">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Candidate Name</th>
                                    <th>Passport number</th>
                                    <th>Job Category</th>
                                    <th>Company</th>
                                    <th>Assignee</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($solved_complains as $complain)
                                    <tr>
                                        <td> {{$i++}} </td>
                                        <td><a href="{{route('candidate-personal-info.addalldetails',$complain->candidate_info_id)}}">{{ucwords(\App\Models\CandidatePersonalInformation::find($complain->candidate_info_id)->candidate_firstname)}} {{ucwords(\App\Models\CandidatePersonalInformation::find($complain->candidate_info_id)->candidate_lastname)}}</a></td>
                                        <td>{{ucwords(@$complain->passport_num)}}</td>
                                        <td>{{ucwords(@$complain->job_category)}}</td>
                                        <td>{{ucwords(@$complain->company)}}</td>
                                        <td>{{ucwords(@\App\Models\Employee::find($complain->employee_id)->user->name)}}</td>
                                        <td class="text-right">
                                            <div class="flex-shrink-0 ms-4">
                                                <ul class="list-inline tasks-list-menu mb-0">
                                                    <li class="list-inline-item">
                                                        <a class="action-edit" href="#" id="{{@$complain->id}}" hrm-view-action="{{route('complain-manager.show',$complain->id)}}" data-toggle="modal" data-target="#view_complain_manager">
                                                            <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                                    <li class="list-inline-item">
                                                        <a class="action-edit" href="#" id="{{@$complain->id}}" hrm-update-action="{{route('complain-manager.update',@$complain->id)}}"  hrm-edit-action="{{route('complain-manager.edit',@$complain->id)}}" data-toggle="modal">
                                                            <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                                    <li class="list-inline-item">
                                                        <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('complain-manager.destroy',@$complain->id)}}"  >
                                                            <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                                </ul>
                                            </div>

                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                            <!-- /Complain Manager Table -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Solved Tab -->

        </div>
        <!-- Tab Content -->




    </div>
    <!-- /Page Content -->

    <!-- Add Complain Manager Modal -->
    @include('admin.modals.complain_manager.add')
    <!-- /Add Complain Manager Modal -->

    <!-- view Complain Manager Modal -->
    @include('admin.modals.complain_manager.view')
    <!-- /view Complain Manager Modal -->

    <!-- edit Complain Manager Modal -->
    @include('admin.modals.complain_manager.edit')
    <!-- /edit Complain Manager Modal -->

    <!-- Forbidden Complain Manager Modal -->
    @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Complain Manager Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#complain-manager-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
            $('#complain-manager-solved').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });


            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
                $('#solved_datepicker').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });

            $('#solved_datepicker-edit').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

                $('#regd_datepicker').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
            $('#regd_datepicker-edit').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            <?php }
            else if(@$theme_data->default_date_format=='english'){ ?>
                $('#solved_datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#regd_datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            $('#solved_datepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#regd_datepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }
            else{?>
                $('#solved_datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#regd_datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            $('#solved_datepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#regd_datepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }?>
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
                    $("#edit_complain_manager").modal("toggle");
                    $('#candidate_info_id option[value="'+dataResult.edit.candidate_info_id+'"]').prop('selected', true);

                    $('#passport_num').attr('value',dataResult.edit.passport_num);
                    if(dataResult.edit.job_category !== null){
                        $('#job_category').attr('value',dataResult.edit.job_category);
                    }
                    $('#company').attr('value',dataResult.edit.company);
                    $('#contact_person').attr('value',dataResult.edit.contact_person);
                    if(dataResult.edit.regd_by !== null){
                        $('#regd_by').attr('value',dataResult.edit.regd_by);
                    }
                    $('#employee_id option[value="'+dataResult.edit.employee_id+'"]').prop('selected', true);
                    $('#type option[value="'+dataResult.edit.type+'"]').prop('selected', true);
                    $('#status option[value="'+dataResult.edit.status+'"]').prop('selected', true);
                    var value = dataResult.edit.priority;
                    if(value===1){
                        $(".priority1").prop('checked',true);
                    }
                    else if(value===2){
                        $(".priority2").prop('checked',true);

                    }else if(value===3){
                        $(".priority3").prop('checked',true);

                    }else if(value===4){
                        $(".priority4").prop('checked',true);

                    }else if(value===5){
                        $(".priority5").prop('checked',true);
                    }
                    $('#subject').text(dataResult.edit.subject);
                    $('#message').text(dataResult.edit.message);
                    $('.update_regd_date').attr('value',dataResult.edit.regd_date);
                    if(dataResult.edit.solved_date !== null){
                        $('.update_solved_date').attr('value',dataResult.edit.solved_date);
                    }


                    $('.updatecomplainmanager').attr('action',action);

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
                    $('#view_reference_no').text(dataResult.show.reference_no);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.show.country){
                            $('#view_country').text(value);
                        }
                    });

                    $('#view_country_state_id').text(dataResult.show.country_state.state);

                    if(dataResult.show.country_one !== null) {
                        $.each(dataResult.countries, function (index, value) {
                            if (index == dataResult.show.country_one) {
                                $('#view_country_one').text(value);
                            }
                        });
                    }else{
                        $('#view_country_one').text("N/A");
                    }
                    if(dataResult.show.transaction !== null) {
                        $('#view_transaction').text(dataResult.show.transaction);
                    }else{
                        $('#view_transaction').text("N/A");
                    }
                    if(dataResult.show.total_cost !== null) {
                        $('#view_total_cost').text(dataResult.show.total_cost);
                    }else{
                        $('#view_total_cost').text("N/A");
                    }
                    if(dataResult.show.remarks !== null) {
                        $('#view_remarks').text(dataResult.show.remarks);
                    }else{
                        $('#view_remarks').text("N/A");
                    }
                    if(dataResult.show.country_two !== null) {
                        $.each(dataResult.countries, function (index, value) {
                            if (index == dataResult.show.country_two) {
                                $('#view_country_two').text(value);
                            }
                        });
                    }else{
                        $('#view_country_two').text("N/A");
                    }

                    if(dataResult.show.country_three !== null) {
                        $.each(dataResult.countries, function (index, value) {
                            if (index == dataResult.show.country_three) {
                                $('#view_country_three').text(value);
                            }
                        });
                    }else{
                        $('#view_country_three').text("N/A");
                    }

                    // $('#view_address').text(dataResult.show.address);

                }
            });
        });



    </script>
@endsection
