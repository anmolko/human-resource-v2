@extends('layouts.entry_master')
@section('title') Candidate Entry @endsection
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
                    <h3 class="page-title">Candidate Entry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate-personal-info.index')}}">Candidate Entry</a></li>
                        <li class="breadcrumb-item active">Candidate Entry Trash</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <form action="#" method="post" id="deleted-form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">

                    </form>
                    <!-- Candidate personal Information Table -->
                    <table id="candidate_personal_information" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Registration No.</th>
                            <th>Serial No.</th>
                            <th>Contact Number</th>
                            <th>Passport No.</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($trashed as $trash)
                            <tr>
                                <td> {{$trash->candidate_firstname}}  {{$trash->candidate_middlename}} {{$trash->candidate_lastname}}</td>
                                <td> {{ucwords($trash->registration_no)}}  </td>
                                <td>{{@$trash->serial_no}}</td>
                                <td>{{@$trash->contact_no}},<br/> {{@$trash->mobile_no}}</td>
                                <td>{{ucwords(@$trash->passport_no)}}</td>
                                <td class="text-right">
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-restore" href="#" hrm-restore-action="{{route('candidate-personal-info.restore',$trash->id)}}" data-toggle="modal" data-target="#restore_candidate_info">
                                                    <i class="fa fa-refresh align-bottom me-2 text-muted"></i></a></li>

                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-per-delete" hrm-delete-per-action="{{route('candidate-personal-info.remove',$trash->id)}}">
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
                    <!-- /Candidate Personal Information Table -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Restore Candidate Personal Info Modal -->
    @include('admin.modals.candidate.restore')
    <!-- /Restore Candidate Personal Info Modal -->

@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#candidate_personal_information').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
        });

        $(document).on('click','.action-per-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-per-action');
            form.attr('action',$(this).attr('hrm-delete-per-action'));
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
                        // toastr.success('file deleted Successfully');
                        $(response).remove();
                        window.location.reload();

                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Bad Response - 502",
                                text: "Something went wrong !",
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

        $(document).on('click','.action-restore', function (e) {
            e.preventDefault();
            var action = $(this).attr('hrm-restore-action');
            $('.restore-link').attr('href',action);
        })

    </script>
@endsection
