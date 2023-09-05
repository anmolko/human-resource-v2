<div id="add_designation" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'designation.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

               
                <div class="form-group">
                    <label >Department Name <span class="text-danger">*</span></label>
                    <select class="custom-select" name="department_id" id="department_id" required>
                        <option value disabled selected> Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{ucwords($department->name)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a department.
                    </div>
                    @if($errors->has('department_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('department_id')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Designation Name <span class="text-danger">*</span></label>
                    <input class="form-control" id="name" name="name" type="text" required>
                    <div class="invalid-feedback">
                        Please enter a designation name.
                    </div>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Description </label>
                    <textarea class="form-control" name="description" id="description" rows="4" ></textarea>
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
                    <label>Status  </label>
                    <select class="custom-select select-height" name="status"  >
                        <option value="active" selected> Active </option>
                        <option value="deactive"> Deactive </option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a Status.
                    </div>
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{$errors->first('status')}}
                        </div>
                    @endif
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
