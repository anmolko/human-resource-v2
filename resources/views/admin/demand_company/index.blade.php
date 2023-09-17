@extends('layouts.master')
@section('title') Company @endsection
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

{{--    @if($errors->has('name'))--}}
{{--        <div class="notification-popup danger">--}}
{{--            <p>--}}
{{--                <span class="task"></span>--}}
{{--                <span class="notification-text">{{$errors->first('name')}}</span>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    @endif--}}



    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Company Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Company</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_agent"><i class="fa fa-plus"></i> Add Company</a>
                    <a href="{{route('company.trash')}}" class="btn add-btn margin-right"><i class="fa fa-eye"></i> Trash </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="tab-content profile-tab-content">
            <div class="row" id="employee-list">
                <div class="col-md-12">
                    <div class="table-responsive">

                        <form action="#" method="post" id="deleted-form" >
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="delete">

                        </form>
                        <table  id="overseas-index" class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Overseas Agent</th>
                                <th>Country - State</th>
                                <th>Status</th>
                                <th class="text-right no-sort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(@$rows as $row)
                                <tr>
                                    <td>
                                        {{ucwords($row->title ?? '')}}
                                    </td>
                                    <td>{{ucwords($row->email ?? '')}}</td>
                                    <td>{{ucwords($row->number ?? '')}}</td>
                                    <td>{{ucwords($row->overseasAgent->company_name ?? $row->overseasAgent->fullname ?? '')}}</td>
                                    <td>{{ucwords($row->countryState->country ?? '')}}
                                           {{ucwords($row->countryState ? ' - '.$row->countryState->state:'')}} </td>
                                    <td>
                                        <div class="dropdown">

                                            <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                {{(($row->status == "continued") ? "Continued":"Dis-Continued")}}
                                            </a>
                                            <div class="dropdown-menu">
                                                @if($row->status == "continued")
                                                    <a class="dropdown-item status-update" hrm-update-action="{{route('company.status.update',$row->id)}}" href="#" id="discontinued">Dis-continued</a>
                                                @else
                                                    <a class="dropdown-item status-update" hrm-update-action="{{route('company.status.update',$row->id)}}" href="#" id="continued">Continued</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item action-view" href="{{route('overseas-agent.show',$agent->client_no)}}" ><i class="fa fa-eye m-r-5"></i> View </a>--}}
{{--                                                    <a class="dropdown-item action-edit" href="#" hrm-update-action="{{route('overseas-agent.update',$agent->id)}}"  hrm-edit-action="{{route('overseas-agent.edit',$agent->id)}}" data-toggle="modal" data-target="#edit_agent"><i class="fa fa-edit m-r-5"></i> Edit </a>--}}
{{--                                                    <a class="dropdown-item action-delete"  href="#" hrm-delete-action="{{route('overseas-agent.destroy',$agent->id)}}" data-target="#delete_agent"><i class="fa fa-trash-o m-r-5"></i> Delete</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        <div class="flex-shrink-0 ms-4">
                                            <ul class="list-inline tasks-list-menu mb-0">
                                                <li class="list-inline-item">
{{--                                                    <a class="action-view" href="{{route('company.show',$row->id)}}">--}}
{{--                                                        <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>--}}

                                                <li class="list-inline-item">
                                                    <a class="action-edit" href="#"  hrm-update-action="{{route('company.update',$row->id)}}"  hrm-edit-action="{{route('company.edit',$row->id)}}" data-toggle="modal" data-target="#edit_agent">
                                                        <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>

                                                <li class="list-inline-item">
                                                    <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('company.destroy',$row->id)}}" data-target="#delete_agent">
                                                        <i class="fa fa-trash-o align-bottom me-2 text-muted"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Overseas Agent Modal -->
    @include('admin.modals.demand_company.add')
    <!-- /Add Overseas Agent Modal -->

    <!-- Edit Overseas Agent Modal -->
    @include('admin.modals.demand_company.edit')
    <!-- /Edit Overseas Agent Modal -->

    <!-- Forbidden Overseas Agent Modal -->
    @include('admin.modals.demand_company.forbidden')
    <!-- /Forbidden Overseas Agent Modal -->

@endsection
@section('js')
    <script type="text/javascript">
        var loadFile = function(event) {
            var image = document.getElementById('image');
            var replacement = document.getElementById('current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        var editLoadFile = function(event) {
            var image = document.getElementById('editimage');
            var replacement = document.getElementById('edit-current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $( ".select2" ).select2({
                width:'100%'
            });
        });

        $(document).on('click','.status-update', function (e) {
            e.preventDefault();
            var status = $(this).attr('id');
            var url = $(this).attr('hrm-update-action');
            if(status == "discontinued"){
                swal({
                    title: "Are You Sure?",
                    text: "The company status to Dis-continued will prevent them from displaying in Demand Entry in. \n \n Set their status to continued to enable the displaying in Demand Entry!",
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

        $(document).on('change','#addcountry', function (e) {
            e.preventDefault();
            var value=$(this).val();
            var action = "{{ route('company.state') }}?country_code=" + $(this).val();
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var state;
                    // console.log(dataResult);
                    state += '';

                    $.each(dataResult, function (index, value) {
                         state +=  '<option value="'+index+'">'+value+'</option>';
                    })
                    $('#state').html(state);

                },
                error: function(error){

                }
            });
        });

        $(document).on('change','#country', function (e) {
            e.preventDefault();
            var value=$(this).val();
            var action = "{{ route('company.state') }}?country_code=" + $(this).val();
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var state;
                    state += '';
                    $.each(dataResult, function (index, value) {
                         state +=  '<option value="'+index+'">'+value+'</option>';
                    })
                    $('#country_state_id').html(state);

                },
                error: function(error){

                }
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
                        // toastr.success('file deleted Successfully');
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

                    let rendered_view = dataResult.rendered_view;
                    $('#edit-content').html('').html(rendered_view);
                    $( ".select2" ).select2({
                        width:'100%'
                    });

                    // $('#id').val(data.id);

                    // $("#edit_agent").modal("toggle");
                    // $('#title').attr('value',dataResult.edit.title);
                    // $('#address').attr('value',dataResult.edit.address);
                    // $('#overseas_agent_id').attr('value',dataResult.edit.overseas_agent_id);
                    // $('#phone').attr('value',dataResult.edit.phone);
                    // $('#mobile').attr('value',dataResult.edit.mobile);
                    // $('#fax_number').attr('value',dataResult.edit.fax_number);
                    // $('#email').attr('value',dataResult.edit.email);
                    // $('#website').attr('value',dataResult.edit.website);
                    //
                    // $('select[name="status"] option[value="'+dataResult.edit.status+'"]').prop('selected', true);
                    //
                    // $('.updatecountry option[value="'+dataResult.edit.country+'"]').prop('selected', true);




                },error: function(error){

                }
            });
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
                        swal("Success!", "Company Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Company status",
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
                        title: 'Company Warning',
                        text: "Error. Could not confirm the status of the company.",
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
