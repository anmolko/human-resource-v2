<div class="flex-shrink-0 ms-4">
    <ul class="list-inline tasks-list-menu mb-0">
        <li class="list-inline-item">
            <a class="action-edit" href="#" hrm-edit-action="{{route('candidate-personal-info.edit',$params['id'])}}" hrm-update-action="{{route('candidate-personal-info.update',$params['id'])}}" data-toggle="modal">
                <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
        <li class="list-inline-item">
            <a class="edit-item-btn" href="{{route('candidate-personal-info.addalldetails',$params['id'])}}" id="{{$params['id']}}">
                <i class="fa fa-plus align-bottom me-2 text-muted"></i> </a></li>
        <li class="list-inline-item">
            <a class="remove-item-btn action-delete" hrm-delete-action="{{route('candidate-personal-info.destroy',$params['id'])}}">
                <i class="fa fa-trash-o align-bottom me-2 text-muted"></i>
            </a>
        </li>
    </ul>
</div>
