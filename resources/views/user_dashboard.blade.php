@extends('layouts.user_management_master')
@section('title') User Dashboard @endsection
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

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">{{greeting_msg()}},  {{ ucfirst(Auth::user()->name)}}  !</h3>
                    <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item active">User Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-cubes"></i></span>
                        <div class="dash-widget-info">
                            @if($journal_total > 0 )
                            <h3>{{$journal_total}}</h3>
                            @else
                            <h3>0</h3>
                            @endif
                            <span>Journal Entries</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-file-text"></i></span>
                        <div class="dash-widget-info">
                            @if($receipt_total > 0 )
                            <h3>{{$receipt_total}}</h3>
                            @else
                            <h3>0</h3>
                            @endif
                            <span>Receipt Vouchers</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-credit-card"></i></span>
                        <div class="dash-widget-info">
                            @if($payment_total > 0 )
                            <h3>{{$payment_total}}</h3>
                            @else
                            <h3>0</h3>
                            @endif
                            <span>Payment Vouchers</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa fa-clone"></i></span>
                        <div class="dash-widget-info">
                            @if($contra_total > 0 )
                            <h3>{{$contra_total}}</h3>
                            @else
                            <h3>0</h3>
                            @endif
                            <span>Contra Vouchers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--
        <div class="row">
            <div class="col-md-12">
                <div class="card-group m-b-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">New Employees</span>
                                </div>
                                <div>
                                    <span class="text-success">+10%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">10</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Overall Employees 218</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Earnings</span>
                                </div>
                                <div>
                                    <span class="text-success">+12.5%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">$1,42,300</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month <span class="text-muted">$1,15,852</span></p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Expenses</span>
                                </div>
                                <div>
                                    <span class="text-danger">-2.8%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">$8,500</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month <span class="text-muted">$7,500</span></p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Profit</span>
                                </div>
                                <div>
                                    <span class="text-danger">-75%</span>
                                </div>
                            </div>
                            <h3 class="mb-3">$1,12,000</h3>
                            <div class="progress mb-2" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mb-0">Previous Month <span class="text-muted">$1,42,000</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Payment Voucher</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>Voucher ID</th>
                                    <th>Date</th>
                                    <th>Closing Balance</th>
                                    <th>Created By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($payment_voucher) > 0 )

                                    @foreach($payment_voucher as $payment)

                                    <tr>
                                        <td><a href="{{route('payment-voucher.print',$payment->ref_no)}}">{{@$payment->ref_no}}</a></td>
                                        <?php if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $payment->date);
                                            echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                    <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                        <td>{{date('j F, Y',strtotime(@$payment->date))}}</td>
                                        <?php }else{?>
                                        <td>{{date('j F, Y',strtotime(@$payment->date))}}</td>
                                        <?php }?>
                                        <td>{{ucwords(@$payment->total_amount)}}</td>
                                        <td>
                                            <span class="badge bg-inverse-warning">{{ucwords(App\Models\User::find(@$payment->created_by)->name)}}</span>
                                        </td>
                                    </tr>
                                @endforeach

                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No vouchers created yet. Click <a href="{{route('payment-voucher.create')}}"> here </a> to create one.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('payment-voucher.index')}}" class="capital">View all Payment Vouchers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Receipt Voucher</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>Voucher ID</th>
                                    <th>Date</th>
                                    <th>Closing Balance</th>
                                    <th>Created By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($receipt_voucher) > 0 )
                                    @foreach($receipt_voucher as $receipt)
                                    <tr>
                                        <td><a href="{{route('receipt-voucher.print',$receipt->ref_no)}}">{{@$receipt->ref_no}}</a></td>
                                        <?php if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $payment->date);
                                            echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                            <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                        <td>{{date('j F, Y',strtotime(@$receipt->date))}}</td>
                                            <?php }else{?>
                                        <td>{{date('j F, Y',strtotime(@$receipt->date))}}</td>
                                            <?php }?>
                                        <td>{{ucwords(@$receipt->total_amount)}}</td>
                                        <td>
                                            <span class="badge bg-inverse-warning">{{ucwords(App\Models\User::find($receipt->created_by)->name)}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No vouchers created yet. Click <a href="{{route('contra-voucher.create')}}"> here </a> to create one.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('receipt-voucher.index')}}" class="capital">View all Receipt Vouchers</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent User</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($recent_user) > 0 )
                                    @foreach(@$recent_user as $user)
                                    <tr>
                                    <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar action-view" href="" hrm-view-action="{{route('user.show',$user->id)}}" data-toggle="modal" data-target="#view_user">
                                            <img alt="{{$user->name}}" src="<?php if(!empty($user->image)){ echo '/images/user/'.$user->image; } else { if($user->gender=="male") {echo '/images/profiles/male.png'; } elseif($user->gender=="female") {echo '/images/profiles/female.png'; } elseif($user->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                        </a>
                                        <a class="action-view" href="" hrm-view-action="{{route('user.show',$user->id)}}" data-toggle="modal" data-target="#view_user">{{ucfirst($user->name)}}
                                            <span>
                                                        @foreach($user->roles as $roles)
                                                    {{ucfirst(\App\Models\Role::find($roles->id)->name)}}
                                                @endforeach
                                                    </span></a>
                                    </h2>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <div class="dropdown">

                                            <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                {{(($user->status == 0) ? "De-active":"Active")}}
                                            </a>
                                            <div class="dropdown-menu">
                                                @if($user->status == 0)
                                                    <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$user->id)}}" href="#" id="1">Active</a>
                                                @else
                                                    <a class="dropdown-item status-update" hrm-update-action="{{route('user-status.update',$user->id)}}" href="#" id="0">De-active</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item action-view" href="#" hrm-view-action="{{route('user.show',$user->id)}}" data-toggle="modal" data-target="#view_user"><i class="fa fa-eye m-r-5"></i> View </a>
                                                <a class="dropdown-item action-edits" href="#" hrm-update-action="{{route('user.update',$user->id)}}"  hrm-edit-action="{{route('user.edit',$user->id)}}" data-toggle="modal" data-target="#edit_user"><i class="fa fa-edit m-r-5"></i> Edit </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center cap">No Users created yet. Click <a href="{{route('user.index')}}"> here </a> to create one.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('user.index')}}" class="capital">View all Users</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recent Contra Voucher</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0">
                                <thead>
                                <tr>
                                    <th>Voucher ID</th>
                                    <th>Date</th>
                                    <th>Closing Balance</th>
                                    <th>Created By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($contra_voucher) > 0 )
                                @foreach($contra_voucher as $contra)
                                    <tr>
                                    <td><a href="{{route('contra-voucher.print',$contra->ref_no)}}">{{$contra->ref_no}}</a></td>
                                        <?php if(@$theme_data->default_date_format=='nepali'){
                                            $pieces = explode("-", $contra->date);
                                            echo '<td>'.$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0].'</td>';?>
                                    <?php }else if(@$theme_data->default_date_format=='english'){ ?>
                                        <td>{{date('j F, Y',strtotime(@$contra->date))}}</td>
                                        <?php }else{?>
                                        <td>{{date('j F, Y',strtotime(@$contra->date))}}</td>
                                        <?php }?>
                                    <td>{{ucwords(@$contra->total_amount)}}</td>
                                    <td>
                                        <span class="badge bg-inverse-warning">{{ucwords(App\Models\User::find($contra->created_by)->name)}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" class="text-center">No vouchers created yet. Click <a href="{{route('contra-voucher.create')}}"> here </a> to create one.</td>
                                    </tr>

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('contra-voucher.index')}}" class="capital">View all Contra vouchers</a>
                    </div>
                </div>
            </div>
        </div>

