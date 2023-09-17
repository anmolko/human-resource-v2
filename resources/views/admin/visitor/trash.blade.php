@extends('layouts.master')
@section('title') Visitor @endsection
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
                            <h3 class="page-title">Visitor</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('visitor.index')}}">Visitor</a></li>
                                <li class="breadcrumb-item active">Visitor Trash</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form action="#" method="post" id="deleted-form" >
                                {{csrf_field()}}
                                <input name="_method" type="hidden" value="DELETE">

                            </form>
                            <!-- Visitor  Table -->
                            <table id="visitor" class="table table-striped custom-table mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Visitor Name & ID</th>
                                        <th>Mobile No.</th>
                                        <th>Employee Name</th>
                                        <th>Designation</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach($trashed as $trash)
                                    <tr>
                                        <td> {{$i++}}          </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="#" class="avatar">
                                                    <img alt="{{$trash->visitor_name}}" src="<?php if(!empty($trash->image)){ echo '/images/visitor/'.$trash->image; } else { echo '/images/profiles/male.png'; } ?>" />
                                                </a>
                                                <a href="#">{{ucwords(@$trash->visitor_name)}}
                                                <span>  {{@$trash->visitor_id}}
                                                                </span></a>
                                            </h2>
                                        </td>
                                        <td>{{ucwords(@$trash->mobile_no)}}</td>
                                        <td>{{ucwords(@$trash->employee->user->name)}}</td>
                                        <td>{{ucwords(@$trash->employee->designation->name)}}</td>

                                        <td class="text-right">
                                            <div class="flex-shrink-0 ms-4">
                                                <ul class="list-inline tasks-list-menu mb-0">
                                                    <li class="list-inline-item">
                                                        <a class="action-restore" href="#" hrm-restore-action="{{route('visitor.restore',$trash->id)}}" data-toggle="modal" data-target="#restore_visitor">
                                                            <i class="fa fa-refresh align-bottom me-2 text-muted"></i></a></li>

                                                    <li class="list-inline-item">
                                                        <a class="remove-item-btn action-per-delete" href="#" hrm-delete-per-action="{{route('visitor.remove',$trash->id)}}">
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
                            <!-- /Visitor  Table -->

                        </div>
                    </div>
                </div>


        </div>
            <!-- /Page Content -->

             <!-- Restore Visitor Modal -->
             @include('admin.modals.visitor.restore')
            <!-- /Restore Visitor  Modal -->

@endsection

@section('js')

<script type="text/javascript">
       $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#visitor').DataTable({
                    paging: true,
                    searching: true,
                    ordering:  true,
                    lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
        });

    $(document).on('click','.action-per-delete', function (e) {
    e.preventDefault();
        var form = $('#deleted-form');
        var action = $(this).attr('hrm-delete-per-action');
        form.attr('action',$(this).attr('hrm-delete-per-action'));
        $url = form.attr('action');
        var form_data = form.serialize();
        // $('.deleterole').attr('action',action);
        swal({
            title: "Are You Sure?",
            text: "You will not be able to recover this",
            type: "info",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function(){
            $.post( $url, form_data)
            .done(function(response) {
                if(response == 0){
                swal({
                    title: "Warning.",
                    text: "You need to Remove Assigned  Entry",
                    type: "info",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }, function(){
                    //window.location.href = ""
                    swal.close();
                })

                }else{

                swal("Deleted!", "Deleted Successfully", "success");
                // toastr.success('file deleted Successfully');
                $(response).remove();
                window.location.reload();
                }

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

    $(document).on('click','.action-restore', function (e) {
    e.preventDefault();
        var action = $(this).attr('hrm-restore-action');
        $('.restore-link').attr('href',action);
    })

</script>
@endsection
