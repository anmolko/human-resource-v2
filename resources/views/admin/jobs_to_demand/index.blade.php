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
    @include('admin.jobs_to_demand.partials.script')
@endsection
