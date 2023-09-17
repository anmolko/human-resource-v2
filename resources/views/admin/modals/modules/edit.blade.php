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

                <div id="edit-module">

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
