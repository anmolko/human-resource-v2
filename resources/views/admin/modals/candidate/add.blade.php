<div id="add_candidate_personal_info" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Candidate Personal Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'candidate-personal-info.store','method'=>'post','enctype'=>'multipart/form-data','class'=>'needs-validation','novalidate'=>'']) !!}

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Candidate Important Information</h4>
                            </div>

                            <div class="card-body">
                                <div class="profile-img-wrap edit-img">
                                    <img class="inline-block" id="current-img" src="{{asset('/images/profiles/others.png')}}" alt="user-profile" >
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file" id="image" onchange="loadFile(event)" name="image">
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a Profile picture.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Registration No: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="registration_no" value="{{@$ref_num}}" readonly required>
                                            <div class="invalid-feedback">
                                                Please enter the registration number.
                                            </div>
                                            @if($errors->has('registration_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('registration_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Registration Date (AD): <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="english-dob-datepicker" name="registration_date_ad" required>
                                            <div class="invalid-feedback">
                                                Please select registration date(AD).
                                            </div>
                                            @if($errors->has('registration_date_ad'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('registration_date_ad')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Serial No:</label>
                                            <input type="text" class="form-control" name="serial_no">
                                            <div class="invalid-feedback">
                                                Please enter the Serial number.
                                            </div>
                                            @if($errors->has('serial_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('serial_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Registration Date (BS): <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control nepali-datepicker" id="nepali-dob-datepicker" name="registration_date_bs" required>
                                            <div class="invalid-feedback">
                                                Please select registration date(BS).
                                            </div>
                {{--                            @if($errors->has('registration_date_bs'))--}}
                {{--                                <div class="invalid-feedback">--}}
                {{--                                    {{$errors->first('registration_date_bs')}}--}}
                {{--                                </div>--}}
                {{--                            @endif--}}
                                        </div>
                                    </div> -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport No: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="passport_no" required>
                                            <div class="invalid-feedback">
                                                Please enter the passport number.
                                            </div>
                                            @if($errors->has('passport_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('passport_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Place: </label>
                                            <input type="text" class="form-control" name="birth_place">
                                            <div class="invalid-feedback">
                                                Please enter the birth place.
                                            </div>
                                            @if($errors->has('birth_place'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('birth_place')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issued Date: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="issued_date" id="issuedatetimepicker" required>
                                            <div class="invalid-feedback">
                                                Please select the issued date.
                                            </div>
                                            @if($errors->has('issued_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('issued_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expiry Date: </label>
                                            <input type="text" class="form-control" name="expiry_date" id="expiredatetimepicker">
                                            <div class="invalid-feedback">
                                                Please select the expiry date
                                            </div>
                                            @if($errors->has('expiry_date'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('expiry_date')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Reference Name: </label>
                                            <select class="custom-select select-height select2" name="reference_information_id" >
                                                <option value disabled selected> Select Reference Name</option>
                                                @foreach($reference as $ref)
                                                    <option value="{{$ref->id}}"> {{$ref->name}} </option>
                                                @endforeach

                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the reference name.
                                            </div>
                                            @if($errors->has('reference_information_id'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('reference_information_id')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Passport Status: </label>
                                            {!! Form::select('passport_status', [0=>'Out',1=>'In'], 0,['class'=>'custom-select mb-3 select2']) !!}
                                            <div class="invalid-feedback">
                                                Please enter the passport status.
                                            </div>
                                            @if($errors->has('passport_status'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('passport_status')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Receipt No:</label>--}}
{{--                                            <input type="text" class="form-control" name="receipt_no">--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please enter the receipt number.--}}
{{--                                            </div>--}}
{{--                                            @if($errors->has('receipt_no'))--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{$errors->first('receipt_no')}}--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Document Processing Fee: </label>--}}
{{--                                            <input type="number" class="form-control" name="document_processing_fee" />--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please enter the document processing fee.--}}
{{--                                            </div>--}}
{{--                                            @if($errors->has('document_processing_fee'))--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{$errors->first('document_processing_fee')}}--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Advance Fee: </label>--}}
{{--                                            <input type="number" class="form-control" name="advance_fee" />--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please enter Advance Fee--}}
{{--                                            </div>--}}
{{--                                            @if($errors->has('advance_fee'))--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{$errors->first('advance_fee')}}--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Passport Status: </label>--}}
{{--                                            {!! Form::select('passport_status', [0=>'Out',1=>'In'], 0,['class'=>'custom-select mb-3 select2']) !!}--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please enter the passport status.--}}
{{--                                            </div>--}}
{{--                                            @if($errors->has('passport_status'))--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                    {{$errors->first('passport_status')}}--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Candidate Personal Information</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Candidate First Name: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="candidate_firstname" required>
                                            <div class="invalid-feedback">
                                                Please enter the candidate first name.
                                            </div>
                                            @if($errors->has('candidate_firstname'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('candidate_firstname')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Candidate Middle Name: </label>
                                            <input type="text" class="form-control" name="candidate_middlename" >
                                            <div class="invalid-feedback">
                                                Please enter the candidate middle name.
                                            </div>
                                            @if($errors->has('candidate_middlename'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('candidate_middlename')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Candidate Last Name: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="candidate_lastname" required>
                                            <div class="invalid-feedback">
                                                Please enter the candidate last name.
                                            </div>
                                            @if($errors->has('candidate_lastname'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('candidate_lastname')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Age: </label>
                                            <input type="number" class="form-control" name="age" id="addage" readonly>
                                            <div class="invalid-feedback">
                                                Please enter the age.
                                            </div>
                                            @if($errors->has('age'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('age')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth: <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="date_of_birth" id="dobdatetimepicker" required>
                                            <div class="invalid-feedback">
                                                Please enter the date of birth.
                                            </div>
                                            @if($errors->has('date_of_birth'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('date_of_birth')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Martial Status: </label>
                                            <select class="custom-select select2" name="martial_status" data-id="index">
                                                <option value disabled selected> Select Martial Status</option>
                                                <option value="married"> Married </option>
                                                <option value="single"> Single </option>
                                                <option value="widow"> Widow </option>
                                                <option value="widower"> Widower </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the martial status
                                            </div>
                                            @if($errors->has('martial_status'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('martial_status')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row martial_status_details">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Spouse Name:</label>
                                            <input type="text" class="form-control" name="spouse">
                                            <div class="invalid-feedback">
                                                Please enter the spouse name
                                            </div>
                                            @if($errors->has('spouse'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('spouse')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Children: </label>
                                            <input type="number" class="form-control" name="children">
                                            <div class="invalid-feedback">
                                                Please enter number of children
                                            </div>
                                            @if($errors->has('children'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('children')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="email" class="form-control" name="email_address">
                                            <div class="invalid-feedback">
                                                Please enter the email address
                                            </div>
                                            @if($errors->has('email_address'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('email_address')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender: </label>
                                            <select class="custom-select select2" name="gender">
                                                <option value disabled> Select Gender</option>
                                                <option value="male" selected> Male </option>
                                                <option value="female"> Female </option>
                                                <option value="others" selected> Others </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the gender.
                                            </div>
                                            @if($errors->has('gender'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('gender')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Height: </label>
                                            <div class="input-group">
                                                <input type="text" min="1" class="form-control" name="height" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Fts</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the height.
                                            </div>
                                            @if($errors->has('height'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('height')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Weight: </label>
                                            <div class="input-group">
                                                <input type="text" min="1" class="form-control" name="weight" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Kgs</span>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the weight.
                                            </div>
                                            @if($errors->has('weight'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('weight')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nationality:</label>
                                            {!! Form::select('nationality', ['nepali'=>'Nepali','indian'=>'Indian','pakistani'=>'Indian','pakistani'=>'Pakistani','malaysian'=>'Malaysian','japanese'=>'Japanese','american'=>'American','canadian'=>'Canadian'], 'nepali',['class'=>'custom-select mb-3 select2']) !!}
                                            <div class="invalid-feedback">
                                                Please enter the nationality.
                                            </div>
                                            @if($errors->has('nationality'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('nationality')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Religion: </label>
                                            <select class="custom-select select2" name="religion">
                                                <option value disabled > Select Religion</option>
                                                <option value="hindu" selected> Hindu </option>
                                                <option value="muslim"> Muslim </option>
                                                <option value="christian"> Christian</option>
                                                <option value="buddhist"> Buddhist </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the religion.
                                            </div>
                                            @if($errors->has('religion'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('religion')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province: </label>
                                            {!! Form::select('province', $provinces, null,['class'=>'custom-select mb-3 select2','placeholder'=>'Select Province','data-id'=>'create']) !!}
                                            <div class="invalid-feedback">
                                                Please select province.
                                            </div>
                                            @if($errors->has('province'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('province')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>District: </label>
                                            {!! Form::select('district', [], null,['class'=>'custom-select mb-3 select2 district','placeholder'=>'Select District']) !!}
                                            <div class="invalid-feedback">
                                                Please select district.
                                            </div>
                                            @if($errors->has('district'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('district')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Permanent Address: </label>
                                            <input type="text" class="form-control" name="permanent_address">
                                            <div class="invalid-feedback">
                                                Please enter permanent address.
                                            </div>
                                            @if($errors->has('permanent_address'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('permanent_address')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Temporary Address: </label>
                                            <input type="text" class="form-control" name="temporary_address">
                                            <div class="invalid-feedback">
                                                Please enter temporary address.
                                            </div>
                                            @if($errors->has('temporary_address'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('temporary_address')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Next of Kin Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kin Relationship: </label>
                                            <select class="select" name="kin_relationship" >
                                                <option value disabled selected> Select Relationship</option>
                                                <option value="father"> Father </option>
                                                <option value="mother"> Mother </option>
                                                <option value="husband"> Husband </option>
                                                <option value="wife"> Wife </option>
                                                <option value="brother"> Brother </option>
                                                <option value="sister"> Sister </option>
                                                <option value="son"> Son </option>
                                                <option value="daughter"> Daughter </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the kin relationship
                                            </div>
                                            @if($errors->has('kin_relationship'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('kin_relationship')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kin Contact No: </label>
                                            <input type="number" class="form-control" name="kin_contact_no">
                                            <div class="invalid-feedback">
                                                Please enter the kin contact number
                                            </div>
                                            @if($errors->has('kin_contact_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('kin_contact_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Next of Kin Name: </label>
                                            <input type="text" class="form-control" name="next_of_kin" >
                                            <div class="invalid-feedback">
                                                Please enter the next of kin name.
                                            </div>
                                            @if($errors->has('next_of_kin'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('next_of_kin')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile No: </label>
                                            <input type="number" class="form-control" name="mobile_no">
                                            <div class="invalid-feedback">
                                                Please enter the mobile number
                                            </div>
                                            @if($errors->has('mobile_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('mobile_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact No:</label>
                                            <input type="number" class="form-control" name="contact_no">
                                            <div class="invalid-feedback">
                                                Please enter the contact number
                                            </div>
                                            @if($errors->has('contact_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('contact_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Extra Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father Name: </label>
                                            <input type="text" class="form-control" name="father_name" >
                                            <div class="invalid-feedback">
                                                Please enter the father's name.
                                            </div>
                                            @if($errors->has('father_name'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('father_name')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Father Contact No: </label>
                                            <input type="number" class="form-control" name="father_contact_no" >
                                            <div class="invalid-feedback">
                                                Please enter the father's contact number.
                                            </div>
                                            @if($errors->has('father_contact_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('father_contact_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mother Name: </label>
                                            <input type="text" class="form-control" name="mother_name" >
                                            <div class="invalid-feedback">
                                                Please enter the mother's name.
                                            </div>
                                            @if($errors->has('mother_name'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('mother_name')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact No: </label>
                                            <input type="number" class="form-control" name="mother_contact_no" >
                                            <div class="invalid-feedback">
                                                Please enter the mother's contact name.
                                            </div>
                                            @if($errors->has('mother_contact_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('mother_contact_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Aboard Contact No: </label>
                                            <input type="number" class="form-control" name="aboard_contact_no" >
                                            <div class="invalid-feedback">
                                                Please enter the abroad contact number.
                                            </div>
                                            @if($errors->has('aboard_contact_no'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('aboard_contact_no')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Candidate Type: <span class="text-danger">*</span></label>
                                            <select class="custom-select select2" name="candidate_type" required>
                                                <option value disabled > Select Candidate Type</option>
                                                <option value="rba"> Rba</option>
                                                <option value="non rba"> Non Rba</option>
                                                <option value="default" selected> Default</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select candidate type
                                            </div>
                                            @if($errors->has('candidate_type'))
                                                <div class="invalid-feedback">
                                                    {{$errors->first('candidate_type')}}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit-section">
                    <button class="btn btn-primary submit-btn" id="submit-candidate-personal">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
