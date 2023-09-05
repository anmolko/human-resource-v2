@extends('layouts.processing_master')
@section('title') Selected Candidate @endsection
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
                    <h3 class="page-title">Selected Candidate List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('processing')}}">Processing Dashboard</a></li>
                        <li class="breadcrumb-item active">
                            <span class="dropdown">
                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                     Selected Candidate
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('applied-candidate.index')}}" >Applied Candidates</a>
                                    <a class="dropdown-item active text-white disabled" href="#" >Selected Candidates</a>
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
                    <!-- Selected Candidate Table -->

                    <table id="selected-index" class="table table-striped custom-table mb-0 display nowrap">
                        <thead>
                        <tr>
                            <th></th>
                            <th>S.N</th>
                            <th>Company Name</th>
                            <th>Number of Candidates</th>
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
                                        @foreach(@$value as $selected)
                                            <tr>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo({{$selected}})" hrm-update-action="{{route('status.rollback',@$selected->id)}}"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>
                                                            <a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo({{$selected}})" hrm-update-action="{{route('status.reapply',@$selected->id)}}"><i class="fa fa-pencil m-r-5"></i> Reapply </a>
                                                            <a class="dropdown-item action-reject-date" href="#"  onclick="candidateInfo({{$selected}})" hrm-update-action="{{route('status.reject',@$selected->id)}}" hrm-status="rejected"><i class="fa fa-pencil m-r-5"></i> Reject </a>
                                                            <a class="dropdown-item action-cancel-date" href="#"  onclick="candidateInfo({{$selected}})" hrm-update-action="{{route('status.reject',@$selected->id)}}" hrm-status="cancelled"><i class="fa fa-pencil m-r-5"></i> Cancel </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">

                                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-dot-circle-o text-success"></i>
                                                            {{ucfirst($selected->personalInfo->status)}}
                                                        </a>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item processing-status-update" hrm-update-action="{{route('selected-to-under.update',@$selected->id)}}" onclick="candidateInfo({{$selected}})" href="#">Under Process</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$selected->personalInfo->serial_no}}</td>
                                                <td> {{ucwords(@$selected->personalInfo->candidate_firstname)}} {{ucwords(@$selected->personalInfo->candidate_middlename)}} {{ucwords(@$selected->personalInfo->candidate_lastname)}}</td>
                                                <td>{{ucwords(@$selected->personalInfo->gender)}}</td>
                                                <td>{{@$selected->personalInfo->passport_no}}</td>
                                                <td>{{\App\Models\DemandInformation::find($selected->demand_info_id)->countryState->country}}</td>
                                                <td>{{\App\Models\JobtoDemand::find($selected->job_to_demand_id)->jobCategory->name}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach

                        </tbody>
                    </table>
{{--                    <table id="selected-index" class="table table-striped custom-table mb-0 ">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th></th>--}}
{{--                            <th>Company Name</th>--}}
{{--                            <th>Number of candidates</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach(@$data as $key=>$value)--}}
{{--                            <tr data-child-value="{{json_encode($value)}}">--}}
{{--                                <td class="details-control text-primary text-center"></td>--}}
{{--                                <td>{{$key}}</td>--}}
{{--                                <td>{{count($value)}}</td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}



                {{--                    <table id="selected-index" class="table table-striped custom-table mb-0 ">--}}
{{--                        <thead>--}}
{{--                            <tr>--}}
{{--                                <th>S.N</th>--}}
{{--                                <th>Company Name</th>--}}
{{--                                <th>Number of candidates</th>--}}
{{--                            </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach(@$data as $key=>$value)--}}
{{--                            <tr data-toggle="collapse" id="{{str_replace(' ', '_', $key)}}" data-target=".{{str_replace(' ', '_', $key)}}">--}}
{{--                                <td>#</td>--}}
{{--                                <td>{{$key}}</td>--}}
{{--                                <td>{{count($value)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr class="collapse {{str_replace(' ', '_', $key)}}">--}}
{{--                                <td colspan="999">--}}
{{--                                    <div>--}}
{{--                                        <table class="table table-striped">--}}
{{--                                            <thead>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Serial No.</th>--}}
{{--                                                    <th>Name</th>--}}
{{--                                                    <th>Gender</th>--}}
{{--                                                    <th>Passport No.</th>--}}
{{--                                                    <th>Country Applied</th>--}}
{{--                                                    <th>Company Name</th>--}}
{{--                                                    <th>Applied Job Category</th>--}}
{{--                                                    <th>Status</th>--}}
{{--                                                    <th class="text-right">Action</th>--}}
{{--                                                </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @foreach(@$value as $selected)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{{$selected->personalInfo->serial_no}}</td>--}}
{{--                                                    <td> {{ucwords(@$selected->personalInfo->candidate_firstname)}} {{ucwords(@$selected->personalInfo->candidate_middlename)}} {{ucwords(@$selected->personalInfo->candidate_lastname)}}</td>--}}
{{--                                                    <td>{{ucwords(@$selected->personalInfo->gender)}}</td>--}}
{{--                                                    <td>{{@$selected->personalInfo->passport_no}}</td>--}}
{{--                                                    <td>{{\App\Models\DemandInformation::find($selected->demand_info_id)->countryState->country}}</td>--}}
{{--                                                    <td>{{ucwords($selected->demandInfo->company_name)}}</td>--}}
{{--                                                    <td>{{\App\Models\JobtoDemand::find($selected->job_to_demand_id)->jobCategory->name}}</td>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="dropdown">--}}

{{--                                                            <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
{{--                                                                <i class="fa fa-dot-circle-o text-success"></i>--}}
{{--                                                                {{ucfirst($selected->personalInfo->status)}}--}}
{{--                                                            </a>--}}
{{--                                                            <div class="dropdown-menu">--}}
{{--                                                                <a class="dropdown-item processing-status-update" hrm-update-action="{{route('selected-to-under.update',@$selected->id)}}" onclick="candidateInfo({{$selected}})" href="#">Under Process</a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                    <td class="text-right">--}}
{{--                                                        <div class="dropdown dropdown-action">--}}
{{--                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                            <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                                <a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo({{$selected}})" hrm-update-action="{{route('status.rollback',@$selected->id)}}"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>--}}
{{--                                                                <a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo({{$selected}})" hrm-update-action="{{route('status.reapply',@$selected->id)}}"><i class="fa fa-pencil m-r-5"></i> Reapply </a>--}}

{{--                                                                <a class="dropdown-item action-reject-date" href="#" ><i class="fa fa-pencil m-r-5"></i> Reject </a>--}}
{{--                                                                <a class="dropdown-item action-cance-date" href="#" ><i class="fa fa-pencil m-r-5"></i> Cancel </a>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                                <td style="display: none"></td>--}}
{{--                                <td style="display: none"></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}


{{--                        </tbody>--}}
{{--                    </table>--}}
                    <!-- /selected Candidate Table -->

                </div>
            </div>
        </div>



    </div>
    <!-- /Page Content -->

    <!-- One step back form info -->
    @include('admin.modals.candidate.processing.onestepback')
    <!-- /One step back form info -->

    <!-- selected to selected form info -->
    @include('admin.modals.candidate.processing.selected.underprocessfrom')
    <!-- /selected to selected form info -->

    @include('admin.modals.candidate.processing.reject')

@endsection
@section('js')
    <script src="{{asset("backend/assets/jquery-ui.js")}}" ></script>
{{--    <script src="{{asset("backend/assets/jquery.dataTables.min.js")}}" ></script>--}}
    <script src="{{asset("backend/assets/dataTables.responsive.min.js")}}" ></script>

    <script type="text/javascript">
        {{--var deanddata = <?php echo json_encode($data); ?>;--}}
        let demand = "";
        function candidateInfo(incomingdemand) {
            // $.each(demanddata, function( index, values ) {
            //     $.each(values, function( index, value ) {
            //         if(value.id == demandid){
            //             demand = value;
            //         }
            //     });
            // });
            demand = incomingdemand;
        }


        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#selected-index').DataTable( {
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

            // function format(mainvalue) {
            //     var inner_table = '<table class="child_row-verified table-responsive table table-striped table-bordered nowrap">' +
            //         '<thead>' +
            //         '<tr> ' +
            //         '<th>Serial No.</th> ' +
            //         '<th>Name</th> ' +
            //         '<th>Gender</th> ' +
            //         '<th>Passport No.</th> ' +
            //         '<th>Country Applied</th> ' +
            //         '<th>Company Name</th> ' +
            //         '<th>Applied Job Category</th> ' +
            //         '<th>Status</th> ' +
            //         '<th class="text-right">Action</th> ' +
            //         '</tr>' +
            //         '</thead>' +
            //         '<tbody>';
            //
            //     $.each(mainvalue, function( index, value ) {
            //         var fname = value.personal_info.candidate_firstname ? value.personal_info.candidate_firstname:"";
            //         var mname = value.personal_info.candidate_middlename ? " "+value.personal_info.candidate_middlename:"";
            //         var lname = value.personal_info.candidate_lastname ? " "+value.personal_info.candidate_lastname:"";
            //         var status = ' <div class="dropdown"> ' +
            //             '<a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle text-capitalize" data-toggle="dropdown" aria-expanded="false"> ' +
            //             '<i class="fa fa-dot-circle-o text-success"></i> ' + value.personal_info.status +
            //             '</a> ' +
            //             '<div class="dropdown-menu"> ' +
            //             '<a class="dropdown-item processing-status-update" hrm-update-action="/selected-to-underprocess/'+ value.id +'" onclick="candidateInfo('+ value.id +')" href="#">Under Process</a>' +
            //             '</div>' +
            //             '</div>';
            //
            //         var action = '<div class="dropdown dropdown-action">' +
            //             '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a> ' +
            //             '<div class="dropdown-menu dropdown-menu-right">' +
            //             '<a class="dropdown-item action-rollback-onestep" href="#" onclick="candidateInfo('+ value.id +')" hrm-update-action="/status-rollback-update/'+ value.id +'/"><i class="fa fa-pencil m-r-5"></i> One Step Back </a>'+
            //             '<a class="dropdown-item action-reapply-status" href="#" onclick="candidateInfo('+ value.id +')" hrm-update-action="/status-reapply-update/'+ value.id +'/"><i class="fa fa-pencil m-r-5"></i> Reapply </a>' +
            //             '<a class="dropdown-item action-reject-date" href="#" ><i class="fa fa-pencil m-r-5"></i> Reject </a> ' +
            //             '<a class="dropdown-item action-cancel-date" href="#" ><i class="fa fa-pencil m-r-5"></i> Cancel </a> ' +
            //             '</div>' +
            //             '</div>';
            //
            //         inner_table += '<td>' +
            //             value.personal_info.serial_no + '</td>' +
            //             '<td class="text-capitalize">'+ fname + mname + lname +'</td>' +
            //             '<td class="text-capitalize">' + value.personal_info.gender +'</td>' +
            //             '<td>' + value.personal_info.passport_no + '</td>' +
            //             '<td class="text-capitalize">' + value.demand_info.country_state.country + '</td>' +
            //             '<td class="text-capitalize">' + value.demand_info.company_name + '</td>' +
            //             '<td class="text-capitalize">' + value.jobto_demand.job_category.name + '</td>' +
            //             '<td>' + status + '</td>' +
            //             '<td class="text-right">' + action + '</td></tr>';
            //     });
            //
            //     return inner_table;
            // }

            // all_selected();
            // function all_selected(){
            //     var table = $('#selected-index').DataTable({
            //         "orderable": false,
            //         "bSort" : false,
            //         "lengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]],
            //     });
            //
            //     // for candidates
            //     $('#selected-index tbody').off('click', 'td.details-control');
            //     $('#selected-index tbody').on('click', 'td.details-control', function () {
            //         var tr = $(this).closest('tr');
            //         var row = table.row( tr );
            //
            //         if ( row.child.isShown() ) {
            //             // This row is already open - close it
            //             row.child.hide();
            //             tr.removeClass('shown');
            //         }
            //         else {
            //             // Open this row
            //             row.child(format(tr.data('child-value'))).show();
            //             tr.addClass('shown');
            //         }
            //     } );
            // }


            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
            $('.demand-applied-date').nepaliDatePicker({
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
            $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }
            else{?>
            $('.demand-applied-date').datetimepicker({
                format: 'YYYY-MM-DD'
            }); $('.visa_issued_date').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }?>

        });

        //ajax requests
        $(document).on('change','.demand-company-name', function (e) {
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
                    var options = '<option selected value disabled>Select Job Category</option>';
                    $.each( dataResult.response, function(key, value) {
                        options += '<option value="'+key+'">'+value+'</option>';
                    });
                    $('.job_to_demand_cat').attr("required", "required");
                    $('#selected_job_to_demand_id').html(options);

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
            $("#selected_to_underprocess").modal("toggle");
            var action = $(this).attr('hrm-update-action');
            var demand_id = demand.demand_info_id;
            var job_id = demand.job_to_demand_id;
            getDemandRelatedCat(demand_id,job_id);
            $('.updateapplied').attr('action',action);
            $('#candidate_personal_information_id').attr('value',demand.candidate_personal_information_id);
            $('#selected_status_applied_date').attr('value',demand.status_applied_date);
            $('#selected_sub_status option[value="'+demand.sub_status_id+'"]').prop('selected', true);
            $('#selected_demand_info_id option[value="'+demand.demand_info_id+'"]').prop('selected', true);
            $('#selected_remarks').text(demand.remarks);
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
                    $('#selected_job_to_demand_id option[value="'+job_id+'"]').prop('selected', true);

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
