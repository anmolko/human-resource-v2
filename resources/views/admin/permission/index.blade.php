@extends('layouts.master')
@section('title') Permission @endsection
@section('css')
<style>
    .role-not-found{
        color: #d43644;
        font-size: 20px;
    }
    .list-of-role button.btn.btn-info.btn-sm{
        margin-right:5px
    }

    .custom-modal .modal-body.list-of-role {
        text-align: center;
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

        @if($errors->has('key'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('key')}}</span>
            </p>
        </div>
        @endif

        @if($errors->has('module_id'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('module_id')}}</span>
            </p>
        </div>
        @endif
        <!-- Page Content -->
        <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Permission</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                                <li class="breadcrumb-item active">Permission</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_permission"><i class="fa fa-plus"></i> Add Permission</a>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="{{route('permission.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                            <!-- Permission Table -->
                            <table id="permission-index" class="table table-striped custom-table mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Module Name</th>
                                        <th>Permission Name</th>
                                        <th>Key</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach($permissions as $permission)
                                    <tr>
                                        <td> {{$i++}} </td>
                                        <td>{{ucwords(App\Models\Module::find($permission->module_id)->name)}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->key}}</td>
                                        <td> @if ($permission->status==1)
                                            <i class="fa fa-dot-circle-o text-success"></i> Active
                                            @else
                                            <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                            @endif
                                        </td>
                                        <td> {{ucwords(App\Models\User::find($permission->created_by)->name)}}</td>
                                        <td>@if(isset($permission->updated_by))
                                                {{ucwords(App\Models\User::find($permission->updated_by)->name)}}
                                            @else
                                                This is not Updated Yet.
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item action-view" href="#"  id="{{$permission->id}}" hrm-view-action="{{route('permission.viewroles',$permission->id)}}" data-toggle="modal" data-target="#view_role"><i class="fa fa-eye m-r-5"></i> View Assign Role</a>
                                                    <a class="dropdown-item action-edit" href="#" id="{{$permission->id}}" hrm-update-action="{{route('permission.update',$permission->id)}}"  hrm-edit-action="{{route('permission.edit',$permission->id)}}" data-toggle="modal" data-target="#edit_permission"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('permission.destroy',$permission->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach


                                </tbody>
                            </table>
                            <!-- /Permission Table -->

                        </div>
                    </div>
                </div>




        </div>
            <!-- /Page Content -->

            <!-- Add Permission Modal -->
            @include('admin.modals.permissions.add')
            <!-- /Add Permission Modal -->


            <!-- View Permission Modal -->
            @include('admin.modals.permissions.view_role')
            <!-- /View Permission Modal -->

            <!-- Edit Permission Modal -->
            @include('admin.modals.permissions.edit')

            <!-- /Edit Permission Modal -->

            <!-- Trash Permission Modal -->
            <!-- @include('admin.modals.permissions.trash') -->
            <!-- /Trash Permission Modal -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#permission-index').DataTable({
            paging: true,
            searching: true,
            ordering:  true,
            lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

        });
    });


    $("#name").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $("#key").val(Text);
    });

    $(".updatename").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $(".updatekey").val(Text);
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
                $.post( $url, form_data,function(response) {
                    if(response == 0){
                        swal({
                            title: "Warning!",
                            text: "You need to Remove Assigned Roles First",
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
                });
            })

    })


    $(document).on('click','.action-view', function (e) {
        e.preventDefault();
            // console.log(action)
            var id=$(this).attr('id');
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    if(dataResult==null || dataResult ==0){
                        var trHTML = "";

                        trHTML = '<p class="role-not-found"> Role is not assigned yet !</p>';
                    $("#view-role-module").html(trHTML);

                    }else{
                        var trHTML = "";

                    $.each(dataResult, function( index, value ) {
                        trHTML +='<button type="button" class="btn btn-info btn-sm">'
                                + value
                                + '</button>'

                    });
                    $("#view-role-module").html(trHTML);

                    }

                }
            });
    });

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
                // $('#id').val(data.id);
                console.log(dataResult)

                $('.updatename').attr('value',dataResult.editpermission.name);
                $('.updatekey').attr('value',dataResult.editpermission.key);
                $('input[name="status"]').filter('[value="'+dataResult.editpermission.status+'"]').prop('checked', true);
                $('.updateselectmodule option[value="'+dataResult.editpermission.module_id+'"]').prop('selected', true);
                $('.updatepermission').attr('action',action);
            }
        });
    });

</script>
@endsection
