@extends('layouts.candidate_master')
@section('title')  Files @endsection
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
                    <h3 class="page-title">{{ucwords(@$folder->candidate->candidate_firstname)}} {{ucwords(@$folder->candidate->candidate_middlename)}} {{ucwords(@$folder->candidate->candidate_lastname)}}'s Files</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('folder.index')}}">Folders</a></li>
                        <li class="breadcrumb-item active">{{@$folder->folder_name}}</li>
                    </ul>
                </div>

                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_file"><i class="fa fa-plus"></i> Add File</a>
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
                    <!-- Files Table -->
                    <table id="files-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Added By</th>
                            <th>Added From</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($files as $file)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$file->type)}}</td>
                                <td> {{ucwords(App\Models\User::find($file->created_by)->name)}}</td>
                                <td>
                                    @if($file->status == "0")
                                    Candidate Entry
                                    @else
                                    File Manager
                                    @endif
                                </td>
                                <td>{{\Carbon\Carbon::parse($file->created_at)->isoFormat('MMMM Do, YYYY')}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item "href="{{ route('file.download',$file->filename) }}" ><i class="fa fa-cloud-download m-r-5"></i> Download</a>
                                            @if($file->status=='1')
                                            <a class="dropdown-item action-edit" href="#"  hrm-update-action="{{route('file.update',@$file->id)}}"  hrm-edit-action="{{route('file.edit',@$file->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('file.destroy',$file->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>

                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    <!-- /Files Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->
    
    <!-- Add File Modal -->
    @include('admin.modals.file.add')
    <!-- /Add File Modal -->
 
  <!-- Edit File Modal -->
  @include('admin.modals.file.edit')
    <!-- /Edit File Modal -->

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
            $('#files-index').DataTable({
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
                text: "You will not be able to recover this",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                            swal("Deleted!", "Deleted Successfully", "success");
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
                    $("#edit_file").modal("toggle");
                  
                    $('#type option[value="'+dataResult.type+'"]').prop('selected', true);
                    $('.updatefile').attr('action',action);
                  
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
