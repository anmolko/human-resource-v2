@extends('layouts.entry_master')
@section('title') Demand Information @endsection
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
                    <h3 class="page-title">Demand Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('demand-info.index')}}">Demand Information</a></li>
                        <li class="breadcrumb-item active">Demand Information Trash</li>
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
                    <!-- Demand Information Table -->
                    <table id="demand_information" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>Demand Ref No</th>
                            <th>Company Name</th>
                            <th>Country - State</th>
                            <th>Issued Date</th>
                            <th>Overseas Agent</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($trashed as $trash)
                            <tr>
                                <td> {{$trash->ref_no}}          </td>
                                <td> {{ucwords($trash->company_name)}}  </td>
                                @foreach(@$countries as $key => $value)
                                    @if($key== $trash->country)
                                        <td>{{ucwords($value)}} -
                                            @endif
                                            @endforeach
                                            <?php  $states=CountryState::getStates(@$trash->country);
                                            ?>
                                            @foreach(@$states as $key => $value)
                                                @if($key== $trash->state)
                                                    {{ucwords($value)}}
                                        </td>
                                    @endif
                                @endforeach
                                <td>{{\Carbon\Carbon::parse($trash->issued_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                <td>{{ucwords(App\Models\OverseasAgent::find($trash->overseas_agent_id)->fullname)}}</td>
                                <td> {{ucwords($trash->status)}}
                                </td>
                                <td class="text-right">
                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-restore" href="#" hrm-restore-action="{{route('demand-info.restore',$trash->id)}}" data-toggle="modal" data-target="#restore_demand_info">
                                                    <i class="fa fa-refresh align-bottom me-2 text-muted"></i></a></li>

                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-per-delete" hrm-delete-per-action="{{route('demand-info.remove',$trash->id)}}">
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
                    <!-- /Demand Info Table -->

                </div>
            </div>
        </div>




    </div>
    <!-- /Page Content -->

    <!-- Restore Overseas Agent Modal -->
    @include('admin.modals.demand_information.restore')
    <!-- /Restore Overseas Agent Modal -->

@endsection

@section('js')

    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#demand_information').DataTable({
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

        $(document).on('click','.action-restore', function (e) {
            e.preventDefault();
            var action = $(this).attr('hrm-restore-action');
            $('.restore-link').attr('href',action);
        })

    </script>
@endsection
