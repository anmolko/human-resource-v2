<div id="underprocess_to_multiple" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Multiple Visa Option </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation multiplevisa','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0"><i class="fa fa-calendar-check-o"></i>
                                     Visa Issued</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Issued Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control visa_issued_date" name="visa_issued_date" id="multiple_visa_issued_date" required>
                                    <div class="invalid-feedback">
                                        Please select the visa issued date.
                                    </div>
                                    @if($errors->has('visa_issued_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('visa_issued_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Visa Expiry Date: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control visa_issued_date" name="visa_expiry_date" id="multiple_visa_expiry_date" required>
                                    <div class="invalid-feedback">
                                        Please select the visa expiry date.
                                    </div>
                                    @if($errors->has('visa_expiry_date'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('visa_expiry_date')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Job Category: <span class="text-danger">*</span></label>
                                    <select class="custom-select select-height" name="job_category_id" id="job_category" required>
                                        <option value disabled selected> Select Job Category </option>
                                        @foreach($job_category as $cat)
                                            <option value="{{$cat->id}}">{{ucwords($cat->name)}} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select the job category.
                                    </div>
                                    @if($errors->has('job_category_id'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('job_category_id')}}
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Sub Status Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Sub Status: </label>
                                    <select class="custom-select country select-height" name="sub_status_id" id="multiple_sub_status">
                                        <option value disabled selected> Select Sub Status</option>
                                        @foreach($sub_status as $sub)
                                            <option value="{{$sub->id}}">{{ucwords($sub->name)}} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select the sub status.
                                    </div>
                                    @if($errors->has('sub_status_id'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('sub_status_id')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Remarks: </label>
                                    <textarea type="text" class="form-control" rows="2" name="remarks" id="multiple_remarks"></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the remarks
                                    </div>
                                    @if($errors->has('remarks'))
                                        <div class="invalid-feedback">
                                            {{$errors->first('remarks')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-selected-candidate-form">Submit</button>
                </div>
                 {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
