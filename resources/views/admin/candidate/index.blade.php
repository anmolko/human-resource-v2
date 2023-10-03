@extends('layouts.master')
@section('title') Candidate @endsection
@section('css')
    <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/css/nepali.datepicker.v3.5.min.css')}}">
    <style>
        .modal-lg, .modal-xl {
            max-width: 920px;
        }
    /*
    *
    * ==========================================
    * CUSTOM UTIL CLASSES
    * ==========================================
    */
    #v-pills-tabContent {
        padding-top: 0;
    }

        .custom-modal .modal-content {
            background-color: #f6f8f6;
        }

    .select-height{
        height: 44px;
    }
    .nav-pills-custom .nav-link {
        color: #8595ad;
        background: #fff;
        position: relative;
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link::before {
            content: '';
            display: block;
            border-top: 8px solid transparent;
            border-left: 10px solid #fff;
            border-bottom: 8px solid transparent;
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            opacity: 0;
        }
    }

    .nav-pills-custom .nav-link.active::before {
        opacity: 1;
    }
    @media (min-width: 768px) {
    .side-tab-sticky{
        position: sticky;
        overflow-y: auto;
        top: 75px;
        bottom: 0;
        height: 160vh;
    }
}

    #select2-candidate_type-container{
        text-transform: capitalize;
    }
    #select2-martial_status-container{
        text-transform: capitalize;
    }
    #select2-kin_relationship-container{
        text-transform: capitalize;
    }
    #select2-gender-container{
        text-transform: capitalize;
    }
    #select2-religion-container{
        text-transform: capitalize;
    }

   .group {
       display: inline-block;
       margin-right: 1rem;
   }

    .notation {
        display: inline-block;
        position: relative;
        cursor: pointer;
        width: 395px;
        height: 45em;
        filter: grayscale(100%) opacity(70%);
        transition: all .5s ease;
    }

    .notation:hover {
        filter: grayscale(50%) opacity(85%);
        box-shadow: 0 0 15px #777;
    }


   .input-radios {
       position: absolute;
       z-index: 10;
       display: none;
       outline: none;
   }

    .input-radios:active + .notation, .input-radios:checked + .notation {
        filter: none;
        box-shadow: 0 2px 20px #777;
    }

   .spanned {
       position: absolute;
       top: 101%;
       left: 0;
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
                    <h3 class="page-title">Candidate Entry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Candidate Entry</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_candidate_personal_info"><i class="fa fa-plus"></i> Add Candidate Info</a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('candidate-personal-info.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->

        @include('admin.candidate.partials.filter')

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <form action="#" method="post" id="deleted-form" >
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="delete">
                    </form>
                    <!-- Candidate Personal Table -->
                    <table id="candidate-index" class="table table-striped custom-table mb-0 ">
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn btn-sm btn-info print-candidate-app"><i class="fa fa-print"></i> Print Application</a>
                        </div>
                        <form action="#" method="post" route id="candidate-application-form" >
                            {{csrf_field()}}

                        </form>
                        <thead>
                        <tr>
                            <th>
                                <button class="btn btn-sm btn-info" id="select-all"
                                 value="check all">select all</button>
                            </th>
                            <th>Fullname</th>
                            <th>Registration No.</th>
                            <th>Serial No.</th>
                            <th>Contact Number</th>
                            <th>Passport No.</th>
                            <th>Created By</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        @php($i=1)--}}
{{--                        @foreach(@$candidate_personal as $personal)--}}
{{--                            <tr>--}}
{{--                                <td><label><input type="checkbox" name="cb-element" class="cb-element" value="{{@$personal->id}}" {{ ($personal->demandJobInfo !== null) ? "":"disabled readonly" }}  /></label></td>--}}
{{--                                <td><a href="{{route('candidate-individual.dashboard',$personal->id)}}" >{{@$personal->candidate_firstname}} {{@$personal->candidate_middlename}} {{@$personal->candidate_lastname}}</a></a></td>--}}
{{--                                <td>{{@$personal->registration_no}}</td>--}}
{{--                                <td>{{@$personal->serial_no}}</td>--}}
{{--                                <td>{{@$personal->contact_no}},<br/> {{@$personal->mobile_no}}</td>--}}
{{--                                <td>{{ucwords(@$personal->passport_no)}}</td>--}}
{{--                                <td> {{ucwords( $personal->createdBy() ? $personal->createdBy()->name :'' )}}</td>--}}
{{--                                <td class="text-right">--}}
{{--                                    <div class="flex-shrink-0 ms-4">--}}
{{--                                        <ul class="list-inline tasks-list-menu mb-0">--}}
{{--                                            <li class="list-inline-item">--}}
{{--                                                <a class="action-edit" href="#" hrm-edit-action="{{route('candidate-personal-info.edit',$personal->id)}}" hrm-update-action="{{route('candidate-personal-info.update',$personal->id)}}" data-toggle="modal">--}}
{{--                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>--}}
{{--                                            <li class="list-inline-item">--}}
{{--                                                <a class="edit-item-btn" href="{{route('candidate-personal-info.addalldetails',$personal->id)}}" id="{{$personal->id}}">--}}
{{--                                                    <i class="fa fa-plus align-bottom me-2 text-muted"></i> </a></li>--}}
{{--                                            <li class="list-inline-item">--}}
{{--                                                <a class="remove-item-btn action-delete" hrm-delete-action="{{route('candidate-personal-info.destroy',$personal->id)}}">--}}
{{--                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
                        </tbody>
                    </table>
                    <!-- /Candidate Entry Table -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Content -->

    <!-- Add candidate personal info Modal -->
    @include('admin.modals.candidate.add')
    <!-- /Add candidate personal info Modal -->

    <!-- Add candidate personal info Modal -->
    @include('admin.modals.candidate.edit')
    <!-- /Add candidate personal info Modal -->

    {{--professional modals--}}

    <!-- Add candidate personal info Modal -->
    @include('admin.modals.candidate.professional.add')
    <!-- /Add candidate personal info Modal -->

     <!-- Forbidden Attribute Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Attribute Modal -->

    <!-- view Branch Office Modal -->
    @include('admin.modals.application.chooseapp')
    <!-- /view Branch Office Modal -->

@endsection
@section('js')
    <script src="{{asset('backend/assets/js/nepali.datepicker.v3.5.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    @include('admin.candidate.partials.script')

    <script>
        let dataTables = $('#candidate-index').DataTable({
            processing:true,
            serverSide: true,
            searching: true,
            stateSave: true,
            order:[[1,'asc']],
            aaSorting: [],
            ajax: {
                "url": '{{ route('candidate-personal-info.data') }}',
                "type": 'POST',
                'data': function (d) {
                    d._token         = '{{csrf_token()}}';
                    d.filter_period  = $('#filter_period').val();
                    d.from_date      = $('#from_date').val();
                    d.to_date        = $('#to_date').val();
                    d.created_by     = $('#created_by').val();
                }
            },
            columns :[
                {data:'check_item', name: 'check_item', searchable:false, orderable: false},
                {data:'full_name', name: 'full_name', searchable:true, orderable: false},
                {data:'registration_no', name: 'registration_no', searchable:true, orderable: false},
                {data:'serial_no', name: 'serial_no', searchable:true, orderable: true},
                {data:'mobile_no', name: 'mobile_no', searchable:true, orderable: true},
                {data:'passport_no', name: 'passport_no', searchable:true, orderable: false},
                {data:'created_by', name: 'created_by', searchable:false, orderable: false},
                {data:'action', name: 'action', searchable:false, orderable: false},
            ]
        })

        $(document).on('click', '#filter_data', function(){
            dataTables.draw();
        });

    </script>

@endsection
