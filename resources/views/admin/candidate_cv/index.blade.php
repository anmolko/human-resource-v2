@extends('layouts.master')
@section('title') Candidate CV  @endsection
@section('css')
    <style>
        p.no-permission{
            color: #e81f1f;
            font-size: 20px;
        }

        .select2-container {
            width: 740px;
            display: table-cell;
        }

        .ck-editor__editable_inline {
            min-height: 200px !important;
            max-height: 200px !important;
        }



        .ck.ck-balloon-panel {
            z-index: 1050 !important;
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

    @if($errors->has('candidate_personal_information_id'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('candidate_personal_information_id')}}</span>
            </p>
        </div>
    @endif

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Candidate CV</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Candidate CV Info</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_candidate_cv"><i class="fa fa-plus"></i> Add Candidate CV Info</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('candidate-cv-info.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Candidate CV Table -->
                    <table id="candidate-cv-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Candidate Name</th>
                            <th>About Me</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($candidate_cvs as $candidate_cv)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords($candidate_cv->personalInfo->candidate_firstname)}} {{ucwords($candidate_cv->personalInfo->candidate_middlename)}} {{ucwords($candidate_cv->personalInfo->candidate_lastname)}}</td>
                                <td>{{ucwords(@$candidate_cv->profile)}}</td>

                                <td> {{ucwords(App\Models\User::find($candidate_cv->created_by)->name)}}</td>
                                <td>@if(isset($candidate_cv->updated_by))
                                        {{ucwords(App\Models\User::find($candidate_cv->updated_by)->name)}}
                                    @else
                                        This is not Updated Yet.
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item action-edit" href="#" id="{{$candidate_cv->id}}" hrm-update-action="{{route('candidate-cv-info.update',$candidate_cv->id)}}"  hrm-edit-action="{{route('candidate-cv-info.edit',$candidate_cv->id)}}" data-toggle="modal" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('candidate-cv-info.destroy',$candidate_cv->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Candidate CV Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add Candidate CV Modal -->
    @include('admin.modals.candidate_cv.add')
    <!-- /Add Candidate CV Modal -->

    <!-- edit Candidate CV Modal -->
    @include('admin.modals.candidate_cv.edit')
    <!-- /edit Candidate CV Modal -->

     <!-- Forbidden Candidate CV Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Candidate CV Modal -->

@endsection
@section('js')
    <script src="{{asset('backend/assets/plugins/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript">

function createEditor ( elementId ) {
            return ClassicEditor
                .create( document.querySelector( '#' + elementId ), {
                    toolbar : {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', '|',
                            'outdent', 'indent', '|',
                            'bulletedList', 'numberedList', '|',
                            'insertTable', 'blockQuote', '|',
                            'undo', 'redo'
                        ],
                    },
                    link: {
                        // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                        addTargetToExternalLinks: true,

                        // Let the users control the "download" attribute of each link.
                        decorators: [
                            {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'download'
                                }
                            }
                        ]
                    },
                } )
                .then( editor => {
                    window.editor = editor;
                    editor.model.document.on( 'change:data', () => {
                        $( '#' + elementId).text(editor.getData());
                    } );

                } )
                .catch( err => {
                    console.error( err.stack );
                } );
        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#candidate-cv-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });

            $( "select[name='candidate_personal_information_id']" ).select2({
                width: 'style',
            });

            $( "select[id='candidate_personal_information']" ).select2({
                width: 'style',
            });

            ClassicEditor
                .create( document.querySelector( '#skill' ), {
                    toolbar : {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', '|',
                            'outdent', 'indent', '|',
                            'bulletedList', 'numberedList', '|',
                            'insertTable', 'blockQuote', '|',
                            'undo', 'redo'
                        ],
                    },
                    link: {
                        // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                        addTargetToExternalLinks: true,

                        // Let the users control the "download" attribute of each link.
                        decorators: [
                            {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'download'
                                }
                            }
                        ]
                    },
                } )
                .then( skilleditor => {
                    window.skilleditor = skilleditor;
                    skilleditor.model.document.on( 'change:data', () => {
                        $( '#skill').text(skilleditor.getData());
                    } );

                } )
                .catch( err => {
                    console.error( err.stack );
                } );

                ClassicEditor
                .create( document.querySelector( '#duty' ), {
                    toolbar : {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'link', '|',
                            'outdent', 'indent', '|',
                            'bulletedList', 'numberedList', '|',
                            'insertTable', 'blockQuote', '|',
                            'undo', 'redo'
                        ],
                    },
                    link: {
                        // Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
                        addTargetToExternalLinks: true,

                        // Let the users control the "download" attribute of each link.
                        decorators: [
                            {
                                mode: 'manual',
                                label: 'Downloadable',
                                attributes: {
                                    download: 'download'
                                }
                            }
                        ]
                    },
                } )
                .then( dutyeditor => {
                    window.dutyeditor = dutyeditor;
                    dutyeditor.model.document.on( 'change:data', () => {
                        $( '#duty').text(dutyeditor.getData());
                    } );

                } )
                .catch( err => {
                    console.error( err.stack );
                } );


            createEditor('storeskill');
            createEditor('storeduty');

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
                                text: "You need to Remove Assigned Information First",
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
                    // console.log(dataResult)
                    $("#edit_candidate_cv").modal("toggle");
                    $('.updateprofile').text(dataResult.edit.profile);
                    skilleditor.setData( dataResult.edit.skill );
                    dutyeditor.setData( dataResult.edit.duty );

                    // $('.updateskill').text(dataResult.edit.skill);
                    // $('.updateduty').text(dataResult.edit.duty);
                    $('.updatedeclaration').text(dataResult.edit.declaration);
                    $('.updatecandidate option[value="'+dataResult.edit.candidate_personal_information_id+'"]').prop('selected', true);
                    $('.updatecandidatecv').attr('action',action);
                    $.each(dataResult.candidates, function (index, value) {
                        if(value.id==dataResult.edit.candidate_personal_information_id){
                            $('#select2-candidate_personal_information_id-container').text(dataResult.name);
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



    </script>
@endsection
