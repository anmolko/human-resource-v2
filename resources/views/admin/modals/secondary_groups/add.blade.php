<div id="add_secondary_group" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Secondary Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'secondary-groups.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Primary Group <span class="text-danger">*</span></label>
                                <select class="custom-select" name="primary_group_id" id="primary_group_add" required>
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
                                    {!! Form::radio('status', 0, true) !!}
                                    Disable
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Secondary Group Name <span class="text-danger">*</span></label>
                                <input class="form-control" id="name" name="name" type="text" required>
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
                                <input class="form-control" type="text" id="slug" name="slug" value="" readonly="">
                                @if($errors->has('slug'))
                                <div class="invalid-feedback">
                                    {{$errors->first('slug')}}
                                </div>
                                @endif
                            </div>
                        </div>


                    </div>

                   <section class="primary-attributes">



                   </section>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
