@extends('layouts.user_management_master')
@section('title') Role @endsection
@section('css')
<style>
    .module-assign-section{
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .scrollbar
    {
        height: 300px;
        overflow-y: scroll;
    }

    .force-overflow
    {
        min-height: 450px;
    }

/* 
    .checkbox label {
        min-height: 20px;
        padding-left: 20px;
        margin-bottom: 0;
        font-weight: normal;
        cursor: pointer;
    }
    .checkbox {
    padding-left: 20px;
    }
    .checkbox label {
        display: inline-block;
    vertical-align: middle;
    position: relative;
    padding-left: 0px;
    text-align: center;
    }
    .checkbox label::before {
    content: "";
    display: inline-block;
    position: absolute;
    width: 17px;
    height: 17px;
    left: 60px;
    top: -20px;
    margin-left: -20px;
    border: 1px solid #cccccc;
    border-radius: 3px;
    background-color: #fff;
    -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
    -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
    transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
    }
    .checkbox label::after {
    display: inline-block;
    position: absolute;
    width: 16px;
    height: 16px;
    left: 60px;
    top: -20px;
    margin-left: -20px;
    padding-left: 2px;
    padding-top: 1px;
    font-size: 11px;
    color: #555555;
    }
    .checkbox input[type="checkbox"]{
    opacity: 0;
    z-index: 1;
    }
    .checkbox input[type="checkbox"]:focus + label::before,
    .checkbox input[type="radio"]:focus + label::before {
    outline: thin dotted;
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
    }
    .checkbox input[type="checkbox"]:checked + label::after,
    .checkbox input[type="radio"]:checked + label::after {
    font-family: "FontAwesome";
    content: "\f00c";
    }
    .checkbox input[type="checkbox"]:disabled + label,
    .checkbox input[type="radio"]:disabled + label {
    opacity: 0.65;
    }
    .checkbox input[type="checkbox"]:disabled + label::before,
    .checkbox input[type="radio"]:disabled + label::before {
    background-color: #eeeeee;
    cursor: not-allowed;
    }
    .checkbox.checkbox-circle label::before {
    border-radius: 50%;
    }
    .checkbox.checkbox-inline {
    margin-top: 0;
    }

    .checkbox-primary input[type="checkbox"]:checked + label::before{
    background-color: #337ab7;
    border-color: #337ab7;
    }
    .checkbox-primary input[type="checkbox"]:checked + label::after{
    color: #fff;
    }

    .checkbox-danger input[type="checkbox"]:checked + label::before{
    background-color: #d9534f;
    border-color: #d9534f;
    }
    .checkbox-danger input[type="checkbox"]:checked + label::after {
    color: #fff;
    }

    .checkbox-info input[type="checkbox"]:checked + label::before{
    background-color: #5bc0de;
    border-color: #5bc0de;
    }
    .checkbox-info input[type="checkbox"]:checked + label::after{
    color: #fff;
    }


    .checkbox-warning input[type="checkbox"]:checked + label::after{
    color: #fff;
    }

    .checkbox-success input[type="checkbox"]:checked + label::before {
    background-color: #5cb85c;
    border-color: #5cb85c;
    }
    .checkbox-success input[type="checkbox"]:checked + label::after{
    color: #fff;
    }




    input[type="checkbox"].styled:checked + label:after{
    font-family: 'FontAwesome';
    content: "\f00c";
    }
    input[type="checkbox"] .styled:checked + label::before {
    color: #fff;
    }
    input[type="checkbox"] .styled:checked + label::after {
    color: #fff;
    } */


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

    .role-button-group{
        display: flex;
        justify-content: space-between;
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
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Roles & Permissions</h3>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
                <span class="role-button-group">
                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
                <a href="{{route('role.trash')}}" class="btn btn-warning btn-sm" style="color: white;"><i class="fa fa-eye"></i> View Trash</a>
                </span>
                <div class="roles-menu scrollbar" id="style-1">
                    <ul class="role-nav force-overflow">
                    <form action="#" method="post" id="deleted-form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="delete">

                    </form>

                    @forelse(@$roles as $index => $role)
                        <li class="{{ $index == 0 ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="role-assign" id="role-assign" assign-module="{{route('role.assignmodules',$role->id)}}">{{ucwords(@$role->name)}}
                                <span class="role-action">
                                    <span class="action-circle large action-edit" data-toggle="modal" data-target="#edit_role" id="{{$role->id}}" hrm-update-action="{{route('role.update',$role->id)}}"  hrm-edit-action="{{route('role.edit',$role->id)}}" >
                                        <i class="material-icons">edit</i>
                                    </span>
                                    <span class="action-circle large delete-btn action-delete"  hrm-delete-action="{{route('role.destroy',$role->id)}}">
                                        <i class="material-icons">delete</i>
                                    </span>
                                </span>
                            </a>
                        </li>
                        @empty
                        <li class="active"> <a>Roles Not Created Yet !</a></li>
                    @endforelse

                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">

                <section id="module-access">

                </section>


            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Role Modal -->
    @include('admin.modals.roles.add')
    <!-- /Add Role Modal -->

    <!-- Edit Role Modal -->
    @include('admin.modals.roles.edit')
    <!-- /Edit Role Modal -->

    <!-- Delete Role Modal -->
    @include('admin.modals.roles.delete')
    <!-- /Delete Role Modal -->



@endsection
@section('js')
<script type="text/javascript">

    $(".role-nav li").on("click", function() {
        $(".role-nav li").removeClass("active");
        $(this).addClass("active");
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "module/1/role",
            success: function(response){
                $('#module-access').html(response);
            }
        })

    });



    //Function to capitalise first character for strings
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

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
                            text: "You need to Remove Assigned Modules and Permissions First",
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
                $('.updatename').attr('value',capitalizeFirstLetter(dataResult.name));
                // $('.updatekey').attr('value',dataResult.status);
                $('input[name="status"]').filter('[value="'+dataResult.status+'"]').prop('checked', true);
                $('.updaterole').attr('action',action);
            }
        });
    });

    $(document).on('click','.role-assign', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('assign-module'),
            success: function(response){
                $('#module-access').html(response);
            }
        })
    })

</script>
@endsection
