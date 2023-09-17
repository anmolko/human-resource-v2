@extends('layouts.user_management_master')
@section('title') Module @endsection
@section('css')
<style>
    .role-not-found{
        color: #d43644;
        font-size: 20px;
    }
    .list-of-role button.btn.btn-info.btn-sm{
        margin-right:5px;
        margin-bottom: 5px;

    }

    .custom-modal .modal-body.list-of-role {
        text-align: center;
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

        @if($errors->has('url'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{$errors->first('url')}}</span>
            </p>
        </div>
        @endif
        <!-- Page Content -->
        <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Module</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                                <li class="breadcrumb-item active">Module</li>
                            </ul>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_module"><i class="fa fa-plus"></i> Add Module</a>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="{{route('module.trash')}}" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                    <li class="nav-item"><a class="nav-link active" href="#all_tab" data-id="all" data-toggle="tab">All</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#parent_tab" data-id="parent" data-toggle="tab">Parent Module</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#child_tab" data-id="child" data-toggle="tab">Child Module</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive">
                        <form action="#" method="post" id="deleted-form" >
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="delete">

                        </form>
                            <!-- Module Table -->
                            <table id="moduleDataTable" class="table table-striped custom-table mb-0 ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name </th>
                                        <th>Type </th>
                                        <th>Parent Module</th>
                                        <th>Key </th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
{{--                                    @php($i=1)--}}
{{--                                    @foreach($modules as $module)--}}
{{--                                    <tr>--}}
{{--                                        <td> {{$i++}}          </td>--}}
{{--                                        <td> {{$module->name}} </td>--}}
{{--                                        <td> {{$module->key}} </td>--}}
{{--                                        <td> {{$module->url}}  </td>--}}

{{--                                        <td> @if ($module->status==1)--}}
{{--                                            <i class="fa fa-dot-circle-o text-success"></i> Active--}}
{{--                                            @else--}}
{{--                                            <i class="fa fa-dot-circle-o text-danger"></i> Inactive--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td class="text-right">--}}
{{--                                            <div class="dropdown dropdown-action">--}}
{{--                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>--}}
{{--                                                <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                    <a class="dropdown-item action-view" href="#"  id="{{$module->id}}" hrm-view-action="{{route('module.viewroles',$module->id)}}" data-toggle="modal" data-target="#view_role"><i class="fa fa-eye m-r-5"></i> View Assign Role</a>--}}
{{--                                                    <a class="dropdown-item action-edit" href="#" id="{{$module->id}}" hrm-update-action="{{route('module.update',$module->id)}}"  hrm-edit-action="{{route('module.edit',$module->id)}}" data-toggle="modal" data-target="#edit_module"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
{{--                                                    <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route('module.destroy',$module->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

{{--                                    @endforeach--}}


                                </tbody>
                            </table>
                            <!-- /Module Table -->

                        </div>
                    </div>
                </div>

        </div>
            <!-- /Page Content -->

            <!-- Add Module Modal -->
            @include('admin.modals.modules.add')
            <!-- /Add Module Modal -->


            <!-- View Role Modal -->
            @include('admin.modals.modules.view_role')
            <!-- /View Role Modal -->

            <!-- Edit Module Modal -->
            @include('admin.modals.modules.edit')
            <!-- /Edit Module Modal -->

            <!-- Trash Module Modal -->
            <!-- @include('admin.modals.modules.trash') -->
            <!-- /Trash Module Modal -->
@endsection

@section('js')
     @include('admin.module.includes.script')
     <script type="text/javascript">
         let all = true;
         let parent = null;
         let child = null;
         let dataTables = $('#moduleDataTable').DataTable({
             processing:true,
             serverSide: true,
             searching: true,
             stateSave: true,
             order:[[1,'asc']],
             aaSorting: [],
             ajax: {
                 "url": '{{ route('module.data') }}',
                 "type": 'POST',
                 'data': function (d) {
                     d._token   = '{{csrf_token()}}';
                     d.all      = all;
                     d.parent   = parent;
                     d.child    = child;
                 }
             },
             columns :[
                 {data:'DT_RowIndex', name: 'DT_RowIndex', searchable:false, orderable: false},
                 {data:'name', name: 'name', orderable: true,searchable:true},
                 {data:'type', name: 'type', orderable: false,searchable:true},
                 {data:'parent_module', name: 'parent_module', orderable: false,searchable:true},
                 {data:'key', name: 'key', searchable:true, orderable: false},
                 // {data:'url', name: 'url', searchable:true, orderable: false},
                 {data:'status', name: 'status', searchable:false, orderable: false},
                 {data:'action', name: 'action', searchable:false, orderable: false},
             ]
         })

         $(".nav-link").click(function() {
             // Remove 'active' class from all nav-links
             $(".nav-link").removeClass("active");
             let data_id = $(this).attr("data-id");

             loadDataTable(data_id);

             // Add 'active' class to the clicked nav-link
             $(this).addClass("active");
         });

         function loadDataTable(id){
             if(id =='all'){
                 all = true;
                 parent = null;
                 child = null;
             }else if(id =='parent'){
                 all = null;
                 parent = true;
                 child = null;
             }else if(id =='child'){
                 all = null;
                 parent = null;
                 child = true;
             }
             dataTables.draw();
         }
     </script>



@endsection
