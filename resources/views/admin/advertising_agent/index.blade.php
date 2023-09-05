@extends('layouts.entry_master')
@section('title') Advertising Agent @endsection
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
                    <h3 class="page-title">Advertising Agent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Advertising Agent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_advertising_agent"><i class="fa fa-plus"></i> Add Advertising Agent </a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('advertising-agent.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Advertising Agent Table -->
                    <table id="advertising-agent-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Registration No</th>
                            <th>Company Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($advertising_agent as $agent)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$agent->registration_no)}}</td>
                                <td>{{ucwords(@$agent->company_name)}}</td>
                                <td>{{ucwords(@$agent->contact)}}</td>
                                <td>{{ucwords(@$agent->email)}}</td>
                                @foreach(@$countries as $key => $value)
                                    @if($key== $agent->country)
                                        <td>{{ucwords($value)}} </td>
                                    @endif
                                @endforeach
                                <td>
                                    <div class="dropdown">

                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            {{(($agent->status == "continued") ? "Continued":"Dis-Continued")}}
                                        </a>
                                        <div class="dropdown-menu">
                                            @if($agent->status == "continued")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('advertising-agent.status.update',$agent->id)}}" href="#" id="discontinued">Dis-continued</a>
                                            @else
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('advertising-agent.status.update',$agent->id)}}" href="#" id="continued">Continued</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-view" href="#"  id="{{$agent->id}}" hrm-view-action="{{route('advertising-agent.show',$agent->id)}}" data-toggle="modal" data-target="#view_advertising_agent"><i class="fa fa-eye m-r-5"></i> View </a>
                                            <a class="dropdown-item action-edit" href="#" id="{{@$agent->id}}" hrm-update-action="{{route('advertising-agent.update',@$agent->id)}}"  hrm-edit-action="{{route('advertising-agent.edit',@$agent->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('advertising-agent.destroy',@$agent->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Advertising Agent Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Advertising Agent Modal -->
    @include('admin.modals.advertising_agent.add')
    <!-- /Add Advertising Agent Modal -->

    <!-- view Advertising Agent Modal -->
    @include('admin.modals.advertising_agent.view')
    <!-- /view Advertising Agent Modal -->

    <!-- edit Advertising Agent Modal -->
    @include('admin.modals.advertising_agent.edit')
    <!-- /edit Advertising Agent Modal -->

    <!-- Forbidden Advertising Agent Modal -->
    @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Advertising Agent Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#advertising-agent-index').DataTable({
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
                    $("#edit_advertising_agent").modal("toggle");
                    $('#registration_no').attr('value',dataResult.edit.registration_no);
                    $('#company_name').attr('value',dataResult.edit.company_name);
                    $('#address').attr('value',dataResult.edit.address);
                    $('.updatecountry option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.edit.country){
                            $('#select2-country-container').text(value);
                        }

                    });
                    $('#contact').attr('value',dataResult.edit.contact);
                    $('#email').attr('value',dataResult.edit.email);
                    $('#status option[value="'+dataResult.edit.status+'"]').prop('selected', true);

                    if(dataResult.edit.fullname !== null){
                        $('#fullname').attr('value',dataResult.edit.fullname);
                    }
                    if(dataResult.edit.designation !== null){
                        $('#designation').attr('value',dataResult.edit.designation);
                    }
                    if(dataResult.edit.personal_contact !== null){
                        $('#personal_contact').attr('value',dataResult.edit.personal_contact);
                    }
                    if(dataResult.edit.personal_mobile !== null){
                        $('#personal_mobile').attr('value',dataResult.edit.personal_mobile);
                    }
                    if(dataResult.edit.personal_email !== null){
                        $('#personal_email').attr('value',dataResult.edit.personal_email);
                    }

                    $('.updateadvertisingagent').attr('action',action);

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
                    $('#view_company_name').text(dataResult.show.company_name);
                    $('#view_registration_no').text(dataResult.show.registration_no);
                    $('#view_address').text(dataResult.show.address);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.show.country){
                            $('#view_country').text(value);
                        }
                    });
                    $('#view_contact').text(dataResult.show.contact);
                    $('#view_email').text(dataResult.show.email);
                    $('#view_status').text(dataResult.show.status);
                    if(dataResult.show.fullname !== null){
                        $('#view_fullname').text(dataResult.show.fullname);
                    }else{
                        $('#view_fullname').text('N/A');
                    }
                    if(dataResult.show.designation !== null){
                        $('#view_designation').text(dataResult.show.designation);
                    }else{
                        $('#view_designation').text('N/A');
                    }

                    if(dataResult.show.personal_contact !== null){
                        $('#view_personal_contact').text(dataResult.show.personal_contact);
                    }else{
                        $('#view_personal_contact').text('N/A');
                    }

                    if(dataResult.show.personal_mobile !== null){
                        $('#view_personal_mobile').text(dataResult.show.personal_mobile);
                    }else{
                        $('#view_personal_mobile').text('N/A');
                    }
                    if(dataResult.show.personal_email !== null){
                        $('#view_personal_email').text(dataResult.show.personal_email);
                    }else{
                        $('#view_personal_email').text('N/A');
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
                    text: "The Advertising Agent status to Dis-continued will prevent them from displaying in Visa Entry in. \n \n Set their status to continued to enable the displaying in Visa Entry!",
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
                        swal("Success!", "Advertising Agent Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Advertising Agent status",
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
                        title: 'Advertising Agent Warning',
                        text: "Error. Could not confirm the status of the Advertising agent.",
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
