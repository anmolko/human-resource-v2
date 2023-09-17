@extends('layouts.master')
@section('title') Counsellor @endsection
@section('css')
<style>
    p.no-permission{
        color: #e81f1f;
        font-size: 20px;
    }
    .select-height{
            height:44px;
        }

        .select2-container {
            width: 440px;
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



    <!-- Page Content -->
    <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Counsellor</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                            <li class="breadcrumb-item active">Counsellor</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_counsellor"><i class="fa fa-plus"></i> Add Counsellor</a>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="{{route('counsellor.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                        <!-- Counsellor Table -->
                        <table id="counsellor-index" class="table table-striped custom-table mb-0 ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Caller Name</th>
                                    <th>Response</th>
                                    <th >Response Via</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach(@$counsellors as $counsellor)
                                <tr>
                                    <td> {{$i++}} </td>
                                    <td>{{ucwords($counsellor->agent->fullname)}}</td>
                                    <td>{{$counsellor->response}}</td>
                                    <td class="text-uppercase">{{$counsellor->response_via}}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item action-view" href="#"  id="{{$counsellor->id}}" hrm-view-action="{{route('counsellor.single',$counsellor->id)}}" data-toggle="modal" data-target="#view_counsellor"><i class="fa fa-eye m-r-5"></i> View </a>
                                                <a class="dropdown-item action-edit" href="#" id="{{$counsellor->id}}" hrm-update-action="{{route('counsellor.update',$counsellor->id)}}"  hrm-edit-action="{{route('counsellor.edit',$counsellor->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('counsellor.destroy',$counsellor->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach


                            </tbody>
                        </table>
                        <!-- /Counsellor Table -->

                    </div>
                </div>
            </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Counsellor Modal -->
    @include('admin.modals.counsellor.add')
    <!-- /Add Counsellor Modal -->

    <!-- view Counsellor Modal -->
    @include('admin.modals.counsellor.view')
    <!-- /view Counsellor Modal -->

     <!-- Edit Counsellor Modal -->
     @include('admin.modals.counsellor.edit')
    <!-- /Edit Counsellor Modal -->

      <!-- Forbidden Counsellor Modal -->
      @include('admin.modals.attributes.forbidden')
    <!-- /Forbidden Counsellor Modal -->





@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#counsellor-index').DataTable({
            paging: true,
            searching: true,
            ordering:  true,
            lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

        });

        $( "select[name='overseas_agent_id']" ).select2({
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
                // $('#id').val(data.id);
                $("#edit_counsellor").modal("toggle");
                $('.updatedescription').text(dataResult.description);
                $('.updateresponse').text(dataResult.response);
                $('.updatemisc').text(dataResult.misc);
                $('select[name="response_via"] option[value="'+dataResult.response_via+'"]').prop('selected', true);
                $('select[name="overseas_agent_id"] option[value="'+dataResult.agent.id+'"]').prop('selected', true);
                    $('#select2-edit_overseas_agent_id-container').text(dataResult.agent.fullname);

                $('.updatecounsellor').attr('action',action);
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
                    $('#view-response').text(dataResult.response);
                    $('#view-description').text(dataResult.description);
                    $('#view-response_via').text(dataResult.response_via);
                    $('#view-name').text(dataResult.agent.fullname);

                    if(dataResult.misc !== null){
                        $('#view-misc').text(dataResult.misc);
                    }else{
                        $('#view-misc').text('N/A');
                    }

                }
            });
    });




</script>
@endsection
