@extends('layouts.processing_master')
@section('title') Applied Candidate @endsection
@section('css')
{{--    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/jquery-ui.min.css')}}">--}}
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/jquery.dataTables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/assets/responsive.dataTables.min.css')}}">
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }

        .custom-modal .modal-content {
            background-color: #f6f8f6;
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

        td.details-control:before {
            content: '\f0fe';
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 18px;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
        }
        tr.shown td.details-control:before {
            content: '\f146';
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: 18px;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
        }

        td.child-td {
            padding: 0!important;
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
                    <h3 class="page-title">Applied Candidate List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('processing')}}">Processing Dashboard</a></li>
                        <li class="breadcrumb-item active">
                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Applied Candidate
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item active text-white disabled" href="#" >Applied Candidates</a>
                                    <a class="dropdown-item" href="{{route('selected-candidate.index')}}" >Selected Candidates</a>
                                    <a class="dropdown-item" href="{{route('under-processing-candidate.index')}}" >Under-process Candidates</a>
                                    <a class="dropdown-item" href="{{route('visa.index')}}" >Visa-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('ticket-received-candidate.index')}}" >Ticket-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('deployed-candidate.index')}}" >Deployed Candidates</a>
                                    <a class="dropdown-item" href="{{route('rejected-candidate.index')}}" >Rejected Candidates</a>
                                    <a class="dropdown-item" href="{{route('cancelled-candidate.index')}}" >Cancelled Candidates</a>

                                </div>
                            </span>


                        </li>
                    </ul>
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

                    <table id="applied-index" class="table table-striped custom-table mb-0 display nowrap">
                        <thead>
                        <tr>
                            <th></th>
                            <th>S.N</th>
                            <th>Company Name</th>
                            <th>Number of candidates</th>
                            <th></th>
                        </tr>
                        </thead>
                        @php($i=1)
                        <tbody>
                        @foreach(@$data as $key=>$value)
                            <tr>
                                <td></td>
                                <td>{{$i}}.</td>
                                <td>{{$key}}</td>
                                <td>{{count($value)}}</td>
                                <td>
                                    <table class="table table-striped custom-table mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-right">Action</th>
                                            <th>Status</th>
                                            <th>Serial No.</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Passport No.</th>
                                            <th>Country Applied</th>
                                            <th>Applied Job Category</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(@$value as $applied)
                                            <tr>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo({{$applied}})" hrm-update-action="{{route('status.reapply',@$applied->id)}}"><i class="fa fa-pencil m-r-5"></i> Reapply </a>
                                                            <a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo({{$applied}})" hrm-update-action="{{route('status.rollback',@$applied->id)}}"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>

                                                            <a class="dropdown-item action-reject-date" href="#"  onclick="candidateInfo({{$applied}})" hrm-update-action="{{route('status.reject',@$applied->id)}}" hrm-status="rejected"><i class="fa fa-pencil m-r-5"></i> Reject </a>
                                                            <a class="dropdown-item action-cancel-date" href="#"  onclick="candidateInfo({{$applied}})" hrm-update-action="{{route('status.reject',@$applied->id)}}" hrm-status="cancelled"><i class="fa fa-pencil m-r-5"></i> Cancel </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">

                                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                            {{ucfirst($applied->personalInfo->status)}}
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item processing-status-update" hrm-update-action="{{route('applied-to-selected.update',@$applied->id)}}" onclick="candidateInfo({{$applied}})" href="#">Under Process</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$applied->personalInfo->serial_no}}</td>
                                                <td> {{ucwords(@$applied->personalInfo->candidate_firstname)}} {{ucwords(@$applied->personalInfo->candidate_middlename)}} {{ucwords(@$applied->personalInfo->candidate_lastname)}}</td>
                                                <td>{{ucwords(@$applied->personalInfo->gender)}}</td>
                                                <td>{{@$applied->personalInfo->passport_no}}</td>
                                                <td>{{\App\Models\DemandInformation::find($applied->demand_info_id)->countryState->country}}</td>
                                                <td>{{\App\Models\JobtoDemand::find($applied->job_to_demand_id)->jobCategory->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /Applied Candidate Table -->

    <!-- /Page Content -->

    <!-- Edit Sub Status Modal -->
{{--    @include('admin.modals.candidate.processing.applied.substatus')--}}
    <!-- /Edit Sub Status Modal -->

    <!-- Edit demand info -->
{{--    @include('admin.modals.candidate.processing.applied.demandinfo')--}}
    <!-- /Edit demand info -->

    <!-- One step back form info -->
    @include('admin.modals.candidate.processing.onestepback')
    <!-- /One step back form info -->

    <!-- Edit interview date -->
    @include('admin.modals.candidate.processing.applied.interview')
    <!-- /Edit interview date -->

    <!-- applied to selected form info -->
    @include('admin.modals.candidate.processing.applied.selectedform')
    <!-- /applied to selected form info -->

    <!-- applied to selected form info -->
    @include('admin.modals.candidate.processing.reject')
    <!-- /applied to selected form info -->

@endsection
@section('js')
    <script src="{{asset("backend/assets/jquery-ui.js")}}" ></script>
    <script src="{{asset("backend/assets/dataTables.responsive.min.js")}}" ></script>

    <script type="text/javascript">



        let demand = "";
        function candidateInfo(incomingdemand) {
            demand = incomingdemand;
        }

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#applied-index').DataTable( {
                ordering: false,
                lengthMenu: [[10, 25, 50, 100 , 500, -1], [10, 25, 50, 100 , 500, "All"]], responsive: {
                    details: {
                        renderer: function ( api, rowIdx, columns ) {
                            var data = $.map( columns, function ( col, i ) {
                                return col.hidden ?
                                    '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                    '<td class="child-td">'+col.data+'</td>'+
                                    '</tr>' :
                                    '';
                            } ).join('');

                            return data ?
                                $('<table/>').append( data ) :
                                false;
                        }
                    }
                }
            } );

            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
            $('.demand-applied-date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('.interview-date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('.visa_issued_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }
            else if(@$theme_data->default_date_format=='english'){ ?>
            $('.demand-applied-date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('.interview-date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }
            else{?>
            $('.demand-applied-date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('.interview-date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }?>
        });

        //ajax requests
        $(document).on('change','.demand-company-name', function (e) {
            e.preventDefault();
            var demand_id = $(this).children("option:selected").val();
            url = "{{route('candidate-info.getdemandcategory')}}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "POST",
                cache: false,
                data:{
                    demand_id: demand_id,
                },
                success: function(dataResult){
                    var options = '<option selected value disabled>Select Job Category</option>';
                    $.each( dataResult.response, function(key, value) {
                        options += '<option value="'+key+'">'+value+'</option>';
                    });
                    $('.job_to_demand_cat').attr("required", "required");
                    $('#applied_job_to_demand_id').html(options);

                },
                error: function() {
                    swal({
                        title: 'Demand details Info',
                        text: "Error. Could not confirm the status of the Job category.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        });

        //end of ajax requests

        $(document).on('click','.processing-status-update', function (e) {
            e.preventDefault();
            $("#applied_to_selected").modal("toggle");
            var action = $(this).attr('hrm-update-action');
            $('.updateselected').attr('action',action);
            var demand_id = demand.demand_info_id;
            var job_id = demand.job_to_demand_id;
            getDemandRelatedCat(demand_id, job_id);
            $('#applied_receivable_salary').attr('value',demand.receivable_salary);
            $('#demand_job_infos_id').attr('value',demand.id);
            $('#candidate_personal_information_id').attr('value',demand.candidate_personal_information_id);
            $('#applied_status_applied_date').attr('value',demand.status_applied_date);
            $('#applied_sub_status option[value="'+demand.sub_status_id+'"]').prop('selected', true);
            $('#applied_demand_info_id option[value="'+demand.demand_info_id+'"]').prop('selected', true);
            $('#applied_remarks').text(demand.remarks);
        });

        function getDemandRelatedCat(demand_id,job_id){
            url = "{{route('candidate-info.getdemandcategory')}}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "POST",
                cache: false,
                data:{
                    demand_id: demand_id,
                },
                success: function(dataResult){
                    var options = '<option selected disabled>Select Job Category</option>';
                    $.each( dataResult.response, function(key, value) {
                        options += '<option value="'+key+'">'+value+'</option>';
                    });
                    $('.job_to_demand_cat').html(options);
                    $('#applied_job_to_demand_id option[value="'+job_id+'"]').prop('selected', true);
                },
                error: function() {
                    swal({
                        title: 'Demand details Info',
                        text: "Error. Could not confirm the status of the Job category.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        }

        $(document).on('click','.action-rollback-onestep, .action-reapply-status', function (e) {
            e.preventDefault();
            $("#one_step_back_modal").modal("toggle");
            var action    = $(this).attr('hrm-update-action');
            var job_id    = demand.job_to_demand_id;
            var demand_id = demand.demand_info_id;
            $('#candidate_personal_information_id_rollback').attr('value',demand.candidate_personal_information_id);
            $('#demand_info_id_rollback').attr('value',demand_id);
            $('#job_to_demand_id_rollback').attr('value',job_id);
            $('#current_status').attr('value',demand.personal_info.status);
            $('.onestepbackform').attr('action',action);
        });

        $(document).on('click','.action-reject-date, .action-cancel-date', function (e) {
            e.preventDefault();
            $("#one_reject_modal").modal("toggle");
            var action       = $(this).attr('hrm-update-action');
            var new_status   = $(this).attr('hrm-status');
            if(new_status == "rejected"){
                $('#modal-reject').text("Reject Candidate");
            }else{
                $('#modal-reject').text("Cancel Candidate");
            }
            var job_id       = demand.job_to_demand_id;
            var demand_id    = demand.demand_info_id;
            $('#candidate_personal_information_id_reject').attr('value',demand.candidate_personal_information_id);
            $('#demand_info_id_reject').attr('value',demand_id);
            $('#job_to_demand_id_reject').attr('value',job_id);
            $('#current_status_reject').attr('value',new_status);
            $('.rejectcandidate').attr('action',action);
        });


    </script>
@endsection
