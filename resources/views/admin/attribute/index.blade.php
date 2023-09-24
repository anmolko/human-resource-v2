@extends('layouts.account_master')
@section('title') Attribute @endsection
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

        @if($errors->has('slug'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('slug')}}</span>
            </p>
        </div>
        @endif


    <!-- Page Content -->
    <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Attribute</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                            <li class="breadcrumb-item active">Attribute</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_attribute"><i class="fa fa-plus"></i> Add Attribute</a>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('attribute.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                        <!-- Attribute Table -->
                        <table id="attribute-index" class="table table-striped custom-table mb-0 ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Attribute Name</th>
                                    <th>Field Type</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($attributes as $attribute)
                                <tr>
                                    <td> {{$i++}} </td>
                                    <td>{{ucwords(@$attribute->name)}}</td>
                                    <td>{{$attribute->field_type}}</td>
                                    <td>{{$attribute->slug}}</td>
                                    <td> @if ($attribute->status==1)
                                        <i class="fa fa-dot-circle-o text-success"></i> Active
                                        @else
                                        <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                        @endif
                                    </td>
                                    <td> {{ucwords( $attribute->createdBy() ? $attribute->createdBy()->name :'' )}}</td>
                                    <td>@if(isset($attribute->updated_by))
                                            {{ucwords($attribute->updatedBy()->name)}}
                                        @else
                                            This is not Updated Yet.
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item action-edit" href="#" id="{{$attribute->id}}" hrm-update-action="{{route('attribute.update',$attribute->id)}}"  hrm-edit-action="{{route('attribute.edit',$attribute->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('attribute.destroy',$attribute->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                        <!-- /Attribute Table -->

                    </div>
                </div>
            </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Attribute Modal -->
    @include('admin.modals.attributes.add')
    <!-- /Add Attribute Modal -->

     <!-- Edit Attribute Modal -->
     @include('admin.modals.attributes.edit')
    <!-- /Edit Attribute Modal -->

      <!-- Forbidden Attribute Modal -->
      @include('admin.modals.attributes.forbidden')
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
        $('#attribute-index').DataTable({
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
        $("#slug").val(Text);
    });

    $(".updatename").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'_');
        $(".updateslug").val(Text);
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
                            text: "You need to Remove Assigned Secondary Group First",
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
                // $('#id').val(data.id);
                $("#edit_attribute").modal("toggle");
                $('.updatename').attr('value',dataResult.name);
                $('.updateslug').attr('value',dataResult.slug);
                $('input[name="status"]').filter('[value="'+dataResult.status+'"]').prop('checked', true);
                $('input[name="field_type"]').filter('[value="'+dataResult.field_type+'"]').prop('checked', true);
                $('.updateattribute').attr('action',action);
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
