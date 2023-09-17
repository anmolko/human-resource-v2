@extends('layouts.master')
@section('title') Health Clinic @endsection
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
                    <h3 class="page-title">Health Clinic</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Health Clinic</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_health_clinic"><i class="fa fa-plus"></i> Add Health Clinic</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('health-clinic.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Health Clinic Table -->
                    <table id="health-clinic-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>email</th>
                            <th>Country</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($health_clinic as $clinic)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$clinic->name)}}</td>
                                <td>{{ucwords(@$clinic->address)}}</td>
                                <td>{{ucwords(@$clinic->email)}}</td>
                                @foreach(@$countries as $key => $value)
                                    @if($key== $clinic->country)
                                        <td>{{ucwords($value)}} </td>
                                    @endif
                                @endforeach
                                <td>{{ucwords(@$clinic->contact)}}</td>
                                <td>
                                    <div class="dropdown">

                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            {{(($clinic->status == "continued") ? "Continued":"Dis-Continued")}}
                                        </a>
                                        <div class="dropdown-menu">
                                            @if($clinic->status == "continued")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('health-clinic.status.update',$clinic->id)}}" href="#" id="discontinued">Dis-continued</a>
                                            @else
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('health-clinic.status.update',$clinic->id)}}" href="#" id="continued">Continued</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-view" href="#" id="{{$clinic->id}}" hrm-view-action="{{route('health-clinic.show',$clinic->id)}}" data-toggle="modal" data-target="#view_health_clinic">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{@$clinic->id}}" hrm-update-action="{{route('health-clinic.update',@$clinic->id)}}"  hrm-edit-action="{{route('health-clinic.edit',@$clinic->id)}}" data-toggle="modal">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('health-clinic.destroy',@$clinic->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Health Clinic Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Health Clinic Modal -->
    @include('admin.modals.health_clinic.add')
    <!-- /Add Health Clinic Modal -->

    <!-- view Health Clinic Modal -->
    @include('admin.modals.health_clinic.view')
    <!-- /view Health Clinic Modal -->

    <!-- edit Health Clinic Modal -->
    @include('admin.modals.health_clinic.edit')
    <!-- /edit Health Clinic Modal -->

    <!-- Forbidden Health Clinic Modal -->
    @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Health Clinic Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#health-clinic-index').DataTable({
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
                            swal("Trashed!", "Moved to Trash Successfully", "success");
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
                    $("#edit_health_clinic").modal("toggle");
                    $('#name').attr('value',dataResult.edit.name);
                    $('#address').attr('value',dataResult.edit.address);
                    $('#contact').attr('value',dataResult.edit.contact);
                    $('#email').attr('value',dataResult.edit.email);
                    if(dataResult.edit.organization_name !== null){
                        $('#organization_name').attr('value',dataResult.edit.organization_name);
                    }
                    if(dataResult.edit.membership_number !== null){
                        $('#membership_number').attr('value',dataResult.edit.membership_number);
                    }
                    $('#status option[value="'+dataResult.edit.status+'"]').prop('selected', true);
                    $('.updatecountry option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                    $('.updatehealthclinic').attr('action',action);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.edit.country){
                            $('#select2-country-container').text(value);
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
                    $('#view-name').text(dataResult.show.name);
                    $('#view-address').text(dataResult.show.address);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.show.country){
                            $('#view-country').text(value);
                        }
                    });
                    $('#view-contact').text(dataResult.show.contact);
                    $('#view-email').text(dataResult.show.email);
                    $('#view-status').text(dataResult.show.status);
                    if(dataResult.show.organization_name !== null){
                        $('#view-organization-name').text(dataResult.show.organization_name);
                    }else{
                        $('#view-organization-name').text('N/A');
                    }
                    if(dataResult.show.membership_number !== null){
                        $('#view-membership-number').text(dataResult.show.membership_number);
                    }else{
                        $('#view-membership-number').text('N/A');
                    }
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
                    text: "The Health Clinic status to Dis-continued will prevent them from displaying in Visa Entry in. \n \n Set their status to continued to enable the displaying in Visa Entry!",
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
                        swal("Success!", "Health Clinic Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Health Clinic status",
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
                        title: 'Health Clinic Warning',
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