{{--        <div class="row">--}}
{{--            <div class="col-md-12 d-flex">--}}
{{--                <div class="card card-table flex-fill">--}}
{{--                    <div class="card-header">--}}
{{--                        <h3 class="card-title mb-0">Recent Projects</h3>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table custom-table mb-0">--}}
{{--                                <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Project Name </th>--}}
{{--                                        <th>Progress</th>--}}
{{--                                        <th class="text-right">Action</th>--}}
{{--                                    </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <h2><a href="project-view.php">Office Management</a></h2>--}}
{{--                                            <small class="block text-ellipsis">--}}
{{--                                                <span>1</span> <span class="text-muted">open tasks, </span>--}}
{{--                                                <span>9</span> <span class="text-muted">tasks completed</span>--}}
{{--                                            </small>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="progress progress-xs progress-striped">--}}
{{--                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <h2><a href="project-view.php">Project Management</a></h2>--}}
{{--                                            <small class="block text-ellipsis">--}}
{{--                                                <span>2</span> <span class="text-muted">open tasks, </span>--}}
{{--                                                <span>5</span> <span class="text-muted">tasks completed</span>--}}
{{--                                            </small>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="progress progress-xs progress-striped">--}}
{{--                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="15%" style="width: 15%"></div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <h2><a href="project-view.php">Video Calling App</a></h2>--}}
{{--                                            <small class="block text-ellipsis">--}}
{{--                                                <span>3</span> <span class="text-muted">open tasks, </span>--}}
{{--                                                <span>3</span> <span class="text-muted">tasks completed</span>--}}
{{--                                            </small>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="progress progress-xs progress-striped">--}}
{{--                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="49%" style="width: 49%"></div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <h2><a href="project-view.php">Hospital Administration</a></h2>--}}
{{--                                            <small class="block text-ellipsis">--}}
{{--                                                <span>12</span> <span class="text-muted">open tasks, </span>--}}
{{--                                                <span>4</span> <span class="text-muted">tasks completed</span>--}}
{{--                                            </small>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="progress progress-xs progress-striped">--}}
{{--                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="88%" style="width: 88%"></div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <h2><a href="project-view.php">Digital Marketplace</a></h2>--}}
{{--                                            <small class="block text-ellipsis">--}}
{{--                                                <span>7</span> <span class="text-muted">open tasks, </span>--}}
{{--                                                <span>14</span> <span class="text-muted">tasks completed</span>--}}
{{--                                            </small>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <div class="progress progress-xs progress-striped">--}}
{{--                                                <div class="progress-bar" role="progressbar" data-toggle="tooltip" title="100%" style="width: 100%"></div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                    <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <a href="projects.php">View all projects</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>


    <!-- Edit User Modal -->
    @include('admin.modals.user.edit')
    <!-- /Edit User Modal -->

    <!-- View User Modal -->
    @include('admin.modals.user.show')
    <!-- /View User Modal -->

@endsection


@section('js')

    <script type="text/javascript">
        var loadEdit = function(event) {
            var image = document.getElementById('image-edit');
            var replacement = document.getElementById('currentedit-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        $(document).ready(function () {
            <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepicker').nepaliDatePicker({
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
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'

            });

            <?php }else{?>
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            <?php }?>

        });


        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == 0){
                swal({
                    title: "Are You Sure?",
                    text: "Setting the user status to De-active will prevent them from logging in. \n \n Set their status to active to enable the login feature!",
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

        $(document).on('click','.action-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);

                    if(dataResult.edituser.image == null && dataResult.edituser.gender === "male"){
                        src = '/images/profiles/male.png';
                    }else if(dataResult.edituser.image == null && dataResult.edituser.gender === "female"){
                        src = '/images/profiles/female.png';
                    }else if(dataResult.edituser.image == null && dataResult.edituser.gender === "others"){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/user/'+dataResult.edituser.image;
                    }
                    $('#user-image').attr('src',src);
                    $('#user-name').text(dataResult.edituser.name);
                    $('#user-role').text('Assigned role: ' + dataResult.userrole.name);
                    $('#user-module').text('Assigned Module: ' + dataResult.modulecount);
                    $('#user-permission').text('Permission Assigned: ' + dataResult.permissioncount);
                    $('#user-dateofjoin').text('Date of Join: ' + dataResult.dateofjoin);
                    $('#user-email').attr('href', 'mailto:'+dataResult.edituser.email);
                    $('#user-contact').attr('href', 'tel:'+dataResult.edituser.contact).text(dataResult.edituser.contact);
                    $('#email-display').text(dataResult.edituser.email).attr('href', 'mailto:'+dataResult.edituser.email);
                    $('#user-dob').text(dataResult.dob);
                    $('#user-gender').text(dataResult.edituser.gender);
                    $('#user-last-active').text(dataResult.last_login);
                    $('#user-status').text((dataResult.edituser.status == 0) ? "De-Active":"Active");
                    var modules_permissions='';
                    $.each(dataResult.userrole.modules, function (index, single_m) {
                        modules_permissions +='<li><div class="title">'+single_m.name+'</div><div class="text">'
                        $.each(single_m.permissions, function (index, single_p) {
                            modules_permissions += '<div class="padding-bottom">'
                                +'<span class="task-action-btn task-check">'
                                + '<span class="action-circle large btn-custom complete-btn" title="">'
                                +'<i class="material-icons white">check</i>'
                                +'</span>'
                                +'</span>'
                                +'<span class="task-label">'+' '+single_p.name+'</span><br/>'
                                +'</div>';
                        });

                        modules_permissions += '</div></li><hr/>';

                    });
                    $('#roles-permission').html(modules_permissions);

                }
            });
        });

        $(document).on('click','.action-edits', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            // console.log(action)
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    var src;
                    var role_id;
                    var role_name;

                    $.each(dataResult.roles, function (index, c) {
                        role_name = c.name;
                        role_id = c.id;
                    });
                    if(dataResult.image == null && dataResult.gender === "male"){
                        src = '/images/profiles/male.png';
                    }else if(dataResult.image == null && dataResult.gender === "female"){
                        src = '/images/profiles/female.png';
                    }else if(dataResult.image == null && dataResult.gender === "others"){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/user/'+dataResult.image;
                    }
                    $('#name').attr('value',dataResult.name);
                    $('.modal-title').text("Update "+dataResult.name+"'s Information");
                    $('#email').attr('value',dataResult.email);
                    $('.dob').attr('value',dataResult.dob);
                    $('#gender option[value="'+dataResult.gender+'"]').prop('selected', true);
                    $('#select2-gender-container').text(dataResult.gender);
                    $('#address').attr('value',dataResult.address);
                    $('#contact').attr('value',dataResult.contact);
                    $('#role_id option[value="'+role_id+'"]').prop('selected', true);
                    $('#select2-role_id-container').text(role_name);
                    $('#currentedit-img').attr('src',src);
                    $('#password').attr('placeholder',"Type here when you want to change password");
                    $('.updateuser').attr('action',action);
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
                    status: status,
                },
                success: function(dataResult){
                    if(dataResult == "yes"){
                        swal("Success!", "User Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update User status",
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
                        title: 'User Management Warning',
                        text: "Error. Could not confirm the status of the user.",
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
