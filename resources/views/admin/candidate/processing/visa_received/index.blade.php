@extends('layouts.processing_master')
@section('title') Visa Received Candidate @endsection
@section('css')
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
                    <h3 class="page-title">Visa Received Candidate List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('processing')}}">Processing Dashboard</a></li>
                        <li class="breadcrumb-item active">


                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                   Visa Received Candidate
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('applied-candidate.index')}}" >Applied Candidates</a>
                                    <a class="dropdown-item" href="{{route('selected-candidate.index')}}" >Selected Candidates</a>
                                    <a class="dropdown-item" href="{{route('under-processing-candidate.index')}}" >Under-process Candidates</a>
                                    <a class="dropdown-item active text-white disabled" href="#" >Visa-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('ticket-received-candidate.index')}}" >Ticket-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('deployed-candidate.index')}}" >Deployed Candidates</a>
                                    <a class="dropdown-item" href="{{route('rejected-candidate.index')}}" >Rejected Candidates</a>
                                    <a class="dropdown-item" href="{{route('cancelled-candidate.index')}}" >Cancelled Candidates</a>
                                </div>
                            </span>

                        </li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn visa-multiple"><i class="fa fa-plus"></i> Issue Multiple Ticket</a>
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
                    <!-- Visa Received Candidate Table -->

                    <table id="visa-process-index" class="table table-striped custom-table mb-0 display nowrap">
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
                                    <table class="table table-striped custom-table mb-0 ">
                                        <thead>
                                        <tr>
                                            <th class="text-right">Action</th>
                                            <th>Status</th>
                                            <th>Serial No.</th>
                                            <th>Name</th>
                                            <th>Gender</th>
                                            <th>Passport No.</th>
                                            <th>Country Applied</th>
                                            <th>Company Name</th>
                                            <th>Job Category</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(@$value as $visa)
                                            <tr>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo({{$visa}})" hrm-update-action="{{route('status.rollback',@$visa->id)}}"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>
                                                            <a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo({{$visa}})" hrm-update-action="{{route('status.reapply',@$visa->id)}}"><i class="fa fa-pencil m-r-5"></i> Reapply </a>
                                                            <a class="dropdown-item action-reject-date" href="#"  onclick="candidateInfo({{$visa}})" hrm-update-action="{{route('status.reject',@$visa->id)}}" hrm-status="rejected"><i class="fa fa-pencil m-r-5"></i> Reject </a>
                                                            <a class="dropdown-item action-cancel-date" href="#"  onclick="candidateInfo({{$visa}})" hrm-update-action="{{route('status.reject',@$visa->id)}}" hrm-status="cancelled"><i class="fa fa-pencil m-r-5"></i> Cancel </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">

                                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                            {{ucfirst(str_replace("-"," ",$visa->personalInfo->status))}}
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item ticket-individual-update" href="#" onclick="candidateInfo({{$visa}})">Individual Ticket</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$visa->personalInfo->serial_no}}</td>
                                                <td> {{ucwords(@$visa->personalInfo->candidate_firstname)}} {{ucwords(@$visa->personalInfo->candidate_middlename)}} {{ucwords(@$visa->personalInfo->candidate_lastname)}}</td>
                                                <td>{{ucwords(@$visa->personalInfo->gender)}}</td>
                                                <td>{{@$visa->personalInfo->passport_no}}</td>
                                                <td>{{\App\Models\DemandInformation::find($visa->demand_info_id)->countryState->country}}</td>
                                                <td>{{ucwords($visa->demandInfo->company_name)}}</td>
                                                <td>{{\App\Models\JobtoDemand::find($visa->job_to_demand_id)->jobCategory->name}}</td>
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
    <!-- /Page Content -->

    <!-- One step back form info -->
    @include('admin.modals.candidate.processing.onestepback')
    <!-- /One step back form info -->

    <!-- individual ticketing form info -->
   @include('admin.modals.candidate.processing.visa_received.individualticketing')
    <!-- /individual ticketing form info -->

    <!-- multiple Visa form info -->
{{--    @include('admin.modals.candidate.processing.underprocess.multiplevisa')--}}
    <!-- /multiple Visa form info -->

    <!-- multiple Visa form info -->
{{--    @include('admin.modals.candidate.processing.underprocess.visastamp')--}}
    <!-- /multiple Visa form info -->

    @include('admin.modals.candidate.processing.reject')


@endsection
@section('js')
    <script src="{{asset("backend/assets/jquery-ui.js")}}" ></script>
    <script src="{{asset("backend/assets/dataTables.responsive.min.js")}}" ></script>
    <script type="text/javascript">
        let demand = "";
        function candidateInfo(candemand) {
            demand = candemand;
        }
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#visa-process-index').DataTable( {
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

            $("#booking_time_in").datetimepicker({
                format: "LT"
            });

            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
            $('.booking_date').nepaliDatePicker({
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
            $('#visa_issued_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#visa_expiry_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }
            else if(@$theme_data->default_date_format=='english'){ ?>
            $('.booking_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_expiry_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }
            else{?>
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_expiry_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }?>

        });

        $("#all-select").click(function () {
            if ($("#all-select").val() == "check all") {
                $(".cb-element").prop("checked", true);
                $("#all-select").val("uncheck all");
            } else if ($("#all-select").val() == "uncheck all") {
                $(".cb-element").prop("checked", false);
                $("#all-select").val("check all");
            }
        });

        $(document).on('click','.ticket-individual-update', function (e) {
            e.preventDefault();
            $("#add_individual_ticketing").modal("toggle");
            var job_id              = demand.job_to_demand_id;
            var can_demand_job      = demand.id;
            var demand_id           = demand.demand_info_id;
            $('#candidate_personal_information_id_individual').attr('value',demand.candidate_personal_information_id);
            $('#job_to_demand_id_individual').attr('value',job_id);
            $('#demand_info_id_individual').attr('value',demand_id);
            $('#demand_job_info_id').attr('value',can_demand_job);


        });

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

        $(document).on('change','select[id="ticketing_agent_id"]', function (e) {
            e.preventDefault();
            var value=$(this).val();

            var action = "{{ route('candidate.airline') }}?id=" + value;
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var airline;
                    airline += '<option value disabled selected> Select airline ref no</option>';

                    $.each(dataResult, function (index, value) {
                        airline +=  '<option value="'+index+'">'+value+'</option>';
                    });

                    $('select[id="airline_id"]').html(airline);
                },
                error: function(error){

                }
            });
        });


    </script>
@endsection
