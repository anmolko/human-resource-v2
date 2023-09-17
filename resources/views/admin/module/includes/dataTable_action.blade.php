<div class="dropdown dropdown-action">
    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item action-view" href="#"  id="{{$params['id']}}" hrm-view-action="{{route($params['base_route'].'viewroles',$params['id'])}}" data-toggle="modal" data-target="#view_role"><i class="fa fa-eye m-r-5"></i> View Assign Role</a>
        <a class="dropdown-item action-edit" href="#" id="{{$params['id']}}" hrm-update-action="{{route($params['base_route'].'update',$params['id'])}}"  hrm-edit-action="{{route($params['base_route'].'edit',$params['id'])}}" data-toggle="modal" data-target="#edit_module"><i class="fa fa-pencil m-r-5"></i> Edit</a>
        <a class="dropdown-item action-delete" href="#"  hrm-delete-action="{{route($params['base_route'].'destroy',$params['id'])}}" ><i class="fa fa-trash-o m-r-5"></i> Trash</a>
    </div>
</div>
