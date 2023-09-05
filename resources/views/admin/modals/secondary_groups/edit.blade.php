<div id="edit_secondary_group" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Secondary Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatesecondarygroup','novalidate'=>'']) !!}

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Primary Group <span class="text-danger">*</span></label>
                                <input type="hidden" name="hidden_primary_group_id" id="hidden_primary_group_id" />
                                <select  class="custom-select updateselectprimary" name="primary_group_id" id="update_primary_id" disabled required>
                                    <option value disabled selected> Select Primary Group</option>
                                    @foreach($primaryvalue as $value)
                                        <option value="{{$value->id}}">{{ucwords($value->name)}} </option>
                                    @endforeach
                                    </select>
                                    <div class="invalid-feedback">
										Please select a primary group name.
									</div>
                                    @if($errors->has('primary_group_id'))
                                    <div class="invalid-feedback">
                                         {{$errors->first('primary_group_id')}}
									</div>

                                    @endif
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                 <label class="col-form-label">Status <span class="text-danger">*</span></label>
                                <br/>
                                <label>
                                    {!! Form::radio('status', 1) !!}
                                    Enable
                                </label>&nbsp;&nbsp;
                                <label>
                                    {!! Form::radio('status', 0) !!}
                                    Disable
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Secondary Group Name <span class="text-danger">*</span></label>
                                <input class="form-control updatename" id="name" name="name" type="text" required>
                                <div class="invalid-feedback">
                                    Please enter a secondary group name.
                                </div>
                                @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('name')}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Slug <span class="text-danger"></span></label>
                                <input class="form-control updateslug" type="text" id="slug" name="slug" value="" readonly="">
                                @if($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{$errors->first('slug')}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <section class="primary-attributes_edit">
                    </section>

                    <div class="submit-section">
                        <input class="btn btn-primary submit-btn" type="submit" value="Update">

                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
