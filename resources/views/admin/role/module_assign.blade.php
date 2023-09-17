
    {!! Form::open(['route' => ['role.storemodules',$current_role->id],'method'=>'post']) !!}

    <div class="module-assign-section">
    <h6 class="card-title m-b-20">Module Access To "{{ucwords(@$current_role->name)}}"</h6>
    {!! Form::submit('Assign Module',['class'=>'btn btn-primary  btn-sm']) !!}

    </div>
    <div class="m-b-30">
        <ul class="list-group notification-list">

        @foreach($modules as $module)
            <li class="list-group-item">
                {{ucwords($module->name)}}
                <div class="status-toggle">
                    @if(in_array($module->id,$selected))

                    <input type="checkbox" name="module_id[]" value="{{$module->id}}" id="{{$module->key}}" class="check" checked>

                    @else
                    <input type="checkbox" name="module_id[]" value="{{$module->id}}" id="{{$module->key}}" class="check" >

                    @endif
                    <label for="{{$module->key}}" class="checktoggle">checkbox</label>
                </div>
            </li>
        @endforeach


        </ul>
    </div>
    {!! Form::close() !!}

    {!! Form::open(['route' => ['role.storepermissions',$current_role->id],'method'=>'post']) !!}
    <div class="table-responsive">
    <div class="module-assign-section">
        <h6 class="card-title m-b-20">Permission  To "{{ucwords(@$current_role->name)}}"</h6>
        {!! Form::submit('Assign Permission',['class'=>'btn btn-primary  btn-sm']) !!}

        </div>
        <table id="" class="table table-striped custom-table">

            <tbody>
            @foreach($module_permissions as $module)
                <tr>
                    <td>{{ucwords($module->name)}}</td>

                    @foreach($module->permissions as $permission)
                    <td class="text-center checkbox checkbox-warning">

                    @if(in_array($permission->id,$selected_permissions))
                            <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" id="{{$permission->key}}"  checked>

                            @else
                            <input type="checkbox" name="permission_id[]"  value="{{$permission->id}}" id="{{$permission->key}}" >
                            @endif
                            <label for="{{$permission->key}}">{{ucwords($permission->name)}}</label>

                    @endforeach
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    {!! Form::close() !!}
