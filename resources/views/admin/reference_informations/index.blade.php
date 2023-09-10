@extends('layouts.entry_master')
@section('title') Reference Informaton @endsection
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

        td.details-controls {
            text-align:center;
            cursor: pointer;
        }
        tr.shown td.details-controls {
            text-align:center;
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
                    <h3 class="page-title">Reference Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Reference Information</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_reference_info"><i class="fa fa-plus"></i> Add Reference Information</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('reference-info.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Reference Group Table -->
                    <table id="reference-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Reference Name</th>
                            <th>Branch Office </th>
                            <th>Country</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($reference_info as $reference)
                            <tr >
                            <td> {{$i++}} </td>
                                <td>{{ucwords($reference->reference_name)}} </td>
                                <td>{{ucwords(@$reference->branchOffice->branch_office_name)}}</td>
                                @foreach(@$countries as $key => $value)
                                    @if($key== $reference->country)
                                        <td>{{ucwords($value)}} </td>
                                            @endif
                                @endforeach
                                <td>{{$reference->email_address}}</td>
                                <td> @if ($reference->status=='continued')
                                            <i class="fa fa-dot-circle-o text-success"></i> Continued
                                            @else
                                            <i class="fa fa-dot-circle-o text-danger"></i> Discontinued
                                            @endif
                                        </td>
                                <td class="text-right">
{{--                                    <div class="dropdown dropdown-action">--}}
{{--                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                        <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                            <a class="dropdown-item action-view" href="{{route('reference-info.show',$reference->id)}}"  id="{{$reference->id}}"><i class="fa fa-eye m-r-5"></i> View More Info</a>--}}
{{--                                            <a class="dropdown-item action-edit" href="#" id="{{$reference->id}}" hrm-update-action="{{route('reference-info.update',$reference->id)}}"  hrm-edit-action="{{route('reference-info.edit',$reference->id)}}" data-toggle="modal" data-target="#edit_reference_info"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('reference-info.destroy',$reference->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-view" href="{{route('reference-info.show',$reference->id)}}"  id="{{$reference->id}}">
                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{$reference->id}}" hrm-update-action="{{route('reference-info.update',$reference->id)}}"  hrm-edit-action="{{route('reference-info.edit',$reference->id)}}" data-toggle="modal" data-target="#edit_reference_info">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#"  hrm-delete-action="{{route('reference-info.destroy',$reference->id)}}">
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
                    <!-- /Reference Info Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->


    <!-- Add Reference Info Modal -->
    @include('admin.modals.reference_information.add')
    <!-- /Add Reference Info Modal -->

    <!-- update Reference Modal -->
    @include('admin.modals.reference_information.edit')
    <!-- /update Reference Modal -->


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

            $( "select[name='country']" ).select2({
                width: 'style',
            });

            <?php if(@$theme_data->default_date_format=='nepali'){ ?>

            $('#datetimepicker').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datetimepicker1').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datetimepicker2').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#datetimepicker3').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('#datetimepicker-edit').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }else if(@$theme_data->default_date_format=='english'){ ?>


            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD'

            });
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'

            });

            <?php }else{?>
            $('#datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker3').datetimepicker({
                format: 'YYYY-MM-DD'
            })
            $('#datetimepicker-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            })

            <?php }?>



            $('#reference-index').DataTable({
                paging: true,
                searching: true,
                orderable: false,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],
            });



        });

        $(document).on('change','input[name="name_of_professional"]', function (e) {
            e.preventDefault();
            if($(this).prop("checked") == true){
                $(".membership_no").attr("required", "required");
                $(".name_of_organization").attr("required", "required");

                $(".membership_no").removeAttr("readonly", "readonly");
                $(".name_of_organization").removeAttr("readonly", "readonly");
            }
            else if($(this).prop("checked") == false){
                $(".membership_no").removeAttr("required", "required");
                $(".name_of_organization").removeAttr("required", "required");

                $(".membership_no").attr("readonly", "readonly");
                $(".name_of_organization").attr("readonly", "readonly");
            }

        })


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
                                text: "You need to Remove Assigned Candidate Entry First",
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
                    // console.log(dataResult);
                    // console.log(dataResult.editreference.branch_office.id);
                    $("#updatereference").modal("toggle");
                    $('#reference_name').attr('value',dataResult.editreference.reference_name);
                    $('#optional_name').attr('value',dataResult.editreference.optional_name);
                    $('#company').attr('value',dataResult.editreference.company);
                    $('#address').attr('value',dataResult.editreference.address);
                    $('#contact_no').attr('value',dataResult.editreference.contact_no);
                    $('#mobile_no').attr('value',dataResult.editreference.mobile_no);
                    $('#website').attr('value',dataResult.editreference.website);
                    $('#email_address').attr('value',dataResult.editreference.email_address);

                    if(dataResult.editreference.name_of_organization !=null){
                        $('input[name="name_of_professional"]').attr("checked", "true");
                        $("#membership_no").attr("required", "required");
                        $("#name_of_organization").attr("required", "required");

                        $("#membership_no").removeAttr("readonly", "readonly");
                        $("#name_of_organization").removeAttr("readonly", "readonly");

                    }else{
                        $('input[name="name_of_professional"]').removeAttr("checked", "true");
                        $("#membership_no").removeAttr("required", "required");
                        $("#name_of_organization").removeAttr("required", "required");

                        $("#membership_no").attr("readonly", "readonly");
                        $("#name_of_organization").attr("readonly", "readonly");

                    }

                    $('#name_of_organization').attr('value',dataResult.editreference.name_of_organization);
                    $('#membership_no').attr('value',dataResult.editreference.membership_no);


                    $('select[name="branch_office_id"] option[value="'+dataResult.editreference.branch_office.id+'"]').prop('selected', true);
                    // $('select[name="status"] option[value="'+dataResult.editreference.status+'"]').prop('selected', true);

                    // $('.updatecountry option[value="'+dataResult.editreference.country+'"]').prop('selected', true);

                    if(dataResult.editreference.image == null){
                        src = '/images/profiles/others.png';
                    }else{
                        src = '/images/referenceinfo/'+dataResult.editreference.image;
                    }
                    $('#edit-current-img').attr('src',src);

                    if(dataResult.editreference.identification_image){
                        var imageUrl = '/images/referenceinfo/'+dataResult.editreference.identification_image; // Replace with the actual image URL

                        // Create a new image element
                        var link = $('<a>').attr('href', imageUrl).attr('target','_blank');

                        link.text('View Identification image')

                        // Append the image to the div with the id "imageContainer"
                        $('#image-view').html('').append(link);
                    }else{
                        $('#image-view').html('');                    }



                    $('.updatereference').attr('action',action);


                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.editreference.country){
                            $('#select2-editcountry-container').text(value);
                        }

                    });


                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        // $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });


    </script>
@endsection
