@extends('layouts.user_management_master')
@section('title') Module @endsection
@section('css')
<style>
    .role-not-found{
        color: #d43644;
        font-size: 20px;
    }
    .list-of-role button.btn.btn-info.btn-sm{
        margin-right:5px;
        margin-bottom: 5px;

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

        @if($errors->has('url'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('url')}}</span>
            </p>
        </div>
        @endif
        <!-- Page Content -->
        <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Module</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                                <li class="breadcrumb-item active">Module</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_module"><i class="fa fa-plus"></i> Add Module</a>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="{{route('module.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                            <!-- Module Table -->
                            <table id="module" class="table table-striped custom-table mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name </th>
                                        <th>Key </th>
                                        <th>Url</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                    @foreach($modules as $module)
                                    <tr>
                                        <td> {{$i++}}          </td>
                                        <td> {{$module->name}} </td>
                                        <td> {{$module->key}} </td>
                                        <td> {{$module->url}}  </td>

                                        <td> @if ($module->status==1)
                                            <i class="fa fa-dot-circle-o text-success"></i> Active
                                            @else
                                            <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item action-view" href="#"  id="{{$module->id}}" hrm-view-action="{{route('module.viewroles',$module->id)}}" data-toggle="modal" data-target="#view_role"><i class="fa fa-eye m-r-5"></i> View Assign Role</a>
                                                    <a class="dropdown-item action-edit" href="#" id="{{$module->id}}" hrm-update-action="{{route('module.update',$module->id)}}"  hrm-edit-action="{{route('module.edit',$module->id)}}" data-toggle="modal" data-target="#edit_module"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('module.destroy',$module->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach


                                </tbody>
                            </table>
                            <!-- /Module Table -->

                        </div>
                    </div>
                </div>

        </div>
            <!-- /Page Content -->

            <!-- Add Module Modal -->
            @include('admin.modals.modules.add')
            <!-- /Add Module Modal -->


            <!-- View Role Modal -->
            @include('admin.modals.modules.view_role')
            <!-- /View Role Modal -->

            <!-- Edit Module Modal -->
            @include('admin.modals.modules.edit')
            <!-- /Edit Module Modal -->

            <!-- Trash Module Modal -->
            <!-- @include('admin.modals.modules.trash') -->
            <!-- /Trash Module Modal -->
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $( ".select2" ).select2({
            width:'100%'
        });

        $('#module').DataTable({
            paging: true,
            searching: true,
            ordering:  false,
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

    // $(".action-delete").click(function(){
    //     var action = $(this).attr('hrm-delete-action');
    //     $('.deletemodule').attr('action',action);

    // })

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
                            text: "You need to Remove Assigned Roles and Permissions First",
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


    // $(".continue-trash").click(function(){
    //     $('#formdelete').submit();

    // })


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
                $('#parent_module_id').attr('value',dataResult.parent_module_id);
                $('.updatename').attr('value',dataResult.name);
                $('.updatekey').attr('value',dataResult.key);
                $('.updateurl').attr('value',dataResult.url);
                $('#rank').attr('value',dataResult.rank);
                $('#icon').attr('value',dataResult.icon);
                $('.updatemodule option[value="'+dataResult.status ?? 1+'"]').prop('selected', true);
                $('.updatemodule').attr('action',action);
            }
        });
    });

    </script>
@endsection
