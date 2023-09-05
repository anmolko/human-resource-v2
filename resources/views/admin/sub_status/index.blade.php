@extends('layouts.entry_master')
@section('title') Sub Status @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
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
                    <h3 class="page-title">Sub Status</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Sub Status</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_sub_status"><i class="fa fa-plus"></i> Add Sub Status</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('sub-status.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Sub Status Table -->
                    <table id="sub-status-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($substatus as $substat)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$substat->name)}}</td>
                                <td> @if (@$substat->status==1)
                                        <i class="fa fa-dot-circle-o text-success"></i> Active
                                    @else
                                        <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                    @endif
                                </td>
                                <td> {{ucwords(App\Models\User::find(@$substat->created_by)->name)}}</td>
                                <td class="text-right">
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">

                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{@$substat->id}}" hrm-update-action="{{route('sub-status.update',@$substat->id)}}"  hrm-edit-action="{{route('sub-status.edit',@$substat->id)}}" data-toggle="modal">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('sub-status.destroy',@$substat->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Sub Status Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Sub Status Modal -->
    @include('admin.modals.sub_status.add')
    <!-- /Add Sub Status Modal -->

    <!-- edit Sub Status Modal -->
    @include('admin.modals.sub_status.edit')
    <!-- /edit Sub Status Modal -->

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
            $('#sub-status-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

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
                        if(response == 0){
                            swal({
                                title: "Warning!",
                                text: "You need to Remove Assigned  First",
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                            }, function(){
                                //window.location.href = ""
                                swal.close();
                            })
                        }else{
                            swal("Trashed!", "Moved to Trash Successfully", "success");
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

        $(document).on('click','.action-edit', function (e) {
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
                    console.log(dataResult)
                    $("#edit_sub_status").modal("toggle");
                    $('.updatename').attr('value',dataResult.name);
                    $('input[name="status"]').filter('[value="'+dataResult.status+'"]').prop('checked', true);
                    $('.updatesubstatus').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });
    </script>
@endsection
