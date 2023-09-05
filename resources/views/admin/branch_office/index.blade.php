@extends('layouts.entry_master')
@section('title') Branch Office @endsection
@section('css')
<style>
    p.no-permission{
        color: #e81f1f;
        font-size: 20px;
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

    @if($errors->has('branch_office_name'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('branch_office_name')}}</span>
            </p>
        </div>
        @endif

        @if($errors->has('ref_no'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('ref_no')}}</span>
            </p>
        </div>
        @endif


    <!-- Page Content -->
    <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Branch Office</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                            <li class="breadcrumb-item active">Branch Office</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_branch_office"><i class="fa fa-plus"></i> Add Branch Office</a>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('branch-office.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                        <!-- Branch Office Table -->
                        <table id="branch-office-index" class="table table-striped custom-table mb-0 ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ref no.</th>
                                    <th>Branch Office Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Remarks</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach(@$branchoffices as $branchoffice)
                                <tr>
                                    <td> {{$i++}} </td>
                                    <td>{{$branchoffice->ref_no}}</td>
                                    <td>{{ucwords(@$branchoffice->branch_office_name)}}</td>
                                    <td>{{$branchoffice->address}}</td>
                                    <td>{{$branchoffice->contact_no}}</td>
                                    <td>{{$branchoffice->remarks}}</td>
                                    <td>
                                            <div class="dropdown">

                                                <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    {{(($branchoffice->status == "continued") ? "Continued":"Dis-Continued")}}
                                                </a>
                                                <div class="dropdown-menu">
                                                    @if(@$branchoffice->status == "continued")
                                                        <a class="dropdown-item status-update" hrm-update-action="{{route('branch-office.status.update',@$branchoffice->id)}}" href="#" id="discontinued">Dis-continued</a>
                                                    @else
                                                        <a class="dropdown-item status-update" hrm-update-action="{{route('branch-office.status.update',@$branchoffice->id)}}" href="#" id="continued">Continued</a>
                                                    @endif
                                                </div>
                                            </div>
                                    </td>
                                    <td class="text-right">
{{--                                        <div class="dropdown dropdown-action">--}}
{{--                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                <a class="dropdown-item action-view" href="#"  id="{{$branchoffice->id}}" hrm-view-action="{{route('branch-office.single',$branchoffice->id)}}" data-toggle="modal" data-target="#view_branch_office"><i class="fa fa-eye m-r-5"></i> View </a>--}}
{{--                                                <a class="dropdown-item action-edit" href="#" id="{{$branchoffice->id}}" hrm-update-action="{{route('branch-office.update',$branchoffice->id)}}"  hrm-edit-action="{{route('branch-office.edit',$branchoffice->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('branch-office.destroy',$branchoffice->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="flex-shrink-0 ms-4">
                                            <ul class="list-inline tasks-list-menu mb-0">

                                                <li class="list-inline-item">
                                                    <a class="action-view" href="#" id="{{$branchoffice->id}}" hrm-view-action="{{route('branch-office.single',$branchoffice->id)}}" data-toggle="modal" data-target="#view_branch_office">
                                                        <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                                <li class="list-inline-item">
                                                    <a class="action-edit" href="#" id="{{$branchoffice->id}}" hrm-update-action="{{route('branch-office.update',$branchoffice->id)}}"  hrm-edit-action="{{route('branch-office.edit',$branchoffice->id)}}" data-toggle="modal" >
                                                        <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                                <li class="list-inline-item">
                                                    <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('branch-office.destroy',$branchoffice->id)}}">
                                                        <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                        <!-- /Branch Office Table -->

                    </div>
                </div>
            </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Branch Office Modal -->
    @include('admin.modals.branch_office.add')
    <!-- /Add Branch Office Modal -->

    <!-- view Branch Office Modal -->
    @include('admin.modals.branch_office.view')
    <!-- /view Branch Office Modal -->

     <!-- Edit Branch Office Modal -->
     @include('admin.modals.branch_office.edit')
    <!-- /Edit Branch Office Modal -->

      <!-- Forbidden Branch Office Modal -->
      @include('admin.modals.attributes.forbidden')
    <!-- /Forbidden Branch Office Modal -->





@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#branch-office-index').DataTable({
            paging: true,
            searching: true,
            ordering:  true,
            lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

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
                            text: "You need to Remove Assigned Reference Information First",
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
                $("#edit_branchoffice").modal("toggle");
                $('.updaterefno').attr('value',dataResult.ref_no);
                $('.updatebranchofficename').attr('value',dataResult.branch_office_name);
                $('.updateaddress').attr('value',dataResult.address);
                $('.updatecontact').attr('value',dataResult.contact_no);
                $('.updateremark').text(dataResult.remarks);
                $('select[name="status"] option[value="'+dataResult.status+'"]').prop('selected', true);
                $('.updatebranchoffice').attr('action',action);
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
                    $('#view-ref_no').text(dataResult.show.ref_no);
                    $('#view-branch_office_name').text(dataResult.show.branch_office_name);
                    $('#view-contact_no').text(dataResult.show.contact_no);
                    $('#view-address').text(dataResult.show.address);
                    $('#view-status').text(dataResult.show.status);
                    if(dataResult.show.remarks !== null){
                        $('#view-remarks').text(dataResult.show.remarks);
                    }else{
                        $('#view-remarks').text('N/A');
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
                    text: "The branch office status to Dis-continued will prevent them from displaying in Reference Entry in. \n \n Set their status to continued to enable the displaying in Reference Entry!",
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
                        swal("Success!", "Branch Office Status has been updated", "success");
                        $(dataResult).remove();
                        setTimeout(function() {
                            window.location.reload();
                        }, 2500);
                    }else{
                        swal({
                            title: "Error!",
                            text: "Failed to update Branch Office status",
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
                        title: 'Branch Office Warning',
                        text: "Error. Could not confirm the status of the branch office.",
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
