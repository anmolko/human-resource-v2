@extends('layouts.master')
@section('title') Folders @endsection
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
                    <h3 class="page-title">Folders</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item active">Folders</li>
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
                        <input name="_method" type="hidden" value="delete">

                    </form>
                    <!-- Folders Table -->
                    <table id="folders-index" class="table table-striped custom-table mb-0 ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Folder Name</th>
                            <th>Candidate Name</th>
                            <th>Added By</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($folders as $folder)
                            <tr>
                                <td> {{$i++}} </td>
                                <td><a href="{{route('file.index',$folder->id)}}">{{@$folder->folder_name}}</a></td>

                                <td>
                                @if(@$folder->candidate->candidate_firstname)
                                {{ucwords(@$folder->candidate->candidate_firstname)}} {{ucwords(@$folder->candidate->candidate_middlename)}} {{ucwords(@$folder->candidate->candidate_lastname)}}
                                @else
                               <span style="color: red;"> Candidate move to trash <span>
                                @endif
                                </td>
                                <td> {{ucwords(App\Models\User::find($folder->created_by)->name)}}</td>
                                <td>{{\Carbon\Carbon::parse($folder->created_at)->isoFormat('MMMM Do, YYYY')}}</td>

                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    <!-- /Folders Table -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Page Content -->




@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#folders-index').DataTable({
                paging: true,
                searching: true,
                ordering:  true,
                lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50,100, "All"]],

            });


        });



    </script>
@endsection
