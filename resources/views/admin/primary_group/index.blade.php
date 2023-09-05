@extends('layouts.account_master')
@section('title') Primary Group @endsection
@section('css')
<style>
    p.no-permission{
        color: #e81f1f;
        font-size: 20px;
    }

    .secondary-not-found{
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


    .scrollbar
    {
        height: 150px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    /* .force-overflow
    {
        min-height: 450px;
    } */

    table.table.table-striped.custom-table.force-overflow tbody.row tr > td {
    border-top: none;
    }
    .attribute-side-by{
        display: flex;
        justify-content: space-between;
    }

    /*
    *  STYLE 1
    */

    #style-1::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    #style-1::-webkit-scrollbar
    {
        width: 12px;
        background-color: #F5F5F5;
    }

    #style-1::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
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
                        <h3 class="page-title">Primary Group</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('account')}}">Account Dashboard</a></li>
                            <li class="breadcrumb-item active">Primary Group</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_primary_group"><i class="fa fa-plus"></i> Add Primary Group</a>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('primary-groups.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                        <!-- Primary Group Table -->
                        <table id="primary-index" class="table table-striped custom-table mb-0 ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Primary Name</th>
                                    <th>Classfication</th>
                                    <th>Nature</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($primary_groups as $primary_group)
                                <tr>
                                    <td> {{$i++}} </td>
                                    <td>{{ucwords(@$primary_group->name)}}</td>
                                    <td>{{ucwords(@$primary_group->classfication)}}</td>
                                    <td>{{ucwords(@$primary_group->nature)}}</td>
                                    <td> @if ($primary_group->status==1)
                                        <i class="fa fa-dot-circle-o text-success"></i> Active
                                        @else
                                        <i class="fa fa-dot-circle-o text-danger"></i> Inactive
                                        @endif
                                    </td>
                                    <td> {{ucwords(App\Models\User::find($primary_group->created_by)->name)}}</td>
                                    <td>@if(isset($primary_group->updated_by))
                                            {{ucwords(App\Models\User::find($primary_group->updated_by)->name)}}
                                        @else
                                            This is not Updated Yet.
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item action-view" href="#"  id="{{$primary_group->id}}" hrm-view-action="{{route('primary-groups.viewsecondary',$primary_group->id)}}" data-toggle="modal" data-target="#view_secondary"><i class="fa fa-eye m-r-5"></i> View Assign Secondary</a>
                                                <a class="dropdown-item action-edit" href="#" id="{{$primary_group->id}}" hrm-update-action="{{route('primary-groups.update',$primary_group->id)}}"  hrm-edit-action="{{route('primary-groups.edit',$primary_group->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                               @if($primary_group->slug != "cash" && $primary_group->slug !="account_payable" && $primary_group->slug !="bank" && $primary_group->slug !="sundry_creditor" && $primary_group->slug !="sundry_debtor" && $primary_group->slug !="salary_payable" && $primary_group->slug !="account_receivable" && $primary_group->slug !="document_income" && $primary_group->slug !="document_advance" && $primary_group->slug !="commission_expenses" )
                                                    <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('primary-groups.destroy',$primary_group->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                                @endif

                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                        <!-- /Primary Group Table -->

                    </div>
                </div>
            </div>

    </div>
    <!-- /Page Content -->

   <!-- View Primary Secondary Modal -->
   @include('admin.modals.primary_groups.view_secondary')
    <!-- /View Primary Secondary Modal -->

      <!-- Add Primary Group Modal -->
      @include('admin.modals.primary_groups.add')
    <!-- /Add Primary Group Modal -->

    <!-- Edit Primary Group Modal -->
    @include('admin.modals.primary_groups.edit')
    <!-- /Edit Primary Group Modal -->

     <!-- Forbidden Primary Group Modal -->
     @include('admin.modals.primary_groups.forbidden')
    <!-- /Forbidden Primary Group Modal -->

@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#primary-index').DataTable({
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

                    trHTML = '<p class="secondary-not-found"> Secondary Group is not assigned yet !</p>';
                $("#view-primary-secondary").html(trHTML);

                }else{
                    var trHTML = "";

                $.each(dataResult, function( index, value ) {
                    trHTML +='<button type="button" class="btn btn-info btn-sm">'
                            + value
                            + '</button>'

                });
                $("#view-primary-secondary").html(trHTML);

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
                var slug = dataResult.editprimarygroup.slug;
                if(slug == "bank" || slug == "cash" || slug == "sundry_debtor" || slug== "salary_payable" || slug== "sundry_creditor" || slug== "document_income" || slug== "document_advance" || slug== "account_receivable" || slug== "account_payable" || slug== "commission_expenses" ){
                    $('.updatename').attr('readonly','readonly');
                }else {
                    $('.updatename').removeAttr('readonly','readonly');
                }
                $("#edit_primary_group").modal("toggle");
                $('.updatename').attr('value',dataResult.editprimarygroup.name);
                $('.updateslug').attr('value',slug);



                $('input[name="status"]').filter('[value="'+dataResult.editprimarygroup.status+'"]').prop('checked', true);
                $('.updateselectclassfication option[value="'+dataResult.editprimarygroup.classfication+'"]').prop('selected', true);

                var edit_attributes ;
                $.each(dataResult.all_attributes, function( index, valueattr ) {

                        edit_attributes += '<tr class="col-sm-6 attribute-side-by">'+
                                        '<td class="text-capitalize">'+valueattr.name+'</td>'+
                                        '<td class="text-center">'+
                                         '<input type="checkbox" class="updateattribute" name="attribute_id[]" value="'+valueattr.id+'" id="'+valueattr.slug+'"  >'+
                                        '</td>'+
                                    '</tr>';

                });
                $('#editselected_attribute').html(edit_attributes);


                $.each(dataResult.selected, function( index, valuen ) {

                    $('.updateattribute').each(function () {
                        if(this.value == valuen.id){
                           this.checked = "true"
                        }
                    });

                });

                $('.updateprimarygroup').attr('action',action);
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
