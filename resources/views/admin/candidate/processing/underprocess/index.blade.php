@extends('layouts.processing_master')
@section('title') Under Process Candidate @endsection
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
                    <h3 class="page-title">Under Process Candidate List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('processing')}}">Processing Dashboard</a></li>
                        <li class="breadcrumb-item active">

                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                   Under Process Candidate
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('applied-candidate.index')}}" >Applied Candidates</a>
                                    <a class="dropdown-item" href="{{route('selected-candidate.index')}}" >Selected Candidates</a>
                                    <a class="dropdown-item active text-white disabled" href="#" >Under-process Candidates</a>
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
{{--                <div class="col-auto float-right ml-auto">--}}
{{--                    <a href="#" class="btn add-btn processing-multiple"><i class="fa fa-plus"></i> Issue Multiple Visa</a>--}}
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


                    <table id="under-process-index" class="table table-striped custom-table mb-0 display nowrap">
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
                                        @foreach(@$value as $processing)
                                            <tr>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo({{$processing}})" hrm-update-action="{{route('status.rollback',@$processing->id)}}"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>
                                                            <a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo({{$processing}})" hrm-update-action="{{route('status.reapply',@$processing->id)}}"><i class="fa fa-pencil m-r-5"></i> Reapply </a>
                                                            <a class="dropdown-item action-visastamp-edit" href="#" data-toggle="modal" data-target="#add_visa_stamping" onclick="candidateInfo({{$processing}})"><i class="fa fa-pencil m-r-5"></i> Visa Stamping </a>
                                                            <a class="dropdown-item action-demand-edit" href="#" onclick="candidateInfo({{$processing}})" hrm-update-action="{{route('demand.update',@$processing->id)}}"><i class="fa fa-pencil m-r-5"></i> Demand Info </a>
                                                            <a class="dropdown-item action-reject-date" href="#"  onclick="candidateInfo({{$processing}})" hrm-update-action="{{route('status.reject',@$processing->id)}}" hrm-status="rejected"><i class="fa fa-pencil m-r-5"></i> Reject </a>
                                                            <a class="dropdown-item action-cancel-date" href="#"  onclick="candidateInfo({{$processing}})" hrm-update-action="{{route('status.reject',@$processing->id)}}" hrm-status="cancelled"><i class="fa fa-pencil m-r-5"></i> Cancel </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                            {{ucfirst(str_replace("-"," ",$processing->personalInfo->status))}}
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            {{--                                                <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$user->id)}}" href="#" id="0">De-active</a>--}}
                                                            <a class="dropdown-item processing-individual-update" href="#" onclick="candidateInfo({{$processing}})">Individual Visa</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$processing->personalInfo->serial_no}}</td>
                                                <td> {{ucwords(@$processing->personalInfo->candidate_firstname)}} {{ucwords(@$processing->personalInfo->candidate_middlename)}} {{ucwords(@$processing->personalInfo->candidate_lastname)}}</td>
                                                <td>{{ucwords(@$processing->personalInfo->gender)}}</td>
                                                <td>{{@$processing->personalInfo->passport_no}}</td>
                                                <td>{{\App\Models\DemandInformation::find($processing->demand_info_id)->countryState->country}}</td>
                                                <td>{{ucwords($processing->demandInfo->company_name)}}</td>
                                                <td>{{\App\Models\JobtoDemand::find($processing->job_to_demand_id)->jobCategory->name}}</td>


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

    <!-- Edit demand info -->
    @include('admin.modals.candidate.processing.underprocess.demandinfo')
    <!-- /Edit demand info -->

    <!-- individual Visa form info -->
    @include('admin.modals.candidate.processing.underprocess.individualvisa')
    <!-- /individual Visa form info -->

    <!-- multiple Visa form info -->
    @include('admin.modals.candidate.processing.underprocess.multiplevisa')
    <!-- /multiple Visa form info -->

    <!-- visa stamp info -->
    @include('admin.modals.candidate.processing.underprocess.visastamp')
    <!-- /visa stamp form info -->

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

            $('#under-process-index').DataTable( {
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

            $("#visa_expiry_date").on("dp.change", function() {
                var issue = $('#visa_issued_date').data('date');

                var expiry        = new Date($(this).val()),
                    final_issue   = new Date(issue),
                    residency     = new Date(expiry - final_issue).getFullYear() - 1970;
                    $('#residency_duration').attr('value',residency);
            });

            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
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
            $("#visa_issued_date").on("dp.change", function (e) {
                $('#visa_expiry_date').data("DateTimePicker").minDate(e.date);
            });
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_expiry_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            <?php }
            else{?>
            $("#visa_issued_date").on("dp.change", function (e) {
                $('#visa_expiry_date').data("DateTimePicker").minDate(e.date);
            });
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#visa_expiry_date').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            <?php }?>

        });



        //ajax requests
        $(document).on('change','.demand-company-name, .visa-company-name', function (e) {
            e.preventDefault();
            var demand_id = $(this).children("option:selected").val();
            url           = "{{route('candidate-info.getdemandcategory')}}";
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
                    $('#underprocess_job_to_demand_id').attr("required", "required");
                    $('#underprocess_job_to_demand_id').html(options);
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


        $("#all-select").click(function () {
            if ($("#all-select").val() == "check all") {
                $(".cb-element").prop("checked", true);
                $("#all-select").val("uncheck all");
            } else if ($("#all-select").val() == "uncheck all") {
                $(".cb-element").prop("checked", false);
                $("#all-select").val("check all");
            }
        });

        $(document).on('click','.processing-multiple', function (e) {
            e.preventDefault();
            $("#underprocess_to_multiple").modal("toggle");
            var checkedID = [];
            $('tbody input[type="checkbox"]:checked').each(function(){
                checkedID.push($(this).val());
            });
        });

        $(document).on('click','.processing-individual-update', function (e) {
            e.preventDefault();
            $("#add_individual_visa").modal("toggle");
            console.log(demand);
            var demand_id       = demand.demand_info_id;
            var job_id          = demand.job_to_demand_id;
            var can_demand_job  = demand.id;
            getDemandRelatedCat(demand_id, job_id,"visa");
            $('#candidate_regd_number').attr('value',demand.personal_info.registration_no);
            $('#candidate_personal_information_id_individual').attr('value',demand.candidate_personal_information_id);
            $('#demand_info_id').attr('value',demand.demand_info_id);
            $('#demand_job_info_id_individual').attr('value',can_demand_job);
            var first = (demand.personal_info.candidate_firstname !== null) ? demand.personal_info.candidate_firstname :"";
            var middlename = (demand.personal_info.candidate_middlename !== null) ? demand.personal_info.candidate_middlename :"";
            var last = (demand.personal_info.candidate_lastname !== null) ? demand.personal_info.candidate_lastname :"";
            $('#candidate_name').attr('value',first+' '+ middlename +' '+last);
            $('#passport_number').attr('value',demand.personal_info.passport_no);
            $('#mobile_number').attr('value',demand.personal_info.mobile_no);
            $('#visa_job_category option[value="'+ demand.jobto_demand.job_category.id+'"]').prop('selected', true);
        });

        $(document).on('click','.action-visastamp-edit', function (e) {
            e.preventDefault();
            var job_id = demand.job_to_demand_id;
            $('#candidate_personal_information_id_visa_stamp').attr('value',demand.candidate_personal_information_id);
            $('#job_to_demand_id_visa_stamp').attr('value',job_id);


        });

        $(document).on('click','.action-demand-edit', function (e) {
            e.preventDefault();
            // var job_id = demand.demand_job_info.job_to_demand_id;
            $("#edit_underprocess_demand_info").modal("toggle");
            var demand_id = demand.demand_info_id;
            var job_id    = demand.job_to_demand_id;
            var action    = $(this).attr('hrm-update-action');
            $('.underdemandupdate').attr('action',action);
            $('#demand_info_id_underpro option[value="'+demand_id+'"]').prop('selected', true);
            $('#candidate_personal_information_id_under').attr('value',demand.candidate_personal_information_id);

            getDemandRelatedCat(demand_id, job_id,"demandonly");
        });



        function getDemandRelatedCat(demand_id,job_id,status){
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
                    if(status == "visa"){
                        $('.job_to_demand_cat').html(options);
                        $('#visa_job_to_demand_id option[value="'+job_id+'"]').prop('selected', true);
                    }else{
                        $('#underprocess_job_to_demand_id').html(options);
                        $('#underprocess_job_to_demand_id option[value="'+job_id+'"]').prop('selected', true);
                    }

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
