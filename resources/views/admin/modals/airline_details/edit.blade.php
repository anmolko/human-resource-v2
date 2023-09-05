<div id="edit_airline_details" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Airline Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updateairlinedetails','novalidate'=>'']) !!}

                <div class="form-group">
                    <label>Reference No <span class="text-danger">*</span></label>
                    <input class="form-control" name="reference_no" id="reference_no" type="text" required>
                    <div class="invalid-feedback">
                        Please enter Registration Number.
                    </div>
                    @if($errors->has('reference_no'))
                        <div class="invalid-feedback">
                            {{$errors->first('reference_no')}}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Country </label>
                            <select class="custom-select select-height updatecountry" name="country" id="country">
                                <option value disabled selected> Select Country</option>
                                @foreach($countries as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a Country.
                            </div>
                            @if($errors->has('country'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>State </label>
                            <select class="custom-select select-height updatecountry_state_id" name="country_state_id" id="country_state_id">
                                <option value disabled selected> Select State</option>

                            </select>
                            <div class="invalid-feedback">
                                Please select a State.
                            </div>
                            @if($errors->has('country_state_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country_state_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

{{--                <div>--}}
{{--                    <h4 class="modal-sub-title"><i class="lar la-id-badge"></i>Contact Personal Details</h4>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label >Country I </label>--}}
{{--                            <select class="custom-select select-height updatecountry_one" name="country_one" id="country_one">--}}
{{--                                <option value disabled selected> Select Country</option>--}}
{{--                                @foreach($countries as $key => $value)--}}
{{--                                    <option value="{{$key}}">{{ucwords($value)}} </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please select a Country one.--}}
{{--                            </div>--}}
{{--                            @if($errors->has('country_one'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('country_one')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Transaction (in days) </label>--}}
{{--                            <input class="form-control" name="transaction" id="transaction" type="number" required>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please enter transaction detail.--}}
{{--                            </div>--}}
{{--                            @if($errors->has('transaction'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('transaction')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label >Country II </label>--}}
{{--                            <select class="custom-select select-height updatecountry_two" name="country_two" id="country_two">--}}
{{--                                <option value disabled selected> Select Country</option>--}}
{{--                                @foreach($countries as $key => $value)--}}
{{--                                    <option value="{{$key}}">{{ucwords($value)}} </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please select a Country two.--}}
{{--                            </div>--}}
{{--                            @if($errors->has('country_two'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('country_two')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Total Cost </label>--}}
{{--                            <input class="form-control" name="total_cost" id="total_cost" type="number" required>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please enter total cost.--}}
{{--                            </div>--}}
{{--                            @if($errors->has('total_cost'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('total_cost')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label >Country III </label>--}}
{{--                            <select class="custom-select select-height updatecountry_three" name="country_three" id="country_three">--}}
{{--                                <option value disabled selected> Select Country</option>--}}
{{--                                @foreach($countries as $key => $value)--}}
{{--                                    <option value="{{$key}}">{{ucwords($value)}} </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please select a Country Three.--}}
{{--                            </div>--}}
{{--                            @if($errors->has('country_two'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('country_three')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Remarks </label>--}}
{{--                            <textarea class="form-control" name="remarks" id="remarks" rows="4"></textarea>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Please enter remarks.--}}
{{--                            </div>--}}
{{--                            @if($errors->has('remarks'))--}}
{{--                                <div class="invalid-feedback">--}}
{{--                                    {{$errors->first('remarks')}}--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-airline-details">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
