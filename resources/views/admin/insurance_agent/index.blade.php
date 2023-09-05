@extends('layouts.entry_master')
@section('title') Insurance Agent @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }

        .select2-container {
            width: 355px;
        }

        .add-btn{
            margin-right: 10px;
        }

         .select-height{
            height:44px;
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

    @if($errors->has('company_name'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('company_name')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Insurance Agent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Insurance Agent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_insurance_agent"><i class="fa fa-plus"></i> Add Insurance Agent</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('insurance-agent.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Insurance Agent Table -->
                    <table id="insurance-agent-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Company Name</th>
                            <th>Country</th>
                            <th>Company Address</th>
                            <th>Company Contact</th>
                            <th>Company Email</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($insurances as $insurance)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$insurance->company_name)}}</td>
                                @foreach(@$countries as $key => $value)
                                    @if($key== $insurance->country)
                                        <td>{{ucwords($value)}} </td>
                                            @endif
                                @endforeach
                                <td>{{ucwords(@$insurance->company_address)}}</td>
                                <td>{{ucwords(@$insurance->company_contact_num)}}</td>
                                <td>{{ucwords(@$insurance->company_email)}}</td>
                                <td>
                                            <div class="dropdown">

                                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    {{(($insurance->status == "continued") ? "Continued":"Dis-Continued")}}
                                                </a>
                                                <div class="dropdown-menu">
                                                    @if($insurance->status == "continued")
                                                        <a class="dropdown-item status-update" hrm-update-action="{{route('insurance-agent.status.update',$insurance->id)}}" href="#" id="discontinued">Dis-continued</a>
                                                    @else
                                                        <a class="dropdown-item status-update" hrm-update-action="{{route('insurance-agent.status.update',$insurance->id)}}" href="#" id="continued">Continued</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                <td class="text-right">
{{--                                    <div class="dropdown dropdown-action">--}}
{{--                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <a class="dropdown-item action-view" href="#"  id="{{$insurance->id}}" hrm-view-action="{{route('insurance-agent.single',$insurance->id)}}" data-toggle="modal" data-target="#view_insurance_agent"><i class="fa fa-eye m-r-5"></i> View </a>--}}
{{--                                            <a class="dropdown-item action-edit" href="#" id="{{@$insurance->id}}" hrm-update-action="{{route('insurance-agent.update',@$insurance->id)}}"  hrm-edit-action="{{route('insurance-agent.edit',@$insurance->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('insurance-agent.destroy',@$insurance->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">

                                            <li class="list-inline-item">
                                                <a class="action-view" href="#" id="{{$insurance->id}}" hrm-view-action="{{route('insurance-agent.single',$insurance->id)}}" data-toggle="modal" data-target="#view_insurance_agent">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{@$insurance->id}}" hrm-update-action="{{route('insurance-agent.update',@$insurance->id)}}"  hrm-edit-action="{{route('insurance-agent.edit',@$insurance->id)}}" data-toggle="modal" >
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('insurance-agent.destroy',@$insurance->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Insurance Agent Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Insurance Agent Modal -->
    @include('admin.modals.insurance_agent.add')
    <!-- /Add Insurance Agent Modal -->

     <!-- Add Insurance Agent Modal -->
     @include('admin.modals.insurance_agent.view')
    <!-- /Add Insurance Agent Modal -->

    <!-- edit Insurance Agent Modal -->
    @include('admin.modals.insurance_agent.edit')
    <!-- /edit Insurance Agent Modal -->

     <!-- Forbidden Sub Status Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Sub Status Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#insurance-agent-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            $( "select[name='country']" ).select2({
                width: 'style',
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
                    // console.log(dataResult)
                    $("#edit_insurance_agent").modal("toggle");
                    $('.updatecompanyname').attr('value',dataResult.editinsurance.company_name);
                    $('.updatecompanyaddress').attr('value',dataResult.editinsurance.company_address);
                    $('.updatecompanycontact').attr('value',dataResult.editinsurance.company_contact_num);
                    $('.updatecompanyemail').attr('value',dataResult.editinsurance.company_email);
                    if(dataResult.editinsurance.personal_fullname !== null){
                        $('.updatefullname').attr('value',dataResult.editinsurance.personal_fullname);
                    }

                    if(dataResult.editinsurance.personal_fullname !== null){
                        $('.updatefullname').attr('value',dataResult.editinsurance.personal_fullname);
                    }

                    if(dataResult.editinsurance.personal_contact_num !== null){
                        $('.updatecontact').attr('value',dataResult.editinsurance.personal_contact_num);
                    }

                    if(dataResult.editinsurance.personal_designation !== null){
                        $('.updatedesignation').attr('value',dataResult.editinsurance.personal_designation);
                    }

                    if(dataResult.editinsurance.personal_designation !== null){
                        $('.updatemobile').attr('value',dataResult.editinsurance.personal_mobile_num);
                    }

                    if(dataResult.editinsurance.personal_email !== null){
                        $('.updateemail').attr('value',dataResult.editinsurance.personal_email);
                    }

                    $('select[name="status"] option[value="'+dataResult.editinsurance.status+'"]').prop('selected', true);
                    $('.updatecountry option[value="'+dataResult.editinsurance.country+'"]').prop('selected', true);
                    $('.updateinsuranceagent').attr('action',action);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.editinsurance.country){
                            $('#select2-editcountry-container').text(value);
                        }

                    });
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $('#view-company_name').text(dataResult.show.company_name);
                    $('#view-company_address').text(dataResult.show.company_address);
                    $('#view-company_contact_num').text(dataResult.show.company_contact_num);
                    $('#view-company_email').text(dataResult.show.company_email);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.show.country){
                            $('#view-country').text(value);
                        }
                    });
                    $('#view-personal_fullname').text(dataResult.show.personal_fullname);
                    $('#view-personal_designation').text(dataResult.show.personal_designation);
                    $('#view-personal_contact_num').text(dataResult.show.personal_contact_num);
                    $('#view-personal_mobile_num').text(dataResult.show.personal_mobile_num);
                    $('#view-personal_email').text(dataResult.show.personal_email);
                    $('#view-status').text(dataResult.show.status);


                }
            });
        });

        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == "discontinued"){
                swal({
                    title: "Are You Sure?",
                    text: "The insurance agent status to Dis-continued will prevent them from displaying in Visa Entry in. \n \n Set their status to continued to enable the displaying in Visa Entry!",
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
                        swal("Success!", "Insurance Agent Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Insurance Agent status",
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
                        title: 'Insurance Agent Warning',
                        text: "Error. Could not confirm the status of the insurance agent.",
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
