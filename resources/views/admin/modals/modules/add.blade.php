            <div id="add_module_show" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Module</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            {!! Form::open(['route' => 'module.store', 'method'=>'POST', 'class'=>'submit_form','enctype'=>'multipart/form-data','data-id'=>'create']) !!}

                            <div id="add-section">

                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
