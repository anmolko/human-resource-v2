@extends('layouts.user_management_master')
@section('title') Designation @endsection
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
                    <h3 class="page-title">Designation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('user')}}">User Dashboard</a></li>
                        <li class="breadcrumb-item active">Designation</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i class="fa fa-plus"></i> Add Designation</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('designation.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Designation Table -->
                    <table id="designation-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Department Name</th>
                            <th>Designation Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Created By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($designations as $designation)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$designation->department->name)}}</td>
                                <td>{{ucwords(@$designation->name)}}</td>
                                <td>{{ucwords(@$designation->description)}}</td>
                                
                                <td>
                                        <div class="dropdown">

                                            <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                {{(($designation->status == "active") ? "Active":"Deactive")}}
                                            </a>
                                            <div class="dropdown-menu">
                                                @if(@$designation->status == "active")
                                                    <a class="dropdown-item status-update" hrm-update-action="{{route('designation.status.update',@$designation->id)}}" href="#" id="deactive">Deactive</a>
                                                @else
                                                    <a class="dropdown-item status-update" hrm-update-action="{{route('designation.status.update',@$designation->id)}}" href="#" id="active">Active</a>
                                                @endif
                                            </div>
                                        </div>
                                </td>
                                <td> {{ucwords(App\Models\User::find($designation->created_by)->name)}}</td>
                                
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-edit" href="#" id="{{$designation->id}}" hrm-update-action="{{route('designation.update',$designation->id)}}"  hrm-edit-action="{{route('designation.edit',$designation->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('designation.destroy',$designation->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Designation Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Designation Modal -->
    @include('admin.modals.designation.add')
    <!-- /Add Designation Modal -->

    <!-- edit Designation Modal -->
    @include('admin.modals.designation.edit')
    <!-- /edit Designation Modal -->

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
            $('#designation-index').DataTable({
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
                                text: "You need to Remove Assigned Employee First",
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
                    $("#edit_designation").modal("toggle");
                    $('.updatename').attr('value',dataResult.name);
                    $('.updatedescription').text(dataResult.description);
                    $('select[name="department_id"] option[value="'+dataResult.department.id+'"]').prop('selected', true);
                    $('select[name="status"] option[value="'+dataResult.status+'"]').prop('selected', true);
                    
                    $('.updatedesignation').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });


        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == "deactive"){
                swal({
                    title: "Are You Sure?",
                    text: "The designation status to deactive will prevent them from displaying in Employee Entry in. \n \n Set their status to active to enable the displaying in Employee Entry!",
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
                        swal("Success!", "Designation Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update designation status",
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
                        title: 'Designation Warning',
                        text: "Error. Could not confirm the status of the designation.",
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
