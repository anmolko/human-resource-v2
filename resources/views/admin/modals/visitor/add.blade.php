<div id="add_visitor" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Visitor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'visitor.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}


                <div class="profile-img-wrap edit-img">
                    <img class="inline-block" id="current-img" src="{{asset('/images/profiles/others.png')}}" alt="user-profile" >
                    <div class="fileupload btn">
                        <span class="btn-text">edit</span>
                        <input class="upload" type="file" id="image" onchange="loadFile(event)" name="image">
                    </div>
                    <div class="invalid-feedback">
                        Please choose a visitor picture.
                    </div>
                </div>

                <?php $ref = 'VST-'.str_pad(time() + 1, 8, "0", STR_PAD_LEFT); ?>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Visitor ID <span class="text-danger">*</span></label>
                            <input class="form-control" value="{{$ref}}" name="visitor_id" type="text" required readonly="">
                            <div class="invalid-feedback">
                                Please enter Visitor ID.
                            </div>
                            @if($errors->has('visitor_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('visitor_id')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Visitor Name <span class="text-danger">*</span></label>
                            <input class="form-control" name="visitor_name" type="text" required>
                            <div class="invalid-feedback">
                                Please enter visitor name.
                            </div>
                            @if($errors->has('visitor_name'))
                                <div class="invalid-feedback">
                                    {{$errors->first('visitor_name')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Mobile No. <span class="text-danger">*</span></label>
                            <input class="form-control" name="mobile_no" type="number" required>
                            <div class="invalid-feedback">
                                Please enter Mobile No.
                            </div>
                            @if($errors->has('mobile_no'))
                                <div class="invalid-feedback">
                                    {{$errors->first('mobile_no')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="">Employee <span class="text-danger">*</span></label>
                            <select class="custom-select" name="employee_id" id="employee_id" required>
                                <option value disabled selected> Select Employee</option>
                                @foreach($employees as  $employee)
                                    <option value="{{$employee->id}}">{{ucwords($employee->user->name)}} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a Employee.
                            </div>
                            @if($errors->has('employee_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('employee_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

              
            
                

                <div class="form-group">
                    <label>Visit Reason <span class="text-danger">*</span></label>
                    <input class="form-control" name="reason" type="text" required>
                    <div class="invalid-feedback">
                        Please enter visit reason.
                    </div>
                    @if($errors->has('reason'))
                        <div class="invalid-feedback">
                            {{$errors->first('reason')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label>Misc </label>
                    <textarea class="form-control" name="misc" id="misc" rows="4" ></textarea>
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
                    <button class="btn btn-primary submit-btn" id="submit-module">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
