@extends('layouts.master')
@section('title') Ticket Received Candidate @endsection
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
                    <h3 class="page-title">Ticket Received Candidate List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('processing')}}">Processing Dashboard</a></li>
                        <li class="breadcrumb-item active">
                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Ticket Received Candidate
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('applied-candidate.index')}}" >Applied Candidates</a>
                                    <a class="dropdown-item" href="{{route('selected-candidate.index')}}" >Selected Candidates</a>
                                    <a class="dropdown-item" href="{{route('under-processing-candidate.index')}}" >Under-process Candidates</a>
                                    <a class="dropdown-item" href="{{route('visa.index')}}" >Visa-received Candidates</a>
                                    <a class="dropdown-item active text-white disabled" href="#" >Ticket-received Candidates</a>
                                    <a class="dropdown-item" href="{{route('deployed-candidate.index')}}" >Deployed Candidates</a>
                                    <a class="dropdown-item" href="{{route('rejected-candidate.index')}}" >Rejected Candidates</a>
                                    <a class="dropdown-item" href="{{route('cancelled-candidate.index')}}" >Cancelled Candidates</a>
                                </div>
                            </span>

                        </li>
                    </ul>
                </div>
{{--                <div class="col-auto float-right ml-auto">--}}
{{--                    <a href="#" class="btn add-btn visa-multiple"><i class="fa fa-plus"></i> Issue Multiple Ticket</a>--}}
{{--                </div>--}}
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

                    <table id="ticket-process-index" class="table table-striped custom-table mb-0 display nowrap">
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
                                        @foreach(@$value as $ticket)
                                            <tr>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo({{$ticket}})" hrm-update-action="{{route('status.rollback',@$ticket->id)}}"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>
                                                            <a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo({{$ticket}})" hrm-update-action="{{route('status.reapply',@$ticket->id)}}"><i class="fa fa-pencil m-r-5"></i> Reapply </a>

                                                            <a class="dropdown-item ticket-individual-update" onclick="candidateInfo({{$ticket}})" hrm-update-action="{{route('individual-ticket.update',@$ticket->personalInfo->individual_ticket->id)}}"><i class="fa fa-pencil m-r-5"></i> Individual Ticket </a>
                                                            <a class="dropdown-item action-health-record-edit" href="#" hrm-update-action="{{($ticket->personalInfo->medical_report == null) ? route('candidate-medical-info.store'): route('candidate-medical-info.update',@$ticket->personalInfo->medical_report->id)}}" hrm-edit-method="{{($ticket->personalInfo->medical_report == null) ? 'post':'PUT'}}" onclick="candidateInfo({{$ticket}})"><i class="fa fa-pencil m-r-5"></i> Health Record </a>
                                                            <a class="dropdown-item action-reject-date" href="#"  onclick="candidateInfo({{$ticket}})" hrm-update-action="{{route('status.reject',@$ticket->id)}}" hrm-status="rejected"><i class="fa fa-pencil m-r-5"></i> Reject </a>
                                                            <a class="dropdown-item action-cancel-date" href="#"  onclick="candidateInfo({{$ticket}})" hrm-update-action="{{route('status.reject',@$ticket->id)}}" hrm-status="cancelled"><i class="fa fa-pencil m-r-5"></i> Cancel </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                            {{ucfirst(str_replace("-"," ",$ticket->personalInfo->status))}}
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item ticket-deployed-update" href="#" onclick="candidateInfo({{$ticket}})" hrm-update-action="{{route('ticket-to-deployed.update',@$ticket->id)}}">Deployed</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$ticket->personalInfo->serial_no}}</td>
                                                <td> {{ucwords(@$ticket->personalInfo->candidate_firstname)}} {{ucwords(@$ticket->personalInfo->candidate_middlename)}} {{ucwords(@$ticket->personalInfo->candidate_lastname)}}</td>
                                                <td>{{ucwords(@$ticket->personalInfo->gender)}}</td>
                                                <td>{{@$ticket->personalInfo->passport_no}}</td>
                                                <td>{{\App\Models\DemandInformation::find($ticket->demand_info_id)->countryState->country}}</td>
                                                <td>{{ucwords($ticket->demandInfo->company_name)}}</td>
                                                <td>{{\App\Models\JobtoDemand::find($ticket->job_to_demand_id)->jobCategory->name}}</td>
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
    @include('admin.modals.candidate.processing.ticket_received.individualticketupdate')
    <!-- /individual ticketing form info -->

    <!-- Candidate Health record form info -->
    @include('admin.modals.candidate.processing.ticket_received.healthrecord')
    <!-- /Candidate Health record form info -->

    <!--  ticketing to deployment form info -->
    @include('admin.modals.candidate.processing.ticket_received.deployed')
    <!-- /iticketing to deployment form info -->

    @include('admin.modals.candidate.processing.ticket_received.ticketissued')

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

            $('#ticket-process-index').DataTable( {
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

            $("#booking_time_update").datetimepicker({
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
            $("#report_issued_date_edit").on("dp.change", function (e) {
                $('#report_expiry_date_edit').data("DateTimePicker").minDate(e.date);
            });
            $('.booking_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#report_issued_date_edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#report_expiry_date_edit').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            $('#visa_expiry_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }
            else{?>
            $("#report_issued_date_edit").on("dp.change", function (e) {
                $('#report_expiry_date_edit').data("DateTimePicker").minDate(e.date);
            });
            $('#report_issued_date_edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#report_expiry_date_edit').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false

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
            $("#edit_individual_ticketing").modal("toggle");
            var action = $(this).attr('hrm-update-action');
            $('.updateindividual').attr('action',action);

            var job_id    = demand.job_to_demand_id;
            var can_demand_job      = demand.id;
            var demand_id = demand.demand_info_id;
            $('#candidate_personal_information_id_individual').attr('value',demand.candidate_personal_information_id);
            $('#job_to_demand_id_individual').attr('value',job_id);
            $('#demand_info_id_individual').attr('value',demand_id);
            $('#demand_job_info_id_individual').attr('value',can_demand_job);

            //showing old individual ticket details of candidate
            $('#ticket_no_update').attr('value',demand.personal_info.individual_ticket.ticket_no);
            $('#booking_date_update').attr('value',demand.personal_info.individual_ticket.booking_date);
            $('#booking_time_update').attr('value',demand.personal_info.individual_ticket.booking_time);
            $('#status_applied_date_update').attr('value',demand.personal_info.individual_ticket.status_applied_date);
            $('#remarks_update').text(demand.personal_info.individual_ticket.remarks);
            $('#booking_description_update').text(demand.personal_info.individual_ticket.booking_description);
            $('#airline_id_update option[value="'+demand.personal_info.individual_ticket.airline_id+'"]').prop('selected', true);
            $('#ticketing_agent_update option[value="'+demand.personal_info.individual_ticket.ticketing_agent_id+'"]').prop('selected', true);
            $('#sub_status_update option[value="'+demand.personal_info.individual_ticket.sub_status_id+'"]').prop('selected', true);


        });

        $(document).on('click','.ticket-deployed-update', function (e) {
            e.preventDefault();
            $("#edit_deployment_status").modal("toggle");
            var action    = $(this).attr('hrm-update-action');
            var job_id    = demand.job_to_demand_id;
            var demand_id = demand.demand_info_id;
            $('#candidate_personal_information_id_deployed').attr('value',demand.candidate_personal_information_id);
            $('#job_to_demand_id_deployed').attr('value',job_id);
            $('#demand_info_id_deployed').attr('value',demand_id);
            $('.deployedform').attr('action',action);
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

        $(document).on('click','.action-health-record-edit', function (e) {
            e.preventDefault();
            console.log(demand);
            $("#edit_health_record").modal("toggle");
            var action = $(this).attr('hrm-update-action');
            var method = $(this).attr('hrm-edit-method');

            var first = (demand.personal_info.candidate_firstname !== null) ? demand.personal_info.candidate_firstname :"";
            var middlename = (demand.personal_info.candidate_middlename !== null) ? demand.personal_info.candidate_middlename :"";
            var last = (demand.personal_info.candidate_lastname !== null) ? demand.personal_info.candidate_lastname :"";
            $('#candidate_personal_information_id_medical').attr('value',demand.personal_info.id);
            $('#registration_no').attr('value',demand.personal_info.registration_no);
            $('#candidate_name').attr('value',first+' '+ middlename +' '+last);
            $('#passport_no').attr('value',demand.personal_info.passport_no);
            $('#mobile_no').attr('value',demand.personal_info.mobile_no);


            if(method == 'PUT') {
                if (demand.personal_info.medical_report.complexion !== null) {
                    $('#complexion').attr('value', demand.personal_info.medical_report.complexion);
                }
                if (demand.personal_info.medical_report.height !== null) {
                    $('#height').attr('value', demand.personal_info.medical_report.height);
                }
                if (demand.personal_info.medical_report.weight !== null) {
                    $('#weight').attr('value', demand.personal_info.medical_report.weight);
                }
                if (demand.personal_info.medical_report.bloodgroup !== null) {
                    $('#bloodgroup option[value="' + demand.personal_info.medical_report.bloodgroup + '"]').prop('selected', true);
                }
                if (demand.personal_info.medical_report.check_medical == "yes") {
                    $('#checkMedical').prop('checked', true);
                    medicalChecked();
                } else {
                    $('#checkMedical').prop('checked', false);
                    medicalNotChecked();
                }
                if (demand.personal_info.medical_report.medical_report_number !== null) {
                    $('#medical_report_number').attr('value', demand.personal_info.medical_report.medical_report_number);
                }
                if (demand.personal_info.medical_report.health_clinic_id !== null) {
                    $('#health_clinic_id option[value="' + demand.personal_info.medical_report.health_clinic_id + '"]').prop('selected', true);
                }
                if (demand.personal_info.medical_report.report_issued_date !== null) {
                    $('#report_issued_date').attr('value', demand.personal_info.medical_report.report_issued_date);
                }
                if (demand.personal_info.medical_report.report_expiry_date !== null) {
                    $('#report_expiry_date').attr('value', demand.personal_info.medical_report.report_expiry_date);
                }
                if (demand.personal_info.medical_report.result !== null) {
                    $('#result option[value="' + demand.personal_info.medical_report.result + '"]').prop('selected', true);
                }
                if (demand.personal_info.medical_report.report !== null) {
                    $('#report').text(demand.personal_info.medical_report.report);
                }
                if (demand.personal_info.medical_report.report_remarks !== null) {
                    $('#report_remarks').text(demand.personal_info.medical_report.report_remarks);
                }
                if (demand.personal_info.medical_report.payment_status == "yes") {
                    $('#paymentCheck').prop('checked', true);
                }
                if (demand.personal_info.medical_report.amount !== null) {
                    $('#payment_amount').attr('value', demand.personal_info.medical_report.amount);
                }
                if (demand.personal_info.medical_report.report_image !== null) {
                    var src = '/images/medical/' + demand.personal_info.medical_report.report_image;
                    $replaceable = '<label>Current Report Image:</label> ' +
                        '<div class="card"> ' +
                        '<img src="' + src + '" class="card-img-top" id="currentReportImage"> ' +
                        '</div> ';
                    $('#currentImageAppend').html($replaceable);
                }
                if (demand.personal_info.medical_report.status_applied_date !== null) {
                    $('#status_applied_date_medical').attr('value', demand.personal_info.medical_report.status_applied_date);
                }
                if (demand.personal_info.medical_report.sub_status_id !== null) {
                    $('#sub_status_medical option[value="' + demand.personal_info.medical_report.sub_status_id + '"]').prop('selected', true);
                }
                if (demand.personal_info.medical_report.remarks !== null) {
                    $('#remarks_medical').text(demand.personal_info.medical_report.remarks);
                }
            }else{
                $('.updatemedicalrecord').attr('method',method);
                $('input[name="_method"]').remove();
            }

            $('.updatemedicalrecord').attr('action',action);

        });

        $(document).on('change','input[name="check_medical"]', function (e) {
            e.preventDefault();
            if($(this).prop("checked") == true){
                medicalChecked();
            }
            else if($(this).prop("checked") == false){
                medicalNotChecked();
            }
        });

        function medicalChecked(){
            $(".medical-report").removeAttr("readonly", "readonly");
            $(".medical-report-select").removeAttr("disabled", "disabled");
            $(".required").attr("required", "required");
        }

        function medicalNotChecked(){
            $(".medical-report").attr("readonly", "readonly");
            $(".medical-report-select").attr("disabled", "disabled");
            $(".required").removeAttr("required", "required");

        }

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

        $(document).on('change','select[id="ticketing_agent_update"]', function (e) {
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

                    $('select[id="airline_id_update"]').html(airline);
                },
                error: function(error){

                }
            });
        });

    </script>
@endsection
