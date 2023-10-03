@extends('layouts.master')
@section('title') Demand Informaton @endsection
@section('css')
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

        td.details-controls {
            text-align:center;
            cursor: pointer;
        }
        tr.shown td.details-controls {
            text-align:center;
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

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Demand Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Demand Information</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_demand_info"><i class="fa fa-plus"></i> Add Demand Information</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('demand-info.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Primary Group Table -->
                    <table id="demand-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Demand Ref (L.T) No.</th>
                            <th>Company</th>
                            <th>Country - State</th>
                            <th>Exp Date</th>
                            <th>O. Agent</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($demand_info as $demand)
                            <tr data-child-value="{{$demand}}">
                                <td class="details-control"><i class="fa fa-plus-square" aria-hidden="true"></i></td>
                                <td>{{$demand->ref_no ?? ''}} </td>
                                <td>{{ucwords(@$demand->company_name ?? '-')}}</td>
                                <td>{{ucwords(@$demand->countryState->country ?? '')}}
                                               {{@$demand->countryState ? ' - '.$demand->countryState->state:'' }} </td>
                                <td>{{ $demand->expired_date ? \Carbon\Carbon::parse($demand->expired_date)->isoFormat('MMMM Do, YYYY'):''}}</td>
                                <td>{{ $demand->overseas_agent_id ? ucwords(App\Models\OverseasAgent::find($demand->overseas_agent_id)->fullname) :''}}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            {{str_replace('-', ' ', ucfirst($demand->status))}}
                                        </a>
                                        <div class="dropdown-menu">
                                            @if($demand->status == "new")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="on-going">On Going</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="up-coming">Up Coming</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="completed">Completed</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="expired">Expired</a>
                                            @elseif($demand->status == "on-going")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="new">New</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="up-coming">Up Coming</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="completed">Completed</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="expired">Expired</a>
                                            @elseif($demand->status == "up-coming")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="new">New</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="on-going">On Going</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="completed">Completed</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="expired">Expired</a>
                                            @elseif($demand->status == "completed")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="new">New</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="on-going">On Going</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="up-coming">Up Coming</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="expired">Expired</a>
                                            @elseif($demand->status == "expired")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="new">New</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="on-going">On Going</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="up-coming">Up Coming</a>
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('demand-info.status.update',$demand->id)}}" href="#" id="completed">Completed</a>
                                            @endif
                                        </div>
                                    </div>
                                    </td>
                                <td class="text-right">
{{--                                    <div class="dropdown dropdown-action">--}}
{{--                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <a class="dropdown-item action-view" href="{{route('demand-info.show',$demand->id)}}"  id="{{$demand->id}}"><i class="fa fa-eye m-r-5"></i> View More Info</a>--}}
{{--                                            <a class="dropdown-item action-add-jobs" id="{{$demand->id}}" href="#" data-toggle="modal" data-target="#add_job_demand"><i class="fa fa-plus m-r-5"></i> Add Job to Demand</a>--}}
{{--                                            <a class="dropdown-item action-edit" href="#" id="{{$demand->id}}" hrm-update-action="{{route('demand-info.update',$demand->id)}}"  hrm-edit-action="{{route('demand-info.edit',$demand->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('demand-info.destroy',$demand->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-view" href="{{route('demand-info.show',$demand->id)}}"  id="{{$demand->id}}">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{$demand->id}}" hrm-update-action="{{route('demand-info.update',$demand->id)}}"  hrm-edit-action="{{route('demand-info.edit',$demand->id)}}" data-toggle="modal">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-add-jobs" id="{{$demand->id}}" href="#" data-toggle="modal" data-target="#add_job_demand">
                                                    <i class="fa fa-plus align-bottom me-2 text-muted"></i> </a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#"  hrm-delete-action="{{route('demand-info.destroy',$demand->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!-- /Demand Info Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Demand Info Modal -->
    @include('admin.modals.demand_information.add')
    <!-- /Add Demand Info Modal -->

    <!-- update Demand Info Modal -->
    @include('admin.modals.demand_information.edit')
    <!-- /update Demand Info Modal -->

    {{-- for jobs to demand mapping--}}

    <!-- Add Jobs to Demand Info Modal -->
    @include('admin.modals.jobs_to_demand.add')
    <!-- /Add Jobs to Demand Info Modal -->

    <!-- update jobs to demand Modal -->
    @include('admin.modals.jobs_to_demand.edit')
    <!-- /update jobs to demand Modal -->

    <!-- View jobs to demand Modal -->
    @include('admin.modals.jobs_to_demand.view')
    <!-- /View jobs to demand Modal -->

     <!-- Forbidden Attribute Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Attribute Modal -->

@endsection
@section('js')
    <script type="text/javascript">
        var loadFile = function(event) {
            var image = document.getElementById('image');
            var replacement = document.getElementById('current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadupdateFile = function(event) {
            var imageed = document.getElementById('demand-image');
            var replacement = document.getElementById('current-demand-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $( ".select2" ).select2({
                width:'100%'
            });

            <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datetimepicker1').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datetimepicker2').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datetimepicker3').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('#datetimepicker-edit').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }else if(@$theme_data->default_date_format=='english'){ ?>


            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment()
            });
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD',
            });
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'

            });

            <?php }else{?>
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
            })
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD',
                defaultDate: moment()
            })
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD',
            })
            $('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            <?php }?>

            function format(mainvalue) {
                var inner_table = '<table class="child_row-verified table-responsive table table-striped table-bordered nowrap"><thead><tr><th>Job Category</th><th>Contract Period</th><th>Min-Qualification</th><th>Overtime</th><th>Overtime(per month)</th><th>Salary</th><th>Working (in days)</th><th>Working(hours)</th><th>Action</th></tr></thead><tbody>';
                console.log(mainvalue.jobs);
                if(mainvalue.jobs.length > 0){
                    $.each(mainvalue.jobs, function( index, value ) {
                        var viewroute    = "/job-to-demand/"+ value.id +"/single";
                        var updateroute  = "/job-to-demand/"+ value.id;
                        var editroute    = "/job-to-demand/"+ value.id +"/edit";
                        var destroyroute = "/job-to-demand/"+ value.id +"/destory";
                        inner_table += '<td>' +value.job_category.name+ '</td><td>'
                            + value.contact_period + ' per year</td><td>'
                            + value.min_qualification + '</td><td>'
                            + value.overtime
                            + '</td><td>' + value.overtime_per_month + '</td>' +
                            '<td>' + value.salary + '</td>' +
                            '<td>'+ value.working +'</td>'+
                            '<td>'+ value.hours +'</td>'+

                            '<td style=" text-align: center;">' +
                            '<div class="dropdown dropdown-action">'+
                            '<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>'+
                            '<div class="dropdown-menu dropdown-menu-right">'+
                            '<a class="dropdown-item action-jobs-view" href="#" hrm-view-action="'+ viewroute +'" data-toggle="modal" data-target="#view_job_demand" id="'+ value.id +'"><i class="fa fa-eye m-r-5"></i> View </a>'+
                            '<a class="dropdown-item action-jobs-edit" href="#" id="'+ value.id +'" hrm-update-action="'+ updateroute +'"  hrm-edit-action="'+ editroute +'" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>'+
                            '<a class="dropdown-item action-jobs-delete" href="#"  hrm-delete-action="'+ destroyroute +'" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>'+
                            '</div>'+
                            '</div>'+
                            '</td></tr>';
                    });
                }else{
                    inner_table += '<td colspan="9" style="text-align: center">' +
                        'There are no jobs assigned to this demand yet. You can assign job from demand action option by choosing add job to demand option.' +
                        '</td>'
                }



                return inner_table;
            }

            var demand = $('#demand-index').DataTable({
                paging: true,
                searching: true,
                orderable: false,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            $('#demand-index tbody').off('click', 'td.details-control');
            $('#demand-index tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = demand.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(format(tr.data('child-value'))).show();
                    tr.addClass('shown');
                }
            });


        });

        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "PATCH",
                cache: false,
                data:{
                    status: status,
                },
                success: function(dataResult){
                    if(dataResult == "yes"){
                        swal("Success!", "Demand Information Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Demand Information status",
                            type: "error",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        }, function(){
                            swal.close();
                        })
                    }
                },
                error: function() {
                    swal({
                        title: 'Demand Information Warning',
                        text: "Error. Could not confirm the status of the Demand information.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });

        });


        $(document).on('click','.action-add-jobs', function (e) {
            e.preventDefault();
            var demand_id = $(this).attr('id');
            $('#demand-id-map option[value="'+demand_id+'"]').prop('selected', true);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('jobs.demand-info') }}",
                data: {'demand_id':demand_id},
                success: function(data) {
                    $('#company-name-map').attr('value',data.company_name);
                    $('#client-name-map').attr('value',data.overseas_agent.fullname);
                },
                error: function() {
                    swal({
                        title: 'Jobs to Demand error',
                        text: "Error. Could not confirm the status of the demand info.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });

        })

        $(document).on('change','select[name="country"]', function (e) {
            e.preventDefault();
            var value=$(this).val();
            var action = "{{ route('overseas-agent.state') }}?country_code=" + $(this).val();
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var state;
                    state += '<option value disabled selected> Select State</option>';

                        $.each(dataResult, function (index, value) {
                            state +=  '<option value="'+index+'">'+value+'</option>';
                        });

                    $('select[name="state"]').html(state);
                },
                error: function(error){

                }
            });
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
                            // toastr.success('file deleted Successfully');
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
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_demand_info").modal("toggle");
                    if(dataResult.demand_info_agent.image == null ){
                        src = '/images/profiles/others.png';
                    } else{
                        src = '/images/demandinfo/'+dataResult.demand_info_agent.image;
                    }
                    $('#current-demand-img').attr('src',src);
                    $('#ref_no').attr('value',dataResult.demand_info_agent.ref_no);
                    $('#company_id').val(dataResult.demand_info_agent.demand_company_id).trigger('change');


                    $('#serial_no').attr('value',dataResult.demand_info_agent.serial_no);
                    $('#category option[value="'+dataResult.demand_info_agent.category+'"]').prop('selected', true);
                    $('#fulfill_date').attr('value',dataResult.demand_info_agent.fulfill_date);
                    $('#issued_date').attr('value',dataResult.demand_info_agent.issued_date);
                    $('#expired_date').attr('value',dataResult.demand_info_agent.expired_date);
                    $('#advertised option[value="'+dataResult.demand_info_agent.advertised+'"]').prop('selected', true);
                    $('#status option[value="'+dataResult.demand_info_agent.status+'"]').prop('selected', true);
                    $('#doc_status').attr('value',dataResult.demand_info_agent.doc_status);
                    $('#num_of_pax').attr('value',dataResult.demand_info_agent.num_of_pax);
                    $('#doc_received_date').attr('value',dataResult.demand_info_agent.doc_received_date);
                    $('#doc_status_remarks').text(dataResult.demand_info_agent.doc_status_remarks);

                    setTimeout(function () {
                        $('#country_state_id').val(dataResult.demand_info_agent.country_state_id).trigger('change');
                    }, 1000);

                    $('.updatedemand').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });

        //for job to demand clicks
        $(document).on('click','.action-jobs-edit', function (e) {
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_job_demand").modal("toggle");
                    $('#demand_information_id option[value="'+dataResult.job_demand_edit.demand_information_id+'"]').prop('selected', true);
                    if(dataResult.job_demand_edit.job_status == "complete"){
                        $('#job_status').prop('checked', true);
                    }
                    $('#company_name_jobs').attr('value',dataResult.job_demand_edit.demand_information.demand_company.title);
                    if (dataResult.job_demand_edit.demand_information.demand_company){
                        let company = dataResult.job_demand_edit.demand_information.demand_company;
                        let value = '';
                        if (company.overseas_agent_id){
                            value = company.overseas_agent.company_name ?? company.overseas_agent.fullname ?? '';
                        }else{
                            value = company.title;
                        }

                        $('#client_name').attr('value',value);
                    }                    $('#job_category_id option[value="'+dataResult.job_demand_edit.job_category_id+'"]').prop('selected', true);
                    $('#requirements').attr('value',dataResult.job_demand_edit.requirements);
                    $('#min_qualification option[value="'+dataResult.job_demand_edit.min_qualification+'"]').prop('selected', true);
                    $('#contact_period').attr('value',dataResult.job_demand_edit.contact_period);
                    $('#working').attr('value',dataResult.job_demand_edit.working);
                    $('#holidays').attr('value',dataResult.job_demand_edit.holidays);
                    $('#hours').attr('value',dataResult.job_demand_edit.hours);
                    $('#salary').attr('value',dataResult.job_demand_edit.salary);
                    $('#overtime_per_month').attr('value',dataResult.job_demand_edit.overtime_per_month);
                    $('#currency option[value="'+dataResult.job_demand_edit.currency+'"]').prop('selected', true);
                    $('#accommodation option[value="'+dataResult.job_demand_edit.accommodation+'"]').prop('selected', true);
                    $('#food_facilities option[value="'+dataResult.job_demand_edit.food_facilities+'"]').prop('selected', true);
                    $('#ticket option[value="'+dataResult.job_demand_edit.ticket+'"]').prop('selected', true);
                    $('#overtime option[value="'+dataResult.job_demand_edit.overtime+'"]').prop('selected', true);
                    $('#medical_in option[value="'+dataResult.job_demand_edit.medical_in+'"]').prop('selected', true);
                    $('#medical_company option[value="'+dataResult.job_demand_edit.medical_company+'"]').prop('selected', true);
                    $('#insurance_in option[value="'+dataResult.job_demand_edit.insurance_in+'"]').prop('selected', true);
                    $('#insurance_company option[value="'+dataResult.job_demand_edit.insurance_company+'"]').prop('selected', true);
                    if(dataResult.job_demand_edit.levy == "yes"){
                        $('#levy').prop('checked', true);
                    }
                    $('#levy_amount').attr('value',dataResult.job_demand_edit.levy_amount);
                    $('#remarks').text(dataResult.job_demand_edit.remarks);
                    $('.updatejobsdemand').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });

        });

        $(document).on('click','.action-jobs-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $('#view-ref-no').text(dataResult.demand_information.ref_no);
                    $('#view-job-category').text(dataResult.job_category.name);
                    $('#view-job-status').text(dataResult.job_status);
                    $('#view-requirements').text(dataResult.requirements+" per person");
                    $('#view-min-qualification').text(dataResult.min_qualification);
                    $('#view-contact-period').text(dataResult.contact_period+" per year");
                    $('#view-working').text(dataResult.working+" per weeks/days");
                    $('#view-holidays').text(dataResult.holidays+" per days/year");
                    $('#view-hours').text(dataResult.hours+" per days");
                    $('#view-salary').text(dataResult.salary+" per month");
                    $('#view-overtime').text(dataResult.overtime);
                    $('#view-overtime-per-month').text(dataResult.overtime_per_month+" per month");
                    $('#view-currency').text(dataResult.currency);
                    $('#view-accommodation').text(dataResult.accommodation);
                    $('#view-food-facilities').text(dataResult.food_facilities);
                    $('#view-ticket').text(dataResult.ticket);
                    $('#view-medical-in').text(dataResult.medical_in);
                    $('#view-medical-company').text(dataResult.medical_company);
                    $('#view-insurance-in').text(dataResult.insurance_in);
                    $('#view-insurance-company').text(dataResult.insurance_company);
                    $('#view-levy').text(dataResult.levy);
                    $('#view-levy-amount').text(dataResult.levy_amount);
                    $('#view-remarks').text(dataResult.remarks);
                }
            });
        });

        $(document).on('click','.action-jobs-delete', function (e) {
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
                        // toastr.success('file deleted Successfully');
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

        $(document).on('change','select[name="demand_information_id"]', function (e) {
            e.preventDefault();
            var value=$(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('jobs.demand-info') }}",
                data: {'demand_id':value},
                success: function(data) {
                    $('.select-company').val(data.demand_company.title);
                    $('.select-client-name').attr('value',data.overseas_agent.fullname);
                },
                error: function() {
                    swal({
                        title: 'Jobs to Demand error',
                        text: "Error. Could not confirm the status of the demand info.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });

        });

        $(document).on('change','select[name="company_id"]', function (e) {
            e.preventDefault();
            var value   = $(this).val();
            var data_id = $(this).attr('data-id');

            $.ajax({
                type: "GET",
                url: "{{ route('demand-info.company_related_states') }}",
                data: {'company_id':value},
                success: function(data) {

                    if (data_id == 'create'){
                        var selectField = $('.country_state_id');
                    }else{
                        var selectField = $('#country_state_id');
                    }

                    // Clear existing options
                    selectField.empty();

                    // Add a default option
                    selectField.append('<option value="">Select State</option>');

                    // Loop through the data and add options to the select field
                    $.each(data.states, function (index, item) {
                        selectField.append('<option value="' + index + '">' + item + '</option>');
                    });
                },
                error: function() {
                    swal({
                        title: 'Fetching states error',
                        text: "Error. Could not confirm the status of the Company related states.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });

        });

    </script>
@endsection
