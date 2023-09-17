@extends('layouts.master')
@section('title') Airline Details @endsection
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
                    <h3 class="page-title">Airline Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item active">Airline Details</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_airline_details"><i class="fa fa-plus"></i> Add Airline Detail </a>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('airline-details.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
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
                    <!-- Airline Details Table -->
                    <table id="airline-details-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Reference No</th>
                            <th>Country</th>
                            <th>State</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($airline_detail as $detail)
                            <tr>
                                <td> {{$i++}} </td>
                                <td>{{ucwords(@$detail->reference_no)}}</td>
                                @if($detail->country !== null)
                                @foreach(@$countries as $key => $value)
                                    @if($key == $detail->country)
                                        <td>{{ucwords($value)}} </td>
                                    @endif
                                @endforeach
                                @else
                                    <td>Not Set</td>
                                @endif
                                <td>
                                    @if($detail->country_state_id !== null)
                                        {{ucwords(@$detail->countryState->state)}}
                                    @else
                                     Not Set
                                    @endif
                                </td>
                                <td class="text-right">

                                    <div class="flex-shrink-0 ms-4">
                                        <ul class="list-inline tasks-list-menu mb-0">
                                            <li class="list-inline-item">
                                                <a class="action-edit" href="#" id="{{@$detail->id}}" hrm-update-action="{{route('airline-details.update',@$detail->id)}}"  hrm-edit-action="{{route('airline-details.edit',@$detail->id)}}" data-toggle="modal">
                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                            <li class="list-inline-item">
                                                <a class="remove-item-btn action-delete" href="#" hrm-delete-action="{{route('airline-details.destroy',@$detail->id)}}" >
                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>

                        @endforeach


                        </tbody>
                    </table>
                    <!-- /Airline Details Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->

    <!-- Add airline details Modal -->
    @include('admin.modals.airline_details.add')
    <!-- /Add airline details Modal -->

    <!-- edit airline details Modal -->
    @include('admin.modals.airline_details.edit')
    <!-- /edit airline details Modal -->

    <!-- Forbidden airline details Modal -->
    @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden airline details Modal -->


@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#airline-details-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });
        });

        $(document).on('change','select[name="country"]', function (e) {
            e.preventDefault();
            var value=$(this).val();
            var action = "{{ route('overseas-agent.state') }}?country_code=" + $(this).val();
            $.ajax({
                url: action,
                type: "GET",
                success: function(dataResult){
                    var state;
                    state += '<option value disabled selected> Select State</option>';

                    $.each(dataResult, function (index, value) {
                        state +=  '<option value="'+index+'">'+value+'</option>';
                    });

                    $('select[name="country_state_id"]').html(state);
                },
                error: function(error){

                }
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
                        swal("Trashed!", "Moved to Trash Successfully", "success");
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
                    console.log(dataResult)
                    $("#edit_airline_details").modal("toggle");
                    $('#reference_no').attr('value',dataResult.edit.reference_no);
                    $('.updatecountry option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                    $.each(dataResult.countries, function (index, value) {
                        if(index==dataResult.edit.country){
                            $('#select2-country-container').text(value);
                        }

                    });
                    var state;
                    state += '<option value disabled selected> Select State</option>';
                    var actionn = "{{ route('overseas-agent.state') }}?country_code=" + dataResult.edit.country_state.country_code;
                    $.ajax({
                        url: actionn,
                        type: "GET",
                        success: function(dataRes){
                            $.each(dataRes, function (indexx, valuee) {
                                if(indexx==dataResult.edit.country_state_id){
                                    state +=  '<option value="'+indexx+'" selected>'+valuee+'</option>';
                                }else{
                                    state +=  '<option value="'+indexx+'">'+valuee+'</option>';
                                }
                            })
                            $('.updatecountry_state_id').html(state);
                        },
                        error: function(error){}
                    });
                    $('.updateairlinedetails').attr('action',action);

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
