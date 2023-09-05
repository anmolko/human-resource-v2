            <div id="add_module" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Module</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            {!! Form::open(['route' => 'module.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                                <div class="form-group">
                                    <label>Module Name <span class="text-danger">*</span></label>
									<input class="form-control" id="name" name="name" type="text" required>
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
                                    <input class="form-control" type="text" id="key" name="key" value="" readonly="">
									@if($errors->has('key'))
									<div class="invalid-feedback">
										{{$errors->first('key')}}
									</div>
									@endif
								</div>
                                <div class="form-group">
                                    <label>Url  <span class="text-danger">*</span></label>
									<input class="form-control" name="url" type="text" required>
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
                                    <select  class="custom-select" name="status" required>
                                        <option value="1">Active </option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <div class="submit-section">
                                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                                </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
