@extends('layouts.master')
@section('title') Dashboard @endsection
@section('css')

<style>
    .avatar > img {
        height: 100%;
    }
    #select2-gender-container{
        text-transform: capitalize;
    }

    #select2-role_id-container{
        text-transform: capitalize;
    }
    .capital{
        text-transform: capitalize;
    }
    .title {
        text-transform: capitalize;
    }
    span.task-label {
        text-transform: capitalize;
    }
    i.white {
        color: #fff !important;
    }
</style>
    @endsection
@section('content')

    <div class="custom-content container-fluid">



        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{greeting_msg()}},  {{ ucfirst(Auth::user()->name)}} !</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Main Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="las la-user-friends"></i></span>
                        <div class="dash-widget-info">
                            @if($candidate_total > 0 )
                                <h3>{{$candidate_total}}</h3>
                            @else
                                <h3>0</h3>
                            @endif
                            <span>No. of Candidates</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="las la-retweet"></i></span>
                        <div class="dash-widget-info">
                            @if($reference_total > 0 )
                                <h3>{{$reference_total}}</h3>
                            @else
                                <h3>0</h3>
                            @endif
                            <span>No. of References</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="las la-file-import"></i></span>
                        <div class="dash-widget-info">
                            @if(@$demand_total > 0 )
                                <h3>{{@$demand_total}}</h3>
                            @else
                                <h3>0</h3>
                            @endif
                            <span>No. of Demands</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="las la-user-secret"></i></span>
                        <div class="dash-widget-info">
                            @if(@$overseas_total > 0 )
                                <h3>{{@$overseas_total}}</h3>
                            @else
                                <h3>0</h3>
                            @endif
                            <span>Overseas Agent</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Reference Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($reference_information) > 0 )

                                    @foreach($reference_information as $reference)

                                        <tr>
                                            <td><a href="{{route('reference-info.show',$reference->id)}}">
                                                    {{ucwords(@$reference->name)}}
                                                </a></td>

                                            <td>{{@$reference->email}}</td>
                                            <td> @if ($reference->status=='continued')
                                                    <i class="fa fa-dot-circle-o text-success"></i> Continued
                                                @else
                                                    <i class="fa fa-dot-circle-o text-danger"></i> Discontinued
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No reference information created yet. Click <a href="{{route('reference-info.index')}}"> here </a> to create one.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('reference-info.index')}}" class="capital">View all Reference Information</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Candidate Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Contact</th>
                                    <th>Created By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($candidate_information) > 0 )
                                    @foreach($candidate_information as $candidate)
                                        <tr>
                                            <td>{{ucwords(@$candidate->candidate_firstname)}} {{ucwords(@$candidate->candidate_middlename)}} {{ucwords(@$candidate->candidate_lastname)}}</td>

                                            <td>{{@$candidate->contact_no}}</td>
                                            <td>
                                                <span class="badge bg-inverse-warning">{{ucwords( $candidate->createdBy() ? $candidate->createdBy()->name :'' )}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No Candidate created yet.
                                            Click <a href="{{route('candidate-personal-info.index')}}"> here </a> to create one.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('candidate-personal-info.index')}}" class="capital">View all Candidate Informations</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Overseas Agent</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($overseas_agent) > 0 )

                                    @foreach($overseas_agent as $agent)

                                        <tr>
                                            <td><a href="{{route('overseas-agent.show',$agent->client_no)}}">{{ucwords(@$agent->fullname)}}</a></td>

                                            <td>{{ucwords(@$agent->company_name)}}</td>
                                            <td> @if ($agent->status=='continued')
                                                    <i class="fa fa-dot-circle-o text-success"></i> Continued
                                                @else
                                                    <i class="fa fa-dot-circle-o text-danger"></i> Discontinued
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No overseas agent created yet. Click <a href="{{route('overseas-agent.index')}}"> here </a> to create one.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('overseas-agent.index')}}" class="capital">View all Overseas Agent</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Demand Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>Ref No.</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($demand_information) > 0 )
                                    @foreach($demand_information as $demand)
                                        <tr>
                                            <td><a href="{{route('demand-info.show',$demand->id)}}">{{$demand->ref_no}}</a></td>
                                            <td>{{\Carbon\Carbon::parse($demand->expired_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                            <td>{{str_replace('-', ' ', ucwords($demand->status))}}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No demand information created yet. Click <a href="{{route('demand-info.index')}}"> here </a> to create one.</td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('demand-info.index')}}" class="capital">View all Demand Informations </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
