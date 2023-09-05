<div id="add_file" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'file.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                <input class="form-control" name="folder_id" value="{{@$folder->id}}" type="hidden" required>

                    <div class="form-group">
                        <label>Type  <span class="text-danger">*</span></label>
                        <select class="custom-select " name="type"  required>
                            <option value disabled selected> Select Type</option>
                            <option value="bank"> Bank </option>
                            <option value="license"> License </option>
                            <option value="document"> Document </option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a type.
                        </div>
                      
                    </div>

                    <div class="form-group">
                        <label>Choose File <span class="text-danger">*</span></label>
                        <input class="form-control" name="filename" type="file" required>
                        <div class="invalid-feedback">
                            Please choose file.
                        </div>
                     
                    </div>



                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" >Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
