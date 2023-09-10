@extends('layouts.entry_master')
@section('title') Overseas Agent @endsection
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
                    <h3 class="page-title">Overseas Agent</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Overseas Agent</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_agent"><i class="fa fa-plus"></i> Add Overseas Agent</a>
                    <a href="{{route('overseas-agent.trash')}}" class="btn add-btn margin-right"><i class="fa fa-eye"></i> Trash </a>
                    <div class="view-icons">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item">
                                <a href="#my-grid" data-toggle="tab"  class="grid-view nav-link btn btn-link"><i class="fa fa-th"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="#my-list" data-toggle="tab"  class="nav-link list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                            </li>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="tab-content profile-tab-content">
            <!-- Projects Tab -->
            <div id="my-list" class="tab-pane fade show active">
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
                                    <th>Agent Name</th>
                                    <th>Client Number</th>
                                    <th>Company Name</th>
                                    <th>Country - State</th>
                                    <th>Status</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(@$overseas as $agent)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="#" class="avatar">
                                                    <img alt="{{$agent->fullname ?? $agent->company_name ?? ''}}" src="<?php if(!empty($agent->image)){ echo '/images/agent/'.$agent->image; } else { echo '/images/profiles/others.png'; }  ?>" />
                                                </a>
                                                <a href="#">{{ucfirst($agent->fullname ?? $agent->company_name ?? '')}}
                                                    <span>
                                                           {{$agent->personal_email}}
                                                        </span></a>
                                            </h2>
                                        </td>
                                        <td>{{ucwords($agent->client_no ?? '')}}</td>
                                        <td>{{ucwords($agent->company_name ?? '')}}</td>
                                        <td>{{ucwords($agent->countryState->country ?? '')}}
                                               {{ucwords($agent->countryState ? ' - '.$agent->countryState->state:'')}} </td>
                                        <td>
                                            <div class="dropdown">

                                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    {{(($agent->status == "continued") ? "Continued":"Dis-Continued")}}
                                                </a>
                                                <div class="dropdown-menu">
                                                    @if($agent->status == "continued")
                                                        <a class="dropdown-item status-update" hrm-update-action="{{route('overseas-agent.status.update',$agent->id)}}" href="#" id="discontinued">Dis-continued</a>
                                                    @else
                                                        <a class="dropdown-item status-update" hrm-update-action="{{route('overseas-agent.status.update',$agent->id)}}" href="#" id="continued">Continued</a>
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
                                                        <a class="action-view" href="{{route('overseas-agent.show',$agent->client_no)}}">
                                                            <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>

                                                    <li class="list-inline-item">
                                                        <a class="action-edit" href="#"  hrm-update-action="{{route('overseas-agent.update',$agent->id)}}"  hrm-edit-action="{{route('overseas-agent.edit',$agent->id)}}" data-toggle="modal" data-target="#edit_agent">
                                                            <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>

                                                    <li class="list-inline-item">
                                                        <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('overseas-agent.destroy',$agent->id)}}" data-target="#delete_agent">
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
            <!-- /Projects Tab -->

            <!-- Task Tab -->
            <div id="my-grid" class="tab-pane fade">
                <div class="row staff-grid-row" id="employee-grid">
                    @foreach(@$overseas as $agent)
                        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
                            <div class="profile-widget">
                                <div class="profile-img">
                                    <a href="#" class="avatar">
                                        <img alt="{{$agent->fullname}}" src="<?php if(!empty($agent->image)){ echo '/images/agent/'.$agent->image; } else { echo '/images/profiles/others.png'; }  ?>" />
                                    </a>
                                </div>
                                <div class="dropdown profile-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item action-view" href="{{route('overseas-agent.show',$agent->client_no)}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                        <a class="dropdown-item action-edit"  href="#" hrm-update-action="{{route('overseas-agent.update',$agent->id)}}"  hrm-edit-action="{{route('overseas-agent.edit',$agent->id)}}" data-toggle="modal" data-target="#edit_agent"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('overseas-agent.destroy',$agent->id)}}" data-target="#delete_agent"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                    </div>
                                </div>
                                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{ucfirst($agent->fullname)}}</a></h4>
                                <div class="small text-muted">
                                    {{$agent->personal_email}}
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- /Task Tab -->

        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add Overseas Agent Modal -->
    @include('admin.modals.overseas_agent.add')
    <!-- /Add Overseas Agent Modal -->

    <!-- Edit Overseas Agent Modal -->
    @include('admin.modals.overseas_agent.edit')
    <!-- /Edit Overseas Agent Modal -->

    <!-- Forbidden Overseas Agent Modal -->
    @include('admin.modals.overseas_agent.forbidden')
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
            $( ".select2" ).select2({
                width:'100%'
            });
            // Attach a change event listener to the radio buttons
            $('.type_of_company_add').change(function() {
                // Check the selected value
                var selectedValue = $(this).val();

                // Show or hide the div based on the selected value
                if (selectedValue == 'individual') {
                    $('.company-information').addClass('d-none');
                    $('.country-group-personal').removeClass('d-none');
                    $('.country-group-company').addClass('d-none');
                    $('.remove-company-require').prop('required',false);
                    $('.remove-personal-require').prop('required',true);
                    // $('.personal-information').removeClass('d-none');
                } else {
                    // $('.personal-information').addClass('d-none');
                    $('.company-information').removeClass('d-none');
                    $('.country-group-personal').addClass('d-none');
                    $('.country-group-company').removeClass('d-none');
                    $('.remove-company-require').prop('required',true);
                    $('.remove-personal-require').prop('required',false);
                }

            });

            $('.type_of_company').change(function() {
                // Check the selected value
                var selectedValue = $(this).val();

                // Show or hide the div based on the selected value
                if (selectedValue == 'individual') {
                    $('#company-information').addClass('d-none');
                    $('#country-group-personal').removeClass('d-none');
                    $('#country-group-company').addClass('d-none');
                    $('#fullname').prop('required',true);
                    $('.edit-require').prop('required',false);
                } else {
                    // $('#personal-information').addClass('d-none');
                    $('#company-information').removeClass('d-none');
                    $('#country-group-personal').addClass('d-none');
                    $('#country-group-company').removeClass('d-none');
                    $('#fullname').prop('required',false);
                    $('.edit-require').prop('required',true);

                }
            });

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
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
                    text: "The overseas agent status to Dis-continued will prevent them from displaying in Demand Entry in. \n \n Set their status to continued to enable the displaying in Demand Entry!",
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


        $(document).on('change','#country,#country-personal', function (e) {
            e.preventDefault();
            var value = $(this).val();
            var dataid = $(this).attr('data-id');
            loadStateadd(value,dataid);
        });

        $(document).on('change','#editcountry,#country2', function (e) {
            e.preventDefault();
            var value = $(this).val();
            var dataid = $(this).attr('data-id');
            loadStateUpdate(value,dataid);

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
                    console.log(dataResult);
                    $("#edit_agent").modal("toggle");
                    $('#client_no').attr('value',dataResult.editagent.client_no);
                    $('#company_name').attr('value',dataResult.editagent.company_name);
                    $('#company_address').attr('value',dataResult.editagent.company_address);
                    $('#company_contact_num').attr('value',dataResult.editagent.company_contact_num);
                    $('#fax_num').attr('value',dataResult.editagent.fax_num);
                    $('#company_email').attr('value',dataResult.editagent.company_email);
                    $('#website').attr('value',dataResult.editagent.website);
                    $('#postal_address').attr('value',dataResult.editagent.postal_address);
                    $('#fullname').attr('value',dataResult.editagent.fullname);
                    $('#designation').attr('value',dataResult.editagent.designation);
                    $('#personal_email').attr('value',dataResult.editagent.personal_email);
                    $('#personal_mobile').attr('value',dataResult.editagent.personal_mobile);
                    $('#personal_contact_num').attr('value',dataResult.editagent.personal_contact_num);
                    $('input[name="type_of_company"]').filter('[value="'+dataResult.editagent.type_of_company+'"]').prop('checked', true);

                    if (dataResult.editagent.type_of_company == 'individual'){
                        // Show or hide the div based on the selected value
                        $('#company-information').addClass('d-none');
                        $('#country-group-personal').removeClass('d-none');
                        $('#country-group-company').addClass('d-none');
                            // $('#personal-information').removeClass('d-none');
                    }else{
                        // $('#personal-information').addClass('d-none');
                        $('#company-information').removeClass('d-none');
                        $('#country-group-personal').addClass('d-none');
                        $('#country-group-company').removeClass('d-none');
                    }
                    $('select[name="status"] option[value="'+dataResult.editagent.status+'"]').prop('selected', true);

                    if (dataResult.editagent.type_of_company == 'individual') {
                        $('.updatepersonalcountry option[value="'+dataResult.editagent.country+'"]').prop('selected', true);
                    }else {
                        $('.updatecountry option[value="'+dataResult.editagent.country+'"]').prop('selected', true);
                    }

                    if(dataResult.editagent.image == null){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/agent/'+dataResult.editagent.image;
                    }
                    $('#edit-current-img').attr('src',src);

                    $('.updateoverseas').attr('action',action);

                    if (dataResult.editagent.country_state){
                        var state;
                        state += '<option value disabled selected> Select State</option>';
                        if (dataResult.editagent.type_of_company == 'individual') {
                            $('#select2-country2-container').text(dataResult.editagent.country_state.country);
                        }else {
                            $('#select2-editcountry-container').text(dataResult.editagent.country_state.country);
                        }

                        var actionn = "{{ route('overseas-agent.state') }}?country_code=" + dataResult.editagent.country_state.country_code;
                        $.ajax({
                            url: actionn,
                            type: "GET",
                            success: function(dataRes){
                                $.each(dataRes, function (indexx, valuee) {
                                    if(indexx==dataResult.editagent.country_state_id){
                                        state +=  '<option value="'+indexx+'" selected>'+valuee+'</option>';
                                    }else{
                                        state +=  '<option value="'+indexx+'">'+valuee+'</option>';
                                    }
                                })
                                if (dataResult.editagent.type_of_company == 'individual') {
                                    $('#state2').html(state);
                                }else {
                                    $('#editstate').html(state);
                                }
                            },
                            error: function(error){
                                if(error.statusText=="Forbidden"){
                                    $("#error-forbidden").modal("toggle");
                                }
                            }
                        });
                    }

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
                        swal("Success!", "Overseas Agent Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Overseas Agent status",
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
                        title: 'Overseas Agent Warning',
                        text: "Error. Could not confirm the status of the overseas agent.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        }

        function loadStateadd(value,dataid){
            var action = "{{ route('overseas-agent.state') }}?country_code=" + value;
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var state;
                    // console.log(dataResult);
                    state += '<option value disabled selected> Select State</option>';

                    $.each(dataResult, function (index, value) {
                        state +=  '<option value="'+index+'">'+value+'</option>';
                    })
                    if (dataid == 'company'){
                        $('#state').html(state);
                    }else{
                        $('#state-personal').html(state);
                    }
                },
                error: function(error){

                }
            });
        }

        function loadStateUpdate(value,dataid){
            var action = "{{ route('overseas-agent.state') }}?country_code=" + value;
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var state;
                    state += '<option value disabled selected> Select State</option>';
                    $.each(dataResult, function (index, value) {
                        state +=  '<option value="'+index+'">'+value+'</option>';
                    })
                    if (dataid == 'company-edits'){
                        $('#editstate').html(state);
                    }else{
                        $('#state2').html(state);
                    }

                },
                error: function(error){

                }
            });
        }

    </script>
@endsection
