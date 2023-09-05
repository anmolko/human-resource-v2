<div id="edit_department" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="access-denied"> </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatedepartment','novalidate'=>'']) !!}

                <div class="form-group">
                    <label>Department Name <span class="text-danger">*</span></label>
                    <input class="form-control updatename" id="name"  name="name"  type="text"  required>
                    <div class="invalid-feedback">
                        Please enter a department name.
                    </div>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Description <span class="text-danger">*</span></label>
                    <textarea class="form-control updatedescription" name="description" id="description" rows="4" ></textarea>
                    <div class="invalid-feedback">
                        Please enter a description.
                    </div>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{$errors->first('description')}}
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
