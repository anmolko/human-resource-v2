<div class="modal custom-modal fade" id="delete_module" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Trash Module</h3>
                                <p>Are you sure move to trash?</p>
                            </div>
                            <div class="modal-btn delete-action">
                            
                                        
                                <form  method="post" class="deletemodule" id="formdelete">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary continue-btn continue-trash"> Trash </button>

                                            </div>
                                            <div class="col-6">
                                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                            </div>
                                        </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>