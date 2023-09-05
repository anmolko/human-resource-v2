@extends('layouts.account_master')
@section('title') Single Secondary Group @endsection
@section('css')
<style>
.personal-info{
    display: grid;
}
.personal-info li .title{
    width:40%;
}
.report-groups{
        margin-top:20px;
        margin-bottom:10px;
    }
</style>

@endsection
@section('content')
  <!-- Page Content -->
  <div class="content container-fluid">

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Single Secondary Group</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('secondary-groups.index')}}">Secondary Groups</a></li>
                <li class="breadcrumb-item active">Single Secondary Group</li>
            </ul>
        </div>

    </div>
</div>
<!-- /Page Header -->

<!-- <div class="row align-items-center report-groups">
    <div class="col">
    </div>
    <div class="col-auto float-right ml-auto">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white" onclick="printerDiv('single-secondary-data')"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
</div> -->

<div class="row" id="single-secondary-data">
    <div class="col-md-6 d-flex">
        <div class="card profile-box flex-fill">
            <div class="card-body">
                <h3 class="card-title">{{ucwords(@$singlesecondary_group->name)}} Informations </h3>
                <ul class="personal-info">

                    <li>
                        <div class="title">Primary Group Name:</div>
                        <div class="text"> {{ucwords(@$singlesecondary_group->primaryGroup->name)}}</div>
                    </li>

                   <li>
                        <div class="title">Secondary Group Name:</div>
                        <div class="text"> {{ucwords(@$singlesecondary_group->name)}}</div>
                    </li>

                        <li>
                        <div class="title">Status:</div>
                        <div class="text"> @if (@$singlesecondary_group->status==1)
                                         Active
                                    @else
                                        Inactive
                                    @endif
                                    </div>
                    </li>
                        <li>
                        <div class="title">Created By:</div>
                        <div class="text"> {{ucwords(App\Models\User::find(@$singlesecondary_group->created_by)->name)}}</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6 d-flex">
        <div class="card profile-box flex-fill">
            <div class="card-body">
                <h3 class="card-title">Selected Attributes Informations </h3>
                <ul class="personal-info">
                @foreach(@$singlesecondary_group->secondaryAttributes as $secondary_attr)
                    <li>
                        <div class="title">{{ucwords(@$secondary_attr->attributes->name)}}</div>
                        <div class="text"> {{$secondary_attr->value}}</div>
                    </li>
                   @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /Page Content -->
@endsection
@section('js')
    <script type="text/javascript">
    function printerDiv(divID) {
        var divElements = document.getElementById(divID).innerHTML;
        var oldPage = document.body.innerHTML;
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }
    </script>
@endsection


