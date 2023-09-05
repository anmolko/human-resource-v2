<div id="add_candidate_cv" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add CV Info for Candidate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {!! Form::open(['route' => 'candidate-cv-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}


                <div class="form-group">
                    <label >Candidate Name <span class="text-danger">*</span></label>
                    <select class="custom-select" name="candidate_personal_information_id" id="candidate_personal_information" required>
                        <option value disabled selected> Select Candidate</option>
                        @foreach($candidate_personals as $key => $value)
                            <option value="{{$value->id}}">{{ucwords($value->candidate_firstname)}} {{ucwords($value->candidate_middlename)}} {{ucwords($value->candidate_lastname)}} </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a candidate.
                    </div>
                    @if($errors->has('candidate_personal_information_id'))
                        <div class="invalid-feedback">
                            {{$errors->first('candidate_personal_information_id')}}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>About Me <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="profile" id="profile" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a profile.
                            </div>
                            @if($errors->has('profile'))
                                <div class="invalid-feedback">
                                    {{$errors->first('profile')}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Declaration <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="declaration" id="declaration" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a declaration.
                            </div>
                            @if($errors->has('declaration'))
                                <div class="invalid-feedback">
                                    {{$errors->first('declaration')}}
                                </div>
                            @endif
                        </div>
                    </div>
                   
                </div>

                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Skill  <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="skill" id="storeskill" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a skill.
                            </div>
                            @if($errors->has('skill'))
                                <div class="invalid-feedback">
                                    {{$errors->first('skill')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label>Duty  <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="duty" id="storeduty" rows="4" required></textarea>
                            <div class="invalid-feedback">
                                Please enter a duty.
                            </div>
                            @if($errors->has('duty'))
                                <div class="invalid-feedback">
                                    {{$errors->first('duty')}}
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
