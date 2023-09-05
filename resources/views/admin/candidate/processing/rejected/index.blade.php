@extends('layouts.processing_master')
@section('title') Rejected Candidate @endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/jquery-ui.min.css')}}">

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
                    <h3 class="page-title">Rejected Candidate List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('processing')}}">Processing Dashboard</a></li>
                        <li class="breadcrumb-item active">
                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Rejected Candidate
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('applied-candidate.index')}}" >Applied Candidates</a>
                                    <a class="dropdown-item" href="{{route('selected-candidate.index')}}" >Selected Candidates</a>
                                    <a class="dropdown-item" href="{{route('under-processing-candidate.index')}}" >Under-process Candidates</a>
                                    <a class="dropdown-item" href="{{route('visa.index')}}" >Visa-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('ticket-received-candidate.index')}}" >Ticket-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('deployed-candidate.index')}}" >Deployed Candidates</a>
                                    <a class="dropdown-item active text-white disabled" href="{{route('rejected-candidate.index')}}" >Rejected Candidates</a>
                                    <a class="dropdown-item" href="{{route('cancelled-candidate.index')}}" >Cancelled Candidates</a>
                                </div>
                            </span>


                        </li>
                    </ul>
                </div>
                {{--                <div class="col-auto float-right ml-auto">--}}
                {{--                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_complain"><i class="fa fa-plus"></i> Add Complain </a>--}}
                {{--                </div>--}}
                {{--                <div class="col-auto float-right ml-auto">--}}
                {{--                    <a href="{{route('complain-manager.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>--}}
                {{--                </div>--}}
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

                    <table id="reject-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Company Name</th>
                            <th>Number of candidates</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(@$data as $key=>$value)
                            <tr data-child-value="{{json_encode($value)}}">
                                <td class="details-control text-primary text-center"></td>
                                <td>{{$key}}</td>
                                <td>{{count($value)}}</td>
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
    <script type="text/javascript">
        var demanddata = <?php echo json_encode($data); ?>;
        let demand = "";
        function candidateInfo(demandid) {
            $.each(demanddata, function( index, values ) {
                $.each(values, function( index, value ) {
                    if(value.id == demandid){
                        demand = value;
                    }

                });
            });
        }

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function format(mainvalue) {
                var inner_table = '<table class="child_row-verified table-responsive table table-striped table-bordered nowrap">' +
                    '<thead>' +
                    '<tr> ' +
                    '<th>Serial No.</th> ' +
                    '<th>Name</th> ' +
                    '<th>Gender</th> ' +
                    '<th>Passport No.</th> ' +
                    '<th>Country Applied</th> ' +
                    '<th>Company Name</th> ' +
                    '<th>Applied Job Category</th> ' +
                    '<th>Status</th> ' +
                    '<th class="text-right">Action</th> ' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';

                $.each(mainvalue, function( index, value ) {
                    var fname  = value.personal_info.candidate_firstname ? value.personal_info.candidate_firstname:"";
                    var mname  = value.personal_info.candidate_middlename ? " "+value.personal_info.candidate_middlename:"";
                    var lname  = value.personal_info.candidate_lastname ? " "+value.personal_info.candidate_lastname:"";

                    var status = ' <div class="dropdown"> ' +
                        '<button class="btn btn-white btn-sm btn-rounded  text-capitalize"> ' +
                          value.personal_info.status +
                        '</button> ';

                    var action = '<div class="dropdown dropdown-action">' +
                        '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a> ' +
                        '<div class="dropdown-menu dropdown-menu-right">' +
                        '<a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo('+ value.id +')" hrm-update-action="/status-reapply-update/'+ value.id +'/"><i class="fa fa-pencil m-r-5"></i> Reapply </a>' +
                        '</div> ' +
                        '</div>';


                    inner_table += '<td>' +
                        value.personal_info.serial_no + '</td>' +
                        '<td class="text-capitalize">'+ fname + mname + lname +'</td>' +
                        '<td class="text-capitalize">' + value.personal_info.gender +'</td>' +
                        '<td>' + value.personal_info.passport_no + '</td>' +
                        '<td class="text-capitalize">' + value.demand_info.country_state.country + '</td>' +
                        '<td class="text-capitalize">' + value.demand_info.company_name + '</td>' +
                        '<td class="text-capitalize">' + value.jobto_demand.job_category.name + '</td>' +
                        '<td>' + status + '</td>' +
                        '<td class="text-right">' + action + '</td></tr>';
                });

                return inner_table;
            }

            all_applied();
            function all_applied(){
                var table = $('#reject-index').DataTable({
                    "orderable": false,
                    "bSort" : false,
                    lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

                });

                // for candidates
                $('#reject-index tbody').off('click', 'td.details-control');
                $('#reject-index tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row( tr );

                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child(format(tr.data('child-value'))).show();
                        tr.addClass('shown');
                    }
                } );
            }


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

        $(document).on('click','.action-reapply-status', function (e) {
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

    </script>
@endsection
