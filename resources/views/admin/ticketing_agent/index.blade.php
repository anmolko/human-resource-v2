@extends('layouts.entry_master')
@section('title') Ticketing Agent @endsection
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

        /*for custom select*/

        .select-label {
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            display: block;
        }
        .select-label span {
            position: relative;
            border: 1px solid #d4d4d4;
            border-radius: 10px;
            transition: 0.4s;
            padding: 0 15px;
            height: 46px;
            color: #414141;
            justify-content: center;
            display: flex;
            align-items: center;
            -moz-column-gap: 7px;
            column-gap: 7px;
        }
        .select-label span .icon {
            font-size: 1.1em;
        }
        .select-label input {
            pointer-events: none;
            display: none;
        }
        .select-label input:checked + span {
            border-color: #41237c;
            color: #41237c;
        }
        /*end of custom select*/
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
                    <h3 class="page-title">Ticketing Agent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Ticketing Agent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_ticketing_agent"><i class="fa fa-plus"></i> Add Ticketing Agent </a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('ticketing-agent.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- ticketing Agent Table -->
                    <table id="ticketing-agent-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>Agent ID</th>
                            <th>Company Name</th>
                            <th>Full Name</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($ticketing_agent as $agent)
                            <tr>
                                <td>{{ucwords(@$agent->agent_id)}}</td>
                                <td>{{ucwords(@$agent->company_name)}}</td>
                                <td>
                                    @if($agent->contact != null)
                                        {{ucwords(@$agent->fullname)}}
                                    @else
                                        Not Set
                                    @endif
                                </td>
                                <td>
                                    @if($agent->contact != null)
                                        {{ucwords(@$agent->contact)}}
                                    @else
                                        Not Set
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">

                                        <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            {{(($agent->status == "continued") ? "Continued":"Dis-Continued")}}
                                        </a>
                                        <div class="dropdown-menu">
                                            @if($agent->status == "continued")
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('ticketing-agent.status.update',$agent->id)}}" href="#" id="discontinued">Dis-continued</a>
                                            @else
                                                <a class="dropdown-item status-update" hrm-update-action="{{route('ticketing-agent.status.update',$agent->id)}}" href="#" id="continued">Continued</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">

                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-view" href="#" id="{{$agent->id}}" hrm-view-action="{{route('ticketing-agent.show',$agent->id)}}" data-toggle="modal" data-target="#view_ticketing_agent">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{@$agent->id}}" hrm-update-action="{{route('ticketing-agent.update',@$agent->id)}}"  hrm-edit-action="{{route('ticketing-agent.edit',@$agent->id)}}" data-toggle="modal" >
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('ticketing-agent.destroy',@$agent->id)}}" >
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /ticketing Agent Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add ticketing Agent Modal -->
    @include('admin.modals.ticketing_agent.add')
    <!-- /Add ticketing Agent Modal -->

    <!-- view ticketing Agent Modal -->
    @include('admin.modals.ticketing_agent.view')
    <!-- /view ticketing Agent Modal -->

    <!-- edit ticketing Agent Modal -->
    @include('admin.modals.ticketing_agent.edit')
    <!-- /edit ticketing Agent Modal -->

    <!-- Forbidden ticketing Agent Modal -->
    @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden ticketing Agent Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        var database_specification = [];


        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ticketing-agent-index').DataTable({
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
                    $("#edit_ticketing_agent").modal("toggle");
                    $("input[id='airline_detail_ids[]']").each(function(index, value) {
                        if(checkValue(value.value, dataResult.selected_airlines) == 'Exist'){
                            $(this).prop('checked', true);
                        }
                    });
                    $('#agent_id').attr('value',dataResult.edit.agent_id);
                    $('#company_name').attr('value',dataResult.edit.company_name);
                    if(dataResult.edit.address !== null) {
                        $('#address').attr('value', dataResult.edit.address);
                    }
                    if(dataResult.edit.contact !== null) {
                        $('#contact').attr('value', dataResult.edit.contact);
                    }
                    if(dataResult.edit.email !== null) {
                        $('#email').attr('value', dataResult.edit.email);
                    }

                    if(dataResult.edit.fax_no !== null){
                        $('#fax_no').attr('value',dataResult.edit.fax_no);
                    }
                    if(dataResult.edit.status !== null){
                        $('#status').attr('value',dataResult.edit.status);
                    }
                    if(dataResult.edit.postal_address !== null){
                        $('#postal_address').attr('value',dataResult.edit.postal_address);
                    }
                    if(dataResult.edit.website !== null){
                        $('#website').attr('value',dataResult.edit.website);
                    }
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


                    $('.updateticketingagent').attr('action',action);

                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        function checkValue(value, arr) {
            var status = 'Not exist';

            for (var i = 0; i < arr.length; i++) {
                var name = arr[i];
                if (name == value) {
                    status = 'Exist';
                    break;
                }
            }

            return status;
        }

        $(document).on('click','.action-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $('#view_company_name').text(dataResult.show.company_name);
                    $('#view_agent_id').text(dataResult.show.agent_id);
                    if(dataResult.show.address !== null){
                        $('#view_address').text(dataResult.show.address);
                    }else{
                        $('#view_address').text("N/A");
                    }

                    if(dataResult.show.contact !== null) {
                        $('#view_contact').text(dataResult.show.contact);
                    }else{
                        $('#view_contact').text('N/A');
                    }

                    if(dataResult.show.email !== null) {
                        $('#view_email').text(dataResult.show.email);
                    }else{
                        $('#view_email').text("N/A");
                    }


                    $('#view_status').text(dataResult.show.status);

                    if(dataResult.show.fax_no !== null){
                        $('#view_fax_no').text(dataResult.show.fax_no);
                    }else{
                        $('#view_fax_no').text('N/A');
                    }
                    if(dataResult.show.fullname !== null){
                        $('#view_fullname').text(dataResult.show.fullname);
                    }else{
                        $('#view_fullname').text('N/A');
                    }
                    if(dataResult.show.postal_address !== null){
                        $('#view_postal_address').text(dataResult.show.postal_address);
                    }else{
                        $('#view_postal_address').text('N/A');
                    }
                    if(dataResult.show.website !== null){
                        $('#view_website').text(dataResult.show.website);
                    }else{
                        $('#view_website').text('N/A');
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
                    text: "The Ticketing Agent status to Dis-continued will prevent them from displaying in Visa Entry in. \n \n Set their status to continued to enable the displaying in Visa Entry!",
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
                        swal("Success!", "Ticketing Agent Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Ticketing Agent status",
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
                        title: 'Ticketing Agent Warning',
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
