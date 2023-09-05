<div id="add_country_state" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Country's  State</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'country-setting.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

              
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">Country <span class="text-danger">*</span></label>
                            <select class="custom-select" name="country" id="country" required>
                                <option value disabled selected> Select Country</option>
                                @foreach($countries as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a country.
                            </div>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    </div>

                 <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">State <span class="text-danger">*</span></label>
                            <input class="form-control"  name="state" type="text" required>
                            <div class="invalid-feedback">
                                Please enter a state.
                            </div>
                            @if($errors->has('state'))
                                <div class="invalid-feedback">
                                    {{$errors->first('state')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Currency <span class="text-danger">*</span></label>
                            <input class="form-control"  name="currency" type="text" required>
                            <div class="invalid-feedback">
                                Please enter currency.
                            </div>
                            @if($errors->has('currency'))
                                <div class="invalid-feedback">
                                    {{$errors->first('currency')}}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>


               

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
