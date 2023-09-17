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

                 {!! Form::open(['method'=>'PUT','class'=>'needs-validation submit_form updatemodule','novalidate'=>'','data-id'=>'update']) !!}

                    <div class="form-group">
                        <label>Parent Module </label>
                        {!! Form::select('parent_module_id', $modules->pluck('name','id'), null,['class'=>'custom-select mb-3 select2 parent_module_id','id'=>'parent_module_id','placeholder'=>'Select parent module']) !!}
                        <div class="invalid-feedback">
                            Please enter parent module.
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="required">Module Name </label>
                        <input class="form-control updatename" id="name"  name="name"  type="text">
                        <div class="invalid-feedback">
                            Please enter a module name.
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required">Key </label>
                        <input class="form-control updatekey" type="text"  id="key" name="key" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required">Url </label>
                        <input class="form-control updateurl" name="url" id="url"  type="text" >
                        <div class="invalid-feedback">
                            Please enter a url.
                        </div>
                    </div>
                <div class="form-group">
                    <label>Icon </label>
                    <input class="form-control" type="text" name="icon" id="icon">
                    <small class="text-warning">Applicable only for parent module, not child module</small>
                </div>
                <div class="form-group">
                    <label>Rank </label>
                    <input class="form-control" type="number" name="rank" id="rank" min="0">
                    <small class="text-warning">Applicable only for child module, not parent module</small>
                </div>


                <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="custom-select updatestatus" name="status" id="status">
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
