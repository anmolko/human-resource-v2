            <div id="add_attribute" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Attribute</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            {!! Form::open(['route' => 'attribute.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}


                                <div class="form-group">
                                    <label>Attribute Name <span class="text-danger">*</span></label>
									<input class="form-control" id="name" name="name" type="text" required>
									<div class="invalid-feedback">
										Please enter a attribute name.
									</div>
									@if($errors->has('name'))
									<div class="invalid-feedback">
										{{$errors->first('name')}}
									</div>
									@endif
                                </div>
                                <div class="form-group">
                                    <label>Slug <span class="text-danger"></span></label>
                                    <input class="form-control" type="text" id="slug" name="slug" value="" readonly="">
									@if($errors->has('slug'))
									<div class="invalid-feedback">
										{{$errors->first('slug')}}
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
											{!! Form::radio('status', 0, true) !!}  
											Disable
										</label>
									</div>

                                    <div class="form-group">
										{!! Form::label('field_type','Field Type:'); !!} &nbsp;&nbsp;
										<label>
											{!! Form::radio('field_type', 'text',true) !!}  
											Text
										</label>&nbsp;&nbsp;
										<label>
											{!! Form::radio('field_type', 'email') !!}  
											Email
                                            </label>&nbsp;&nbsp;
										<label>
											{!! Form::radio('field_type', 'number') !!}  
											Number
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