@extends('layouts.master')
@section('title') Complain Manager @endsection
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
                    <h3 class="page-title">Complain Manager</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('complain-manager.index')}}">Complain Manager</a></li>
                        <li class="breadcrumb-item active">Complain Manager Trash</li>
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
                    <!-- Complain Manager Trash Table -->
                    <table id="complain_manager" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Candidate Name</th>
                            <th>Passport number</th>
                            <th>Job Category</th>
                            <th>Company</th>
                            <th>Assignee</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($trashed as $trash)
                            <tr>
                                <td> {{$i++}}          </td>
                                <td><a href="{{route('candidate-personal-info.addalldetails',$trash->candidate_info_id)}}">{{ucwords(\App\Models\CandidatePersonalInformation::find($trash->candidate_info_id)->candidate_firstname)}} {{ucwords(\App\Models\CandidatePersonalInformation::find($trash->candidate_info_id)->candidate_lastname)}}</a></td>
                                <td>{{ucwords(@$trash->passport_num)}}</td>
                                <td>{{ucwords(@$trash->job_category)}}</td>
                                <td>{{ucwords(@$trash->company)}}</td>
                                <td>{{ucwords(@\App\Models\Employee::find($trash->employee_id)->user->name)}}</td>
                                <td class="text-right">
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-restore" href="#" hrm-restore-action="{{route('complain-manager.restore',$trash->id)}}" data-toggle="modal" data-target="#restore_complain_manager">
                                                    <i class="fa fa-refresh align-bottom me-2 text-muted"></i></a></li>

                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-per-delete" href="#"  hrm-delete-per-action="{{route('complain-manager.remove',$trash->id)}}">
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
                    <!-- /complain manager Table -->

                </div>
            </div>
        </div>


    </div>
    <!-- /Page Content -->

    <!-- Restore complain manager Modal -->
    @include('admin.modals.complain_manager.restore')
    <!-- /Restore complain manager Modal -->

@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#complain_manager').DataTable({
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
                        swal("Deleted!", "Deleted Successfully", "success");
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

        $(document).on('click','.action-restore', function (e) {
            e.preventDefault();
            var action = $(this).attr('hrm-restore-action');
            $('.restore-link').attr('href',action);
        })

    </script>
@endsection
