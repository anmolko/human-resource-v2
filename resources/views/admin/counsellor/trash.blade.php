@extends('layouts.master')
@section('title') Counsellor @endsection
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
                            <h3 class="page-title">Counsellor</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('counsellor.index')}}">Counsellor</a></li>
                                <li class="breadcrumb-item active">Counsellor Trash</li>
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
                            <!-- Counsellor Table -->
                            <table id="counsellor" class="table table-striped custom-table mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Caller Name</th>
                                        <th>Response</th>
                                        <th >Response Via</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach($trashed as $trash)
                                    <tr>
                                        <td> {{$i++}}          </td>
                                        <td>{{ucwords($trash->agent->fullname)}}</td>
                                        <td>{{$trash->response}}</td>
                                        <td class="text-uppercase">{{$trash->response_via}}</td>

                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item action-restore" href="#"  hrm-restore-action="{{route('counsellor.restore',$trash->id)}}" data-toggle="modal" data-target="#restore_counsellor"><i class="fa fa-refresh m-r-5"></i> Restore</a>
                                                    <a class="dropdown-item action-per-delete" href="#"  hrm-delete-per-action="{{route('counsellor.remove',$trash->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach


                                </tbody>
                            </table>
                            <!-- /Counsellor Table -->

                        </div>
                    </div>
                </div>


        </div>
            <!-- /Page Content -->

             <!-- Restore Counsellor Modal -->
             @include('admin.modals.counsellor.restore')
            <!-- /Restore Counsellor Modal -->

@endsection

@section('js')

<script type="text/javascript">
       $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#counsellor').DataTable({
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
