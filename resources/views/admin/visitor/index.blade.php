@extends('layouts.master')
@section('title') Visitor @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }

        .select2-container {
            width: 255px;
        }

        .add-btn{
            margin-right: 10px;
        }

         .select-height{
            height:44px;
        }

        .profile-img-wrap{
            position: unset;
        }
        .profile-view .profile-img {
            margin-bottom: 20px;
        }

        .profile-view .profile-img-wrap {
                display: contents;
            }

        span#select2-edit_employee_id-container {
            text-transform: capitalize;
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

    @if($errors->has('image'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('image')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Visitor</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Visitor</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_visitor"><i class="fa fa-plus"></i> Add Visitor</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('visitor.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Visitor Agent Table -->
                    <table id="visitor-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Visitor Name & ID</th>
                            <th>Date & Time</th>
                            <th>Mobile No.</th>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($visitors as $visitor)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar">
                                            <img alt="{{$visitor->visitor_name}}" src="<?php if(!empty($visitor->image)){ echo '/images/visitor/'.$visitor->image; } else { echo '/images/profiles/male.png'; } ?>" />
                                        </a>
                                        <a href="#">{{ucwords(@$visitor->visitor_name)}}
                                        <span>  {{@$visitor->visitor_id}}
                                                        </span></a>
                                    </h2>
                                </td>
                                @if($visitor->updated_by == null)
                                <td>{{\Carbon\Carbon::parse($visitor->created_at)->isoFormat('MMMM Do, YYYY, h:mm:ss a')}}</td>
                                @else
                                <td>{{\Carbon\Carbon::parse($visitor->updated_at)->isoFormat('MMMM Do, YYYY, h:mm:ss a')}}</td>
                                @endif
                                <td>{{ucwords(@$visitor->mobile_no)}}</td>
                                <td>{{ucwords(@$visitor->employee->user->name)}}</td>
                                <td>{{ucwords(@$visitor->employee->designation->name)}}</td>

                                <td class="text-right">
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-view" href="#"  id="{{$visitor->id}}" hrm-view-action="{{route('visitor.single',$visitor->id)}}" data-toggle="modal" data-target="#view_visitor">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{@$visitor->id}}" hrm-update-action="{{route('visitor.update',@$visitor->id)}}"  hrm-edit-action="{{route('visitor.edit',@$visitor->id)}}" data-toggle="modal">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('visitor.destroy',@$visitor->id)}}">
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Visitor Agent Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Visitor Modal -->
    @include('admin.modals.visitor.add')
    <!-- /Add Visitor Modal -->

     <!-- Add Visitor Modal -->
     @include('admin.modals.visitor.view')
    <!-- /Add Visitor Modal -->

    <!-- edit Visitor Modal -->
    @include('admin.modals.visitor.edit')
    <!-- /edit Visitor Modal -->

     <!-- Forbidden Sub Status Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Sub Status Modal -->


@endsection
@section('js')
    <script type="text/javascript">
      var loadFile = function(event) {
            var image = document.getElementById('image');
            var replacement = document.getElementById('current-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };

        var loadEdit = function(event) {
            var image = document.getElementById('image-edit');
            var replacement = document.getElementById('currentedit-img');
            replacement.src = URL.createObjectURL(event.target.files[0]);
        };
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#visitor-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            $( "select[name='employee_id']" ).select2({
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
                    console.log(dataResult)
                    $("#edit_visitor").modal("toggle");
                    $('.updatevisitorid').attr('value',dataResult.visitor_id);
                    $('.updatevisitorname').attr('value',dataResult.visitor_name);
                    $('.updatemobile').attr('value',dataResult.mobile_no);
                    $('.updatereason').attr('value',dataResult.reason);
                    $('.updatemisc').text(dataResult.misc);


                    if(dataResult.image == null ){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/visitor/'+dataResult.image;
                    }
                    $('#currentedit-img').attr('src',src);


                    $('select[name="employee_id"] option[value="'+dataResult.employee.id+'"]').prop('selected', true);
                    $('#select2-edit_employee_id-container').text(dataResult.employee.user.name);

                    $('.updatevisitor').attr('action',action);


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
                    // console.log(dataResult)
                    $('#view-visitor_id').text(dataResult.show.visitor_id);
                    $('#view-visitor_name').text(dataResult.show.visitor_name);
                    $('#view-employee_name').text(dataResult.show.employee.user.name);
                    $('#view-employee_desigination').text(dataResult.show.employee.designation.name);
                    $('#view-mobile_no').text(dataResult.show.mobile_no);
                    $('#view-reason').text(dataResult.show.reason);
                    $('#view-date').text(dataResult.date);

                    if(dataResult.show.misc !== null){
                        $('#view-misc').text(dataResult.show.misc);

                    }else{
                        $('#view-misc').text('N/A');
                    }

                    if(dataResult.show.image == null ){
                        src = '/images/profiles/male.png';
                    }else{
                        src = '/images/visitor/'+dataResult.show.image;
                    }
                    $('#user-image').attr('src',src);


                }
            });
        });


    </script>
@endsection
