<div id="edit_counsellor" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Counsellor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatecounsellor','novalidate'=>'']) !!}
                    
                    <div class="form-group">
                        <label >Caller Name <span class="text-danger">*</span></label>
                        <select class="custom-select" name="overseas_agent_id" id="edit_overseas_agent_id" required>
                            <option value disabled selected> Select Caller Name</option>
                            @foreach($agents as $agent)
                                <option value="{{$agent->id}}">{{ucwords($agent->fullname)}} </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a caller name.
                        </div>
                        @if($errors->has('overseas_agent_id'))
                            <div class="invalid-feedback">
                                {{$errors->first('overseas_agent_id')}}
                            </div>
                        @endif
                    </div>
              

                    <div class="form-group">
                        <label>Inquiry Description <span class="text-danger">*</span></label>
                        <textarea class="form-control updatedescription" name="description" id="description" rows="2" ></textarea>
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
                        <label>Response <span class="text-danger">*</span></label>
                        <textarea class="form-control updateresponse" name="response" id="response" rows="2" ></textarea>
                        <div class="invalid-feedback">
                            Please enter a response.
                        </div>
                        @if($errors->has('response'))
                            <div class="invalid-feedback">
                                {{$errors->first('response')}}
                            </div>
                        @endif
                    </div>
                      
                    <div class="form-group">
                        <label>Response via  <span class="text-danger">*</span></label>
                        <select class="custom-select select-height" name="response_via"  required>
                            <option value disabled selected> Select Response Via</option>
                            <option value="call"> Call </option>
                            <option value="sms"> SMS </option>
                            <option value="email"> Email </option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a response via.
                        </div>
                        @if($errors->has('response_via'))
                            <div class="invalid-feedback">
                                {{$errors->first('response_via')}}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Misc </label>
                        <textarea class="form-control updatemisc" name="misc" id="misc" rows="2" ></textarea>
                        <div class="invalid-feedback">
                            Please enter a misc.
                        </div>
                        @if($errors->has('misc'))
                            <div class="invalid-feedback">
                                {{$errors->first('misc')}}
                            </div>
                        @endif
                    </div>
                    
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" id="submit-module">Update</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>