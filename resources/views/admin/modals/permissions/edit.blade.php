<div id="edit_permission" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit  Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatepermission','novalidate'=>'']) !!}

                 <div class="form-group">
                        <label>Module  <span class="text-danger">*</span></label>
                        <select  class="custom-select updateselectmodule" name="module_id" required>
                        <option value disabled > Select Module</option>
                        @foreach($modulevalue as $value)
                            <option value="{{$value->id}}">{{ucwords($value->name)}} </option>
                        @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a module name.
                        </div>
                        @if($errors->has('module_id'))
                        <div class="invalid-feedback">
                                {{$errors->first('module_id')}} 
                        </div>

                        @endif
                </div>



                    <div class="form-group">
                        <label>Permission Name <span class="text-danger">*</span></label>
                        <input class="form-control updatename" id="name"  name="name"  type="text"  required>
                        <div class="invalid-feedback">
                            Please enter a permission name.
                        </div>
                        @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Key <span class="text-danger"></span></label>
                        <input class="form-control updatekey" type="text"  id="key" name="key"value="" readonly="">
                        @if($errors->has('key'))
                        <div class="invalid-feedback">
                            {{$errors->first('key')}}
                        </div>
                        @endif
                    </div>
                    

                  
                    <div class="form-group">
                        {!! Form::label('status','Status:'); !!} &nbsp;&nbsp;
                        <label>
                            {!! Form::radio('status', 1) !!}  
                            Enable
                        </label>&nbsp;&nbsp;
                        <label>
                            {!! Form::radio('status', 0) !!}  
                            Disable
                        </label>
                    </div>
                    
                    <div class="submit-section">
                        <input class="btn btn-primary submit-btn" type="submit" value="Update" id="submit-module">
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>