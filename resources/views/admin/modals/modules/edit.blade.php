<div id="edit_module" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit  Module</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatemodule','novalidate'=>'']) !!}

                    <div class="form-group">
                        <label>Module Name <span class="text-danger">*</span></label>
                        <input class="form-control updatename" id="name"  name="name"  type="text" required>
                        <div class="invalid-feedback">
                            Please enter a module name.
                        </div>
                        @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{$errors->first('name')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Key <span class="text-danger"></span></label>
                        <input class="form-control updatekey" type="text"  id="key" name="key"value="" >
                        @if($errors->has('key'))
                        <div class="invalid-feedback">
                            {{$errors->first('key')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Url  <span class="text-danger">*</span></label>
                        <input class="form-control updateurl" name="url" id="url"  type="text"  required>
                        <div class="invalid-feedback">
                            Please enter a url.
                        </div>
                        @if($errors->has('url'))
                        <div class="invalid-feedback">
                            {{$errors->first('url')}}
                        </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select  class="custom-select updatestatus" name="status" required>
                            <option value="1">Active </option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    
                    <div class="submit-section">
                        <input class="btn btn-primary submit-btn" type="submit" value="Update" id="submit-module">
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>