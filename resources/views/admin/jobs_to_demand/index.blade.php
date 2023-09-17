@extends('layouts.master')
@section('title')Add Job to Demand @endsection
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
                    <h3 class="page-title">Job to Demand</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Job to Demand</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_job_demand"><i class="fa fa-plus"></i>Add Job to Demand</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('job-to-demand.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <table id="jobdemand-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>Job Category</th>
                            <th>Demand Info</th>
                            <th>Requirements</th>
                            <th>Contact Period</th>
                            <th>Salary</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($job_demand as $jd)
                            <tr>
                                <td>{{ucwords(\App\Models\JobCategory::find(@$jd->job_category_id)->name)}} </td>
                                <td>{{ucwords(\App\Models\DemandInformation::find(@$jd->demand_information_id)->ref_no)}}</td>
                                <td>{{ucwords(@$jd->requirements ?? '')}}</td>
                                <td>{{ucwords(@$jd->contact_period ?? '')}}</td>
                                <td>{{ucwords(@$jd->salary ?? '')}}</td>
                                <td>{{ucwords(@$jd->remarks ?? '')}}</td>
                                <td>
                                    <div class="dropdown">

                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            {{(($jd->job_status == "complete") ? "Complete":"Incomplete")}}
                                        </a>
                                        <div class="dropdown-menu">
                                            @if($jd->job_status == "complete")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('job-to-demand.status.update',$jd->id)}}" href="#" id="incomplete">Incomplete</a>
                                            @else
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('job-to-demand.status.update',$jd->id)}}" href="#" id="complete">Complete</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
{{--                                    <div class="dropdown dropdown-action">--}}
{{--                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <a class="dropdown-item action-view" href="#" hrm-view-action="{{route('job-to-demand.show',$jd->id)}}" data-toggle="modal" data-target="#view_job_demand" id="{{$jd->id}}"><i class="fa fa-eye m-r-5"></i> View More Info</a>--}}
{{--                                            <a class="dropdown-item action-edit" href="#" id="{{$jd->id}}" hrm-update-action="{{route('job-to-demand.update',$jd->id)}}"  hrm-edit-action="{{route('job-to-demand.edit',$jd->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('job-to-demand.destroy',$jd->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-view" hrm-view-action="{{route('job-to-demand.show',$jd->id)}}" data-toggle="modal" data-target="#view_job_demand" id="{{$jd->id}}">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{$jd->id}}" hrm-update-action="{{route('job-to-demand.update',$jd->id)}}"  hrm-edit-action="{{route('job-to-demand.edit',$jd->id)}}" data-toggle="modal" >
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#"   hrm-delete-action="{{route('job-to-demand.destroy',$jd->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i>
                                                </a>
                                            </li>
                                        </ul>
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

    <!-- Add Jobs to Demand Info Modal -->
    @include('admin.modals.jobs_to_demand.add')
    <!-- /Add Demand Info Modal -->

    <!-- update Jobs to Demand Info Modal -->
    @include('admin.modals.jobs_to_demand.edit')
    <!-- /update Demand Info Modal -->

    <!-- View jobs to demand Modal -->
    @include('admin.modals.jobs_to_demand.view')
    <!-- /View jobs to demand Modal -->

 <!-- Forbidden Attribute Modal -->
 @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Attribute Modal -->

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#jobdemand-index').DataTable({
                paging: true,
                searching: true,
                ordering:  false,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
            $( ".select2" ).select2({
                width:'100%'
            });

        });

        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == "discontinued"){
                swal({
                    title: "Are You Sure?",
                    text: "The overseas agent status to Dis-continued will prevent them from displaying in Demand Entry in. \n \n Set their status to continued to enable the displaying in Demand Entry!",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    statusupdate(url,status);
                });
            }else{
                statusupdate(url,status);
            }

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
                    $("#edit_job_demand").modal("toggle");
                    $('#demand_information_id option[value="'+dataResult.job_demand_edit.demand_information_id+'"]').prop('selected', true);
                    if(dataResult.job_demand_edit.job_status == "complete"){
                        $('#job_status').prop('checked', true);
                    }
                    $('#company_name_jobs').attr('value',dataResult.job_demand_edit.demand_information.demand_company ? dataResult.job_demand_edit.demand_information.demand_company.title:'');

                    if (dataResult.job_demand_edit.demand_information.demand_company){
                        let company = dataResult.job_demand_edit.demand_information.demand_company;
                        let value = '';
                        if (company.overseas_agent_id){
                            value = company.overseas_agent.company_name ?? company.overseas_agent.fullname ?? '';
                        }else{
                            value = company.title;
                        }

                        $('#client_name').attr('value',value);
                    }

                    // $('#client_name').attr('value',dataResult.job_demand_edit.demand_information);

                    $('#job_category_id option[value="'+dataResult.job_demand_edit.job_category_id+'"]').prop('selected', true);
                    $('#requirements').attr('value',dataResult.job_demand_edit.requirements);
                    $('#min_qualification option[value="'+dataResult.job_demand_edit.min_qualification+'"]').prop('selected', true);
                    $('#contact_period').attr('value',dataResult.job_demand_edit.contact_period);
                    $('#working').attr('value',dataResult.job_demand_edit.working);
                    $('#holidays').attr('value',dataResult.job_demand_edit.holidays);
                    $('#hours').attr('value',dataResult.job_demand_edit.hours);
                    $('#salary').attr('value',dataResult.job_demand_edit.salary);
                    $('#category_amount').attr('value',dataResult.job_demand_edit.category_amount);

                    $('#commission_amount').attr('value',dataResult.job_demand_edit.commission_amount);

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

        $(document).on('click','.action-view', function (e) {
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


        $(document).on('change','select[name="demand_information_id"]', function (e) {
            e.preventDefault();
            var value=$(this).val();
            console.log(value);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                type: "POST",
                url: "{{ route('jobs.demand-info') }}",
                data: {'demand_id':value},
                success: function(data) {
                    console.log(data.demand_company.title);
                    $('.select-company').val(data.demand_company.title);
                    if (data.demand_company){
                        let company = data.demand_company;
                        let value = '';
                        if (company.overseas_agent_id){
                            value = company.overseas_agent.fullname ?? company.overseas_agent.company_name ?? '';
                        }else{
                            value = company.title;
                        }

                        $('.').attr('value',value);
                    }
                    // $('.select-client-name').attr('value',data.overseas_agent.fullname);
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

        function statusupdate(url,status){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "PATCH",
                cache: false,
                data:{
                    job_status: status,
                },
                success: function(dataResult){
                    if(dataResult == "yes"){
                        swal("Success!", "Job To Demand Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Job To Demand status",
                            type: "error",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        }, function(){
                            //window.location.href = ""
                            swal.close();
                        })
                    }
                },
                error: function() {
                    swal({
                        title: 'Job To Demand  Warning',
                        text: "Error. Could not confirm the status of the job To demand .",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        }
    </script>
@endsection
