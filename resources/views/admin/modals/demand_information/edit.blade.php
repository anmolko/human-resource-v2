<div id="edit_demand_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Demand Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'PUT','class'=>'needs-validation updatedemand','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                <div class="profile-img-wrap edit-img">
                    <img class="inline-block" id="current-demand-img" src="{{asset('/images/profiles/others.png')}}" alt="demand-image" >
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" id="demand-image" onchange="loadupdateFile(event)" name="image">
                    </div>
                    <div class="invalid-feedback">
                        Please choose a Demand Information Image.
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Demand Ref No. <span class="text-danger">*</span></label>
                            <input class="form-control" name="ref_no" id="ref_no" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Demand Ref number.
                            </div>
                            @if($errors->has('ref_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('ref_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Serial No. <span class="text-danger">*</span></label>
                            <input class="form-control" name="serial_no" id="serial_no" type="text" required>
                            <div class="invalid-feedback">
                                Please enter Serial Number.
                            </div>
                            @if($errors->has('serial_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('serial_no')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Company </label>
                            {!! Form::select('company_id', $companies, null,['class'=>'custom-select mb-3 select2','id'=>'company_id','placeholder'=>'Select company','data-id'=>'edit']) !!}
                            <div class="invalid-feedback">
                                Please enter Company Name.
                            </div>
                            @if($errors->has('company_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('company_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>State <span class="text-danger">*</span></label>
                            {!! Form::select('country_state_id', [], null,['class'=>'custom-select mb-3 select2','id'=>'country_state_id','placeholder'=>'Select state']) !!}
                            <div class="invalid-feedback">
                                Please enter state.
                            </div>
                            @if($errors->has('country_state_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('country_state_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Category  </label>
                            <select class="custom-select select-height select2" name="category" id="category" >
                                <option value disabled selected> Select Category </option>
                                <option value="basic"> Basic </option>
                                <option value="normal"> Normal </option>
                                <option value="urgent"> Urgent </option>
                                <option value="topurgent"> Top-Urgent </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a category.
                            </div>
                            @if($errors->has('category'))
                                <div class="invalid-feedback">
                                    {{$errors->first('category')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Fulfill date </label>
                            <input class="form-control" name="fulfill_date" id="fulfill_date" type="text" >
                            <div class="invalid-feedback">
                                Please enter Fulfill date.
                            </div>
                            @if($errors->has('fulfill_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('fulfill_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Issued Date </label>
                            <input class="form-control" name="issued_date" id="issued_date" type="text" >
                            <div class="invalid-feedback">
                                Please select a Issued Date.
                            </div>
                            @if($errors->has('issued_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('issued_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Expired On </label>
                            <input class="form-control" name="expired_date" id="expired_date" type="text" >
                            <div class="invalid-feedback">
                                Please enter Expired date.
                            </div>
                            @if($errors->has('expired_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('expired_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Advertised </label>
                            <select class="custom-select select-height" name="advertised" id="advertised" >
                                <option value disabled selected> Select Advertised </option>
                                <option value="news-paper"> News Paper </option>
                                <option value="local"> Local </option>
                                <option value="thought-agents"> Through Agents </option>
                                <option value="others"> Others </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select Advertised
                            </div>
                            @if($errors->has('advertised'))
                                <div class="invalid-feedback">
                                    {{$errors->first('advertised')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status  </label>
                            <select class="custom-select select-height" name="status" id="status">
                                <option value disabled selected> Select Status </option>
                                <option value="new"> New </option>
                                <option value="on-going"> On Going </option>
                                <option value="up-coming"> Up Coming </option>
                                <option value="completed"> Completed </option>
                                <option value="expired"> Expired </option>
                            </select>
                            <div class="invalid-feedback">
                                Please select the status.
                            </div>
                            @if($errors->has('status'))
                                <div class="invalid-feedback">
                                    {{$errors->first('status')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Doc Status </label>
                            <input class="form-control" name="doc_status" id="doc_status" type="text">
                            <div class="invalid-feedback">
                                Please enter document status.
                            </div>
                            @if($errors->has('doc_status'))
                                <div class="invalid-feedback">
                                    {{$errors->first('doc_status')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Num of PAX </label>
                            <input class="form-control" name="num_of_pax" id="num_of_pax" type="number">
                            <div class="invalid-feedback">
                                Please enter Number of PAX
                            </div>
                            @if($errors->has('num_of_pax'))
                                <div class="invalid-feedback">
                                    {{$errors->first('num_of_pax')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Doc Received Date </label>
                            <input class="form-control" name="doc_received_date" id="doc_received_date" type="text">
                            <div class="invalid-feedback">
                                Please enter the document received date.
                            </div>
                            @if($errors->has('doc_received_date'))
                                <div class="invalid-feedback">
                                    {{$errors->first('doc_received_date')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Document Status Remarks </label>
                    <textarea class="form-control" name="doc_status_remarks" id="doc_status_remarks" rows="4" ></textarea>
                    <div class="invalid-feedback">
                        Please enter document status remarks
                    </div>
                    @if($errors->has('doc_status_remarks'))
                        <div class="invalid-feedback">
                            {{$errors->first('doc_status_remarks')}}
                        </div>
                    @endif
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="update-demand">Update</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
