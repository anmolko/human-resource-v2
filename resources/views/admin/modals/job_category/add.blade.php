<div id="add_category" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Job Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'job-category.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}


                <div class="form-group">
                    <label>Category Name <span class="text-danger">*</span></label>
                    <input class="form-control" id="name" name="name" type="text" required>
                    <div class="invalid-feedback">
                        Please enter a Job Category name.
                    </div>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Description </label>
                    <textarea class="form-control" name="description" id="description" rows="4"></textarea>
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
                        {!! Form::radio('status', 1, true) !!}
                        Enable
                    </label>&nbsp;&nbsp;
                    <label>
                        {!! Form::radio('status', 0) !!}
                        Disable
                    </label>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
