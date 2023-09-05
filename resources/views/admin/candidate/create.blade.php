@extends('layouts.entry_master')
@section('title') Candidate @endsection
@section('css')
    <style>
        /*
        *
        * ==========================================
        * CUSTOM UTIL CLASSES
        * ==========================================
        */
        #v-pills-tabContent {
            padding-top: 0;
        }
        .nav-pills-custom .nav-link {
            color: #8595ad;
            background: #fff;
            position: relative;
        }


        /* Add indicator arrow for the active tab */
        @media (min-width: 992px) {
            .nav-pills-custom .nav-link::before {
                content: '';
                display: block;
                border-top: 8px solid transparent;
                border-left: 10px solid #fff;
                border-bottom: 8px solid transparent;
                position: absolute;
                top: 50%;
                right: -10px;
                transform: translateY(-50%);
                opacity: 0;
            }
        }

        .nav-pills-custom .nav-link.active::before {
            opacity: 1;
        }
        @media (min-width: 768px) {
            .side-tab-sticky{
                position: sticky;
                overflow-y: auto;
                top: 75px;
                bottom: 0;
                height: 160vh;
            }
        }
        .select-height{
            height: 44px;
        }
        #select2-country-container{
            text-transform: capitalize;
        }
        #select2-duration-container{
            text-transform: capitalize;
        }

        .thumbnail-order{
            position: relative;
            z-index: 0;
        }

        .thumbnail-order:hover{
            background-color: transparent;
            z-index: 50;
        }

        .thumbnail-order span{ /*CSS for enlarged image*/
            position: absolute;
            background-color: #d3d3d37a;
            padding: 5px;
            left: -1000px;
            box-shadow: 1px 1px 3px rgba(0,0,0,.45);
            visibility: hidden;
            display: none;
            color: black;
            text-decoration: none;
        }

        .thumbnail-order span img{ /*CSS for enlarged image*/
            border-width: 0;
            padding: 2px;
        }

        .thumbnail-order:hover span{ /*CSS for enlarged image on hover*/
            visibility: visible;
            display: block;
            top: -1260%;
            left: -520px; /*position where enlarged image should offset horizontally */
        }


        .thumbnailbank-order{
            position: relative;
            z-index: 0;
        }

        .thumbnailbank-order:hover{
            background-color: transparent;
            z-index: 50;
        }

        .thumbnailbank-order span{ /*CSS for enlarged image*/
            position: absolute;
            background-color: #d3d3d37a;
            padding: 5px;
            left: -1000px;
            box-shadow: 1px 1px 3px rgba(0,0,0,.45);
            visibility: hidden;
            display: none;
            color: black;
            text-decoration: none;
        }

        .thumbnailbank-order span img{ /*CSS for enlarged image*/
            border-width: 0;
            padding: 2px;
        }

        .thumbnailbank-order:hover span{ /*CSS for enlarged image on hover*/
            visibility: visible;
            display: block;
            top: -600%;
            left: -412px; /*position where enlarged image should offset horizontally */
        }
    </style>

@endsection
@section('content')


    @if(session('success'))

        <div class="notification-popup success">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{session('success')}}</span>
            </p>
        </div>
    @endif

    @if(session('error'))
        <div class="notification-popup danger">
            <p>
                <span class="task"></span>
                <span class="notification-text">{{session('error')}}</span>
            </p>
        </div>
    @endif



    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Candidate Entry</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Main Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('entry')}}">Entry Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate-personal-info.index')}}">Candidate</a></li>
                        <li class="breadcrumb-item active">Candidate Details Entry</li>
                    </ul>
                </div>
{{--                <div class="col-auto float-right ml-auto">--}}
{{--                    <a href="" class="btn add-btn" ><i class="fa fa-plus"></i> Add New Candidate</a>--}}
{{--                </div>--}}
{{--                <div class="col-auto float-right ml-auto">--}}
{{--                    <a href="" class="btn add-btn"><i class="fa fa-eye"></i> View Trash</a>--}}
{{--                </div>--}}
            </div>
        </div>
        <!-- /Page Header -->

        <div class="row ">


            <div class="col-md-3 side-tab-sticky">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-address-card-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Personal Details</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-professional-tab" data-toggle="pill" href="#v-pills-professional" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <i class="fa fa-black-tie mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Professional Experience</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-qualification-tab" data-toggle="pill" href="#v-pills-qualification" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fa fa-star mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Qualification Details</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-demand-tab" data-toggle="pill" href="#v-pills-demand" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-suitcase mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Demand Job Details</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-document-tab" data-toggle="pill" href="#v-pills-document" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-file-text mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Document Details</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-police-tab" data-toggle="pill" href="#v-pills-police" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-file-text mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Police Report</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-license-tab" data-toggle="pill" href="#v-pills-license" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-car mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">License Details</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-medical-tab" data-toggle="pill" href="#v-pills-medical" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-user-md mr-2"></i>
{{--                        <i class=""></i>--}}
                        <span class="font-weight-bold small text-uppercase">Medical Information</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-bank-tab" data-toggle="pill" href="#v-pills-bank" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-bookmark  mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Bank/Misc Details</span></a>
                </div>
            </div>


            <div class="col-md-9 ">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4">Personal Information</h4>
                        <div class="col-md-12">

                            <div class="profile-img-wrap edit-img">
                                <img class="inline-block" alt="{{@$candidate_personal->candidate_firstname}}" src="<?php if(!empty(@$candidate_personal->image)){ echo '/images/candidate_info/'.$candidate_personal->image; } else { if($candidate_personal->gender=="male") {echo '/images/profiles/male.png'; } elseif($candidate_personal->gender=="female") {echo '/images/profiles/female.png'; } elseif($candidate_personal->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration No:</label>
                                        <input type="text" class="form-control" name="registration_no" value="{{$candidate_personal->registration_no}}" readonly>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration Date (AD):</label>
                                        <input type="text" class="form-control" name="registration_date_ad" value="{{$candidate_personal->registration_date_ad}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Serial No:</label>
                                        <input type="text" class="form-control" name="serial_no" value="{{$candidate_personal->serial_no}}" readonly>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Registration Date (BS):</label>
                                        <input type="text" class="form-control" name="registration_date_bs" value="{{$candidate_personal->registration_date_bs}}" readonly>
                                    </div>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passport No:</label>
                                        <input type="text" class="form-control" name="passport_no" value="{{$candidate_personal->passport_no}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Birth Place:</label>
                                        <input type="text" class="form-control" name="birth_place" value="{{$candidate_personal->birth_place}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Issued Date:</label>
                                        <input type="text" class="form-control" name="issued_date" value="{{$candidate_personal->issued_date}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Expiry Date:</label>
                                        <input type="text" class="form-control" name="expiry_date" value="{{$candidate_personal->expiry_date}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reference Name:</label>
                                        <select class="custom-select select-height" name="reference_information_id" id="reference_information_id" disabled>
                                            <option value disabled selected> Select Reference Name</option>
                                            @foreach($reference as $ref)
                                                <option value="{{$ref->id}}" {{($candidate_personal->reference_information_id == $ref->id) ? "selected" : ""}}> {{$ref->reference_name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Receipt No:</label>
                                        <input type="text" class="form-control" name="receipt_no" value="{{$candidate_personal->receipt_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Candidate First Name:</label>
                                        <input type="text" class="form-control" name="candidate_firstname" value="{{$candidate_personal->candidate_firstname}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Candidate Middle Name:</label>
                                        <input type="text" class="form-control" name="candidate_middlename" value="{{$candidate_personal->candidate_middlename}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Candidate Last Name:</label>
                                        <input type="text" class="form-control" name="candidate_lastname" value="{{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Age:</label>
                                        <input type="number" class="form-control" name="age" value="{{$candidate_personal->age}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Next of Kin:</label>
                                        <input type="text" class="form-control" name="next_of_kin" value="{{$candidate_personal->next_of_kin}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Relationship:</label>
                                        <select class="select" name="kin_relationship" disabled>
                                            <option value disabled> Select Relationship</option>
                                            <option value="father" {{($candidate_personal->kin_relationship == "father") ? "selected" : ""}}> Father </option>
                                            <option value="mother" {{($candidate_personal->kin_relationship == "mother") ? "selected" : ""}}> Mother </option>
                                            <option value="husband" {{($candidate_personal->kin_relationship == "husband") ? "selected" : ""}}> Husband </option>
                                            <option value="wife" {{($candidate_personal->kin_relationship == "wife") ? "selected" : ""}}> Wife </option>
                                            <option value="brother" {{($candidate_personal->kin_relationship == "brother") ? "selected" : ""}}> Brother </option>
                                            <option value="sister" {{($candidate_personal->kin_relationship == "sister") ? "selected" : ""}}> Sister </option>
                                            <option value="son" {{($candidate_personal->kin_relationship == "son") ? "selected" : ""}}> Son </option>
                                            <option value="daughter" {{($candidate_personal->kin_relationship == "daughter") ? "selected" : ""}}> Daughter </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No:</label>
                                        <input type="text" class="form-control" name="kin_contact_no" value="{{$candidate_personal->kin_contact_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <select class="select" name="gender" disabled>
                                            <option value disabled> Select Gender</option>
                                            <option value="male" {{($candidate_personal->gender == "male") ? "selected" : ""}}> Male </option>
                                            <option value="female" {{($candidate_personal->gender == "female") ? "selected" : ""}}> Female </option>
                                            <option value="others" {{($candidate_personal->gender == "others") ? "selected" : ""}}> Others </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nationality:</label>
                                        <input type="text" class="form-control" name="nationality" value="{{$candidate_personal->nationality}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Religion:</label>
                                        <select class="select select-height" name="religion" disabled>
                                            <option value disabled> Select Religion</option>
                                            <option value="hindu" {{($candidate_personal->religion == "hindu") ? "selected" : ""}}> Hindu </option>
                                            <option value="muslim" {{($candidate_personal->religion == "muslim") ? "selected" : ""}}> Muslim </option>
                                            <option value="christian" {{($candidate_personal->religion == "christian") ? "selected" : ""}}> Christian</option>
                                            <option value="buddhist" {{($candidate_personal->religion == "buddhist") ? "selected" : ""}}> Buddhist </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth:</label>
                                        <input type="text" class="form-control" name="date_of_birth" value="{{$candidate_personal->date_of_birth}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No:</label>
                                        <input type="text" class="form-control" name="mobile_no" value="{{$candidate_personal->mobile_no}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No:</label>
                                        <input type="text" class="form-control" name="contact_no" value="{{$candidate_personal->contact_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Martial Status:</label>
                                        <select class="select select-height" name="martial_status" disabled>
                                            <option value disabled> Select Martial Status</option>
                                            <option value="married" {{($candidate_personal->martial_status == "married") ? "selected" : ""}}> Married </option>
                                            <option value="single" {{($candidate_personal->martial_status == "single") ? "selected" : ""}}> Single </option>
                                            <option value="widow" {{($candidate_personal->martial_status == "widow") ? "selected" : ""}}> Widow </option>
                                            <option value="widower" {{($candidate_personal->martial_status == "widower") ? "selected" : ""}}> Widower </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Spouse:</label>
                                        <input type="text" class="form-control" name="spouse" value="{{$candidate_personal->contact_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Children:</label>
                                        <input type="number" class="form-control" name="children" value="{{$candidate_personal->children}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" name="email_address" value="{{$candidate_personal->email_address}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Height:</label>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" name="height" value="{{$candidate_personal->height}}" readonly />
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Fts</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Weight:</label>
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" name="weight" value="{{$candidate_personal->weight}}" readonly />
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kgs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Father Name:</label>
                                        <input type="text" class="form-control" name="father_name" value="{{$candidate_personal->father_name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No:</label>
                                        <input type="text" class="form-control" name="father_contact_no" value="{{$candidate_personal->father_contact_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mother Name:</label>
                                        <input type="text" class="form-control" name="mother_name" value="{{$candidate_personal->mother_name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No:</label>
                                        <input type="text" class="form-control" name="mother_contact_no" value="{{$candidate_personal->mother_contact_no}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Permanent Address:</label>
                                        <input type="text" class="form-control" name="permanent_address" value="{{$candidate_personal->permanent_address}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Temporary Address:</label>
                                        <input type="text" class="form-control" name="temporary_address" value="{{$candidate_personal->temporary_address}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Aboard Contact No:</label>
                                        <input type="text" class="form-control" name="aboard_contact_no" value="{{$candidate_personal->aboard_contact_no}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Candidate Type:</label>
                                        <select class="select" name="candidate_type" disabled>
                                            <option value disabled> Select Candidate Type</option>
                                            <option value="rba" {{($candidate_personal->candidate_type == "rba") ? "selected" : ""}}> Rba</option>
                                            <option value="non rba" {{($candidate_personal->candidate_type == "non rba") ? "selected" : ""}}> Non Rba</option>
                                            <option value="default" {{($candidate_personal->candidate_type == "default") ? "selected" : ""}}> Default</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

{{--                    tab - professional and trainings details--}}
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-professional" role="tabpanel" aria-labelledby="v-pills-professional-tab">
                        <h4 class="font-italic mb-4">Professional Information</h4>
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1" data-toggle="tab">Professional Experience </a></li>
                            <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2" data-toggle="tab">Professional Training</a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane show active" id="bottom-justified-tab1">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => 'candidate-professional-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}

                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Job Ref No: </label>
                                                <input type="text" class="form-control" name="job_ref_no">
                                                <div class="invalid-feedback">
                                                    Please enter the job reference number
                                                </div>
                                                @if($errors->has('job_ref_no'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('job_ref_no')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company Name: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="company_name" required>
                                                <div class="invalid-feedback">
                                                    Please enter the company name.
                                                </div>
                                                @if($errors->has('registration_no'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('registration_no')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address: </label>
                                                <input type="text" class="form-control" name="address">
                                                <div class="invalid-feedback">
                                                    Please enter the address.
                                                </div>
                                                @if($errors->has('address'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('address')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country: <span class="text-danger">*</span></label>
                                                <select class="custom-select select country select-height" name="country" required>
                                                    <option value disabled selected> Select Country</option>
                                                    @foreach($countries as $key => $value)
                                                        <option value="{{$key}}">{{ucwords($value)}} </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the country.
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Category of Job: </label>
                                                <input type="text" class="form-control" name="category_of_job">
                                                <div class="invalid-feedback">
                                                    Please enter the category of the job
                                                </div>
                                                @if($errors->has('category_of_job'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('category_of_job')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation: </label>
                                                <input type="text" class="form-control" name="designation" >
                                                <div class="invalid-feedback">
                                                    Please enter the designation
                                                </div>
                                                @if($errors->has('designation'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('designation')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>From: </label>
                                                <input type="text" class="form-control professional-from" name="from" id="datepicker-from">
                                                <div class="invalid-feedback">
                                                    Please choose from.
                                                </div>
                                                @if($errors->has('from'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('from')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>To: </label>
                                                <input type="text" class="form-control professional-to" name="to" id="datepicker-to" required>
                                                <div class="invalid-feedback">
                                                    Please choose to.
                                                </div>
                                                @if($errors->has('to'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('to')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Duration (in years): </label>
                                                <input type="text" class="form-control" name="duration" id="duration_professional" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter the designation
                                                </div>
                                                @if($errors->has('duration'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('designation')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Document Image: </label>
                                                <input type="file" class="form-control" name="document">
                                                <div class="invalid-feedback">
                                                    Please upload the document image.
                                                </div>
                                                @if($errors->has('document'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('document')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" id="submit-candidate-professional">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <br/>
                                    <form action="#" method="post" id="deleted-form" >
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="delete">
                                    </form>
                                    <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>Job Ref No</th>
                                            <th>Company</th>
                                            <th>Job</th>
                                            <th>Duration</th>
                                            <th>Designation</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($professional_info)>0)
                                            @foreach(@$professional_info as $professional)
                                            <tr>
                                                <td>{{$professional->job_ref_no}}</td>
                                                <td>{{$professional->company_name}}</td>
                                                <td>{{$professional->category_of_job}}</td>
                                                <td>{{$professional->duration}}</td>
                                                <td>{{$professional->designation}}</td>
                                                <td class="text-right">

                                                    <div class="flex-shrink-0 ms-4">
                                                        <ul class="list-inline tasks-list-menu mb-0">
                                                            <li class="list-inline-item">
                                                                <a class="action-professional-view" href="#" hrm-view-action="{{route('candidate-professional-info.show',$professional->id)}}" data-toggle="modal" data-target="#view_professional_info" id="{{$professional}}">
                                                                    <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                                            <li class="list-inline-item">
                                                                <a class="action-professional-edit" href="#" hrm-edit-action="{{route('candidate-professional-info.edit',$professional->id)}}" hrm-update-action="{{route('candidate-professional-info.update',$professional->id)}}" data-toggle="modal">
                                                                    <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                                            <li class="list-inline-item">
                                                                <a class="remove-item-btn action-professional-delete" href="#" hrm-delete-action="{{route('candidate-professional-info.destroy',$professional->id)}}">
                                                                    <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                                        </ul>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">There are no details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane" id="bottom-justified-tab2">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => 'candidate-professional-training.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Certificate No: </label>
                                                <input type="text" class="form-control" name="certificate_no">
                                                <div class="invalid-feedback">
                                                    Please enter the certificate number.
                                                </div>
                                                @if($errors->has('certificate_no'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('certificate_no')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Training Type: </label>
                                                <input type="text" class="form-control" name="training_type">
                                                <div class="invalid-feedback">
                                                    Please enter the training type
                                                </div>
                                                @if($errors->has('training_type'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('training_type')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Institute Name: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="institute_name" required>
                                                <div class="invalid-feedback">
                                                    Please enter the name of institute.
                                                </div>
                                                @if($errors->has('institute_name'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('institute_name')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country: <span class="text-danger">*</span></label>
                                                <select class="custom-select select-height country" name="country" required>
                                                    <option value disabled selected> Select Country</option>
                                                    @foreach($countries as $key => $value)
                                                        <option value="{{$key}}">{{ucwords($value)}} </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the name of the country.
                                                </div>
                                                @if($errors->has('country'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('country')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Duration: <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" min="1" class="form-control" name="duration" required />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">in Months</span>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter the duration.
                                                </div>
                                                @if($errors->has('duration'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('duration')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Certificate Image: </label>
                                                <input type="file" class="form-control" name="certificate">
                                                <div class="invalid-feedback">
                                                    Please upload the certificate image.
                                                </div>
                                                @if($errors->has('certificate'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('certificate')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" id="submit-candidate-professional-trainings">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <br/>
                                    <form action="#" method="post" id="deleted-form" >
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="delete">
                                    </form>
                                    <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>Certificate no</th>
                                            <th>Type</th>
                                            <th>Institute</th>
                                            <th>Country</th>
                                            <th>Duration (in month)</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($training_info)>0)
                                            @foreach(@$training_info as $trainings)
                                                <tr>
                                                    <td>{{ ($trainings->certificate_no !== null) ? $trainings->certificate_no:"Not Set" }}</td>
                                                    <td>{{ ($trainings->training_type !== null) ? $trainings->training_type:"Not Set" }}</td>
                                                    <td>{{$trainings->institute_name}}</td>
                                                    <td>
                                                        @foreach($countries as $key => $value)
                                                            @if($key == $trainings->country)
                                                                {{$value}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{$trainings->duration}} </td>
                                                    <td class="text-right">
                                                        <div class="flex-shrink-0 ms-4">
                                                            <ul class="list-inline tasks-list-menu mb-0">
                                                                <li class="list-inline-item">
                                                                    <a class="action-training-view" href="#" hrm-view-action="{{route('candidate-professional-training.show',$trainings->id)}}" data-toggle="modal" data-target="#view_trainings_info" id="{{$trainings->id}}">
                                                                        <i class="fa fa-eye align-bottom me-2 text-muted"></i></a></li>
                                                                <li class="list-inline-item">
                                                                    <a class="action-training-edit" href="#" hrm-edit-action="{{route('candidate-professional-training.edit',$trainings->id)}}" hrm-update-action="{{route('candidate-professional-training.update',$trainings->id)}}" data-toggle="modal">
                                                                        <i class="fa fa-pencil align-bottom me-2 text-muted"></i></a></li>
                                                                <li class="list-inline-item">
                                                                    <a class="remove-item-btn action-training-delete" href="#" hrm-delete-action="{{route('candidate-professional-training.destroy',$trainings->id)}}">
                                                                        <i class="fa fa-trash-o align-bottom me-2 text-muted"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center">There are no training details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>

{{--                    tab - qualification and language details--}}
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-qualification" role="tabpanel" aria-labelledby="v-pills-qualification-tab">
                        <h4 class="font-italic mb-4">Qualification Information</h4>
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab3" data-toggle="tab">Qualification</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab4" data-toggle="tab">Language Information</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="bottom-justified-tab3">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => 'candidate-qualification-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>School/College Name: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="school_college_name" required>
                                                <div class="invalid-feedback">
                                                    Please enter the School/college name
                                                </div>
                                                @if($errors->has('school_college_name'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('school_college_name')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Academic Level: <span class="text-danger">*</span></label>
                                                <select class="custom-select select-height" name="academic_level" required>
                                                    <option value disabled selected> Select Academic Level </option>
                                                    <option value="bachelors"> Bachelors  </option>
                                                    <option value="post-graduate"> Post Graduate  </option>
                                                    <option value="higher-secondary"> Higher Secondary </option>
                                                    <option value="lower-secondary"> Lower Secondary  </option>
                                                    <option value="SLC"> SLC </option>
                                                    <option value="none"> None </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the academic level.
                                                </div>
                                                @if($errors->has('academic_level'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('academic_level')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="address" required>
                                                <div class="invalid-feedback">
                                                    Please enter the address.
                                                </div>
                                                @if($errors->has('address'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('address')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Completed On: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="completed_on" id="datepicker-completed-on" required>
                                                <div class="invalid-feedback">
                                                    Please select completed on date.
                                                </div>
                                                @if($errors->has('completed_on'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('completed_on')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Division: </label>
                                                <select class="custom-select select-height" name="division" >
                                                    <option value disabled selected> Select Division </option>
                                                    <option value="distinction"> Distinction </option>
                                                    <option value="first-division"> First Division </option>
                                                    <option value="second-division"> Second Division </option>
                                                    <option value="third-division"> Third Division </option>
                                                    <option value="fail"> Fail </option>
                                                    <option value="none"> None </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the division.
                                                </div>
                                                @if($errors->has('division'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('division')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Result: <span class="text-danger">*</span></label>
                                                <select class="custom-select select-height" name="result" required>
                                                    <option value disabled selected> Select Result </option>
                                                    <option value="pass"> Pass </option>
                                                    <option value="fail"> Fail </option>
                                                    <option value="waiting"> Waiting </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the result.
                                                </div>
                                                @if($errors->has('result'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('result')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Study Document Image: </label>
                                                <input type="file" class="form-control" name="document">
                                                <div class="invalid-feedback">
                                                    Please upload the document image.
                                                </div>
                                                @if($errors->has('document'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('document')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" id="submit-candidate-qualification">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <br/>
                                    <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>School/College name</th>
                                            <th>Academic Level</th>
                                            <th>Address</th>
                                            <th>Completed On</th>
                                            <th>Division</th>
                                            <th>Result</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($qualification_info)>0)
                                            @foreach(@$qualification_info as $qualification)
                                                <tr>
                                                    <td>{{ucfirst($qualification->school_college_name)}}</td>
                                                    <td>{{ucfirst(str_replace('-',' ',$qualification->academic_level))}}</td>
                                                    <td>{{ucfirst($qualification->address)}}</td>
                                                    <td>{{\Carbon\Carbon::parse($qualification->completed_on)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td>{{ucfirst(str_replace('-',' ',$qualification->division))}} </td>
                                                    <td>{{ucfirst($qualification->result)}} </td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item action-qualification-view" href="#" hrm-view-action="{{route('candidate-qualification-info.show',$qualification->id)}}" data-toggle="modal" data-target="#view_qualification_info" id="{{$qualification->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                <a class="dropdown-item action-qualification-edit" href="#" hrm-edit-action="{{route('candidate-qualification-info.edit',$qualification->id)}}" hrm-update-action="{{route('candidate-qualification-info.update',$qualification->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item action-qualification-delete" href="#"  hrm-delete-action="{{route('candidate-qualification-info.destroy',$qualification->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">There are no qualification details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane" id="bottom-justified-tab4">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => 'candidate-language-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}
                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Language: <span class="text-danger">*</span></label>
                                                <select class="custom-select select-height" name="language" required>
                                                    <option value disabled selected> Select language </option>
                                                    <option value="english"> English </option>
                                                    <option value="nepali"> Nepali </option>
                                                    <option value="hindi"> Hindi </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the result.
                                                </div>
                                                @if($errors->has('language'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('language')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Speaking: <span class="text-danger">*</span></label>
                                                <select class="select select-height" name="speaking" required>
                                                    <option value disabled selected> Select Speaking </option>
                                                    <option value="excellent"> Excellent </option>
                                                    <option value="good"> Good </option>
                                                    <option value="basic"> Basic </option>
                                                    <option value="poor"> Poor </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the result.
                                                </div>
                                                @if($errors->has('speaking'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('speaking')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Reading: <span class="text-danger">*</span></label>
                                                <select class="select select-height" name="reading" required>
                                                    <option value disabled selected> Select Reading </option>
                                                    <option value="excellent"> Excellent </option>
                                                    <option value="good"> Good </option>
                                                    <option value="basic"> Basic </option>
                                                    <option value="poor"> Poor </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the result.
                                                </div>
                                                @if($errors->has('reading'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('reading')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Writing: <span class="text-danger">*</span></label>
                                                <select class="select select-height" name="writing" required>
                                                    <option value disabled selected> Select Writing </option>
                                                    <option value="excellent"> Excellent </option>
                                                    <option value="good"> Good </option>
                                                    <option value="basic"> Basic </option>
                                                    <option value="poor"> Poor </option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the result.
                                                </div>
                                                @if($errors->has('writing'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('writing')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" id="submit-candidate-language">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <br/>
                                    <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>Language</th>
                                            <th>Speaking</th>
                                            <th>Reading</th>
                                            <th>Writing</th>
                                            <th>Created By</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($language_info)>0)
                                            @foreach(@$language_info as $language)
                                                <tr>
                                                    <td>{{ucfirst($language->language)}}</td>
                                                    <td>{{ucfirst($language->speaking)}}</td>
                                                    <td>{{ucfirst($language->reading)}}</td>
                                                    <td>{{ucfirst($language->writing)}} </td>
                                                    <td>{{ucfirst(App\Models\User::find($language->created_by)->name)}} </td>
                                                    <td>
                                                        @if($language->updated_by == null)
                                                            No updates yet.
                                                        @else
                                                            {{ucfirst(\App\Models\User::find(@$language->updated_by)->name)}}
                                                        @endif
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item action-language-edit" href="#" hrm-edit-action="{{route('candidate-language-info.edit',$language->id)}}" hrm-update-action="{{route('candidate-language-info.update',$language->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item action-language-delete" href="#"  hrm-delete-action="{{route('candidate-language-info.destroy',$language->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">There are no Language details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--demand job information--}}
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-demand" role="tabpanel" aria-labelledby="v-pills-demand-tab">
                        <h4 class="font-italic mb-4">Demand to Job Information</h4>

                        <div class="col-md-12">
                            @if($demand_job_info == null)

                            {!! Form::open(['route' => 'candidate-demand-job-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'']) !!}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Skills:</label>
                                        <textarea type="text" class="form-control" rows="2" name="skills">
                                        </textarea>
                                        <div class="invalid-feedback">
                                            Please enter the needed skills.
                                        </div>
                                        @if($errors->has('skills'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('skills')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Actual Job Category: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="job_category_id" required>
                                            <option value disabled selected> Select Job Category </option>
                                            @foreach($jobcategory as $cat)
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Salary: <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="salary" required>
                                        <div class="invalid-feedback">
                                            Please enter the previous job salary.
                                        </div>
                                        @if($errors->has('salary'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('salary')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="enable_damand_entry" value="" id="invalidCheck" >
                                                <label class="form-check-label" for="invalidCheck">
                                                   Enable Demand Entry
                                                </label>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company Name: </label>
                                        <select class="custom-select demand-company-name select-height" name="demand_info_id" disabled>
                                            <option value disabled selected> Select Company Name </option>
                                            @foreach($demandinfo as $demand)
                                                <option value="{{$demand->id}}">{{ucwords($demand->company_name)}} </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the company name.
                                        </div>
                                        @if($errors->has('demand_info_id'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('demand_info_id')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Job Category:</label>
                                        <select class="custom-select demand-job-category select-height" name="job_to_demand_id" id="job_to_demand_id" disabled>
                                            <option value disabled selected> Select Job Category </option>

                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the demand related job category.
                                        </div>
                                        @if($errors->has('job_to_demand_id'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('job_to_demand_id')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Demand Issued Date:</label>
                                        <input type="text" class="form-control demand-issue-date" name="issued_date" readonly>
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
                                        <label>Current Demand Status Applied Date:</label>
                                        <input type="text" class="form-control demand-status-applied" name="status_applied_date" readonly>
                                        <div class="invalid-feedback">
                                            Please select the status applied date.
                                        </div>
                                        @if($errors->has('status_applied_date'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('status_applied_date')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. of Pax:</label>
                                        <input type="number" min="1" class="form-control demand-number-pax" name="num_of_pax" readonly>
                                        <div class="invalid-feedback">
                                            Please enter the number of pax.
                                        </div>
                                        @if($errors->has('num_of_pax'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('num_of_pax')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Agent Name:</label>
                                        <select class="custom-select demand-agency-name select-height" name="overseas_agent_id" disabled>
                                            <option value disabled selected> Select Agent Name </option>
                                            @foreach($overseasagent as $agent)
                                                <option value="{{$agent->id}}">{{ucwords($agent->fullname)}} </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the Reference Agent name.
                                        </div>
                                        @if($errors->has('overseas_agent_id'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('overseas_agent_id')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub Status:</label>
                                        <select class="custom-select demand-sub-status select-height" name="sub_status_id" disabled>
                                            <option value disabled selected> Select Sub Status </option>
                                            @foreach($substatus as $substat)
                                                <option value="{{$substat->id}}">{{ucwords($substat->name)}} </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            Please enter the sub status.
                                        </div>
                                        @if($errors->has('sub_status_id'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('sub_status_id')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Candidate's Receivable Salary from Job:</label>
                                        <input type="number" class="form-control demand-receivable-salary" name="receivable_salary" min="0" readonly/>
                                        <div class="invalid-feedback">
                                            Please enter the receivable salary.
                                        </div>
                                        @if($errors->has('receivable_salary'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('receivable_salary')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reference Agent's Name:</label>
                                        <input type="text" class="form-control demand-reference-agent" value="{{$candidate_personal->referenceInfo->reference_name}}" name="reference_agent" readonly/>
                                        <div class="invalid-feedback">
                                            Please enter the receivable salary.
                                        </div>
                                        @if($errors->has('receivable_salary'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('receivable_salary')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reference Agent's receivable amount:</label>
                                        <input type="number" class="form-control demand-reference-amount" name="reference_amount"  min="0" readonly/>
                                        <div class="invalid-feedback">
                                            Please enter the receivable salary.
                                        </div>
                                        @if($errors->has('receivable_salary'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('receivable_salary')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remarks:</label>
                                        <textarea type="text" class="form-control demand-remarks" name="remarks" readonly>
                                        </textarea>
                                        <div class="invalid-feedback">
                                            Please enter the remarks.
                                        </div>
                                        @if($errors->has('remarks'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('remarks')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" id="submit-candidate-demandentry">Submit</button>
                            </div>

                            {!! Form::close() !!}
                            @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <span>You can edit the demand assigned to <strong> {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}</strong> here: </span>
                                    </div>
                                </div>
                            @endif
                            <br/>
                            <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>Actual Job Category</th>
                                    <th>Company Name</th>
                                    <th>Issued date </th>
                                    <th>Applied date</th>
                                    <th>Agent Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($demand_job_info !== null)
                                        <tr>
                                            <td>{{ucfirst(\App\Models\JobCategory::find($demand_job_info->job_category_id)->name)}}</td>
                                            <td>
                                                {{($demand_job_info->demand_info_id === null) ? "Not set": ucfirst(\App\Models\DemandInformation::find($demand_job_info->demand_info_id)->company_name)}}
                                            </td>
                                            <td>
                                                {{($demand_job_info->issued_date === null) ? "Not set": \Carbon\Carbon::parse($demand_job_info->issued_date)->isoFormat('MMMM Do, YYYY')}}
                                            </td>
                                            <td>
                                                {{($demand_job_info->issued_date === null) ? "Not set": \Carbon\Carbon::parse($demand_job_info->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                            </td>
                                            <td>
                                                {{($demand_job_info->overseas_agent_id === null) ? "Not set": ucfirst(\App\Models\OverseasAgent::find($demand_job_info->overseas_agent_id)->fullname)}}
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-demand-job-view" href="#" hrm-view-action="{{route('candidate-demand-job-info.show',$demand_job_info->id)}}" data-toggle="modal" data-target="#view_demandentry_info" id="{{$demand_job_info->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                        <a class="dropdown-item action-demand-job-edit" href="#" hrm-edit-action="{{route('candidate-demand-job-info.edit',$demand_job_info->id)}}" hrm-update-action="{{route('candidate-demand-job-info.update',$demand_job_info->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item action-demand-job-delete" href="#"  hrm-delete-action="{{route('candidate-demand-job-info.destroy',$demand_job_info->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">There are no demand job assigned to {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>


                        </div>

                    </div>

                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-document" role="tabpanel" aria-labelledby="v-pills-document-tab">
                        <h4 class="font-italic mb-4">Document Information</h4>
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'candidate-document-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label>Candidate data for: <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Resume: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="resume" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the resume value.
                                        </div>
                                        @if($errors->has('resume'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('resume')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Original Passport: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="original_passport" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the original passport value.
                                        </div>
                                        @if($errors->has('original_passport'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('original_passport')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passport Xerox Copy: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="passport_xerox_copy" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the passport Xerox copy value.
                                        </div>
                                        @if($errors->has('passport_xerox_copy'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('passport_xerox_copy')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Academic Certificates: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="academic_certificates" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the academic certificate value.
                                        </div>
                                        @if($errors->has('academic_certificates'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('academic_certificates')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Original Academic Certificates: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="original_academic" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="original"> Original </option>
                                            <option value="copy"> Copy </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the original academic certificate value.
                                        </div>
                                        @if($errors->has('original_academic'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('original_academic')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Professional Training: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="professional_training" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the professional training value.
                                        </div>
                                        @if($errors->has('professional_training'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('professional_training')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Work Certificates: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="work_certificates" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the work certificates value.
                                        </div>
                                        @if($errors->has('work_certificates'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('work_certificates')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Medical Reports: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="medical_reports" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the medical reports value.
                                        </div>
                                        @if($errors->has('medical_reports'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('medical_reports')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Original Driving License: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="original_driving_license" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the original driving license value.
                                        </div>
                                        @if($errors->has('original_driving_license'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('original_driving_license')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Driving License Copy: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="driving_license_copy" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the driving license copy value.
                                        </div>
                                        @if($errors->has('driving_license_copy'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('driving_license_copy')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photographs: <span class="text-danger">*</span></label>
                                        <select class="custom-select select-height" name="photographs" required>
                                            <option value disabled selected> Choose One </option>
                                            <option value="yes"> Yes </option>
                                            <option value="no"> No </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the photographs value.
                                        </div>
                                        @if($errors->has('photographs'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('photographs')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photograph Image:</label>
                                        <input type="file" class="form-control" name="photograph_image">
                                        <div class="invalid-feedback">
                                            Please upload the photograph image value.
                                        </div>
                                        @if($errors->has('photograph_image'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('photograph_image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Passport Image:</label>
                                        <input type="file" class="form-control" name="passport_image">
                                        <div class="invalid-feedback">
                                            Please upload the passport image.
                                        </div>
                                        @if($errors->has('passport_image'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('passport_image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Signature Image:</label>
                                        <input type="file" class="form-control" name="signature_image">
                                        <div class="invalid-feedback">
                                            Please upload the signature image value.
                                        </div>
                                        @if($errors->has('signature_image'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('signature_image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" id="submit-candidate-document">Submit</button>
                            </div>
                            {!! Form::close() !!}
                            <br/>
                            <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>Resume</th>
                                    <th>Original Passport</th>
                                    <th>Professional Training</th>
                                    <th>Academic certificates</th>
                                    <th>Medical Reports</th>
                                    <th>Original Driving License</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($document_info)>0)
                                    @foreach(@$document_info as $document)
                                        <tr>
                                            <td>{{ucfirst($document->resume)}}</td>
                                            <td>{{ucfirst($document->original_passport)}}</td>
                                            <td>{{ucfirst($document->professional_training)}}</td>
                                            <td>{{ucfirst($document->academic_certificates)}} </td>
                                            <td>{{ucfirst($document->medical_reports)}} </td>
                                            <td>{{ucfirst($document->original_driving_license)}} </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-document-view" href="#" hrm-view-action="{{route('candidate-document-info.show',$document->id)}}" data-toggle="modal" data-target="#view_document_info" id="{{$document->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                        <a class="dropdown-item action-document-edit" href="#" hrm-edit-action="{{route('candidate-document-info.edit',$document->id)}}" hrm-update-action="{{route('candidate-document-info.update',$document->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item action-document-delete" href="#"  hrm-delete-action="{{route('candidate-document-info.destroy',$document->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">There are no Document details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-police" role="tabpanel" aria-labelledby="v-pills-police-tab">
                        <h4 class="font-italic mb-4">Police Report Information</h4>
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab7" data-toggle="tab">Nepal Police Report</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab8" data-toggle="tab">PCC ( police criminal certificate )</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="bottom-justified-tab7">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => 'candidate-report-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Issued Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="issued" id="datepicker-report-issued" required>
                                                <div class="invalid-feedback">
                                                    Please enter the issued date.
                                                </div>
                                                @if($errors->has('issued'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('issued')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Stamping date <span class="text-danger">*</span></label>
                                                 <input type="text" class="form-control"  name="stamping_date" id="datepicker-report-stamp" required>
                                                 <div class="invalid-feedback">
                                                    Please select the stamping date.
                                                </div>
                                                @if($errors->has('stamping_date'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('stamping_date')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Registration Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="registration_number" required>
                                                <div class="invalid-feedback">
                                                    Please enter the registration number.
                                                </div>
                                                @if($errors->has('registration_number'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('registration_number')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Expiry Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="expiry_date" id="datepicker-report-expiry" required>
                                                <div class="invalid-feedback">
                                                    Please select completed on date.
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>PCC report image: </label>
                                                <input type="file" class="form-control" name="image">
                                                <div class="invalid-feedback">
                                                    Please upload the police report image.
                                                </div>
                                                @if($errors->has('image'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('image')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" id="submit-police-report">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <br/>
                                    <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>Issued Date</th>
                                            <th>Stamping date</th>
                                            <th>Registration Number</th>
                                            <th>Expiry Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($police_info)>0)
                                            @foreach(@$police_info as $report)
                                                <tr>
                                                    <td>{{\Carbon\Carbon::parse($report->issued)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($report->stamping_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td>{{$report->registration_number}}</td>
                                                    <td>{{\Carbon\Carbon::parse($report->expiry_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item action-police-view" href="#" hrm-view-action="{{route('candidate-report-info.show',$report->id)}}" data-toggle="modal" data-target="#view_police_report_info" id="{{$report->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                <a class="dropdown-item action-police-edit" href="#" hrm-edit-action="{{route('candidate-report-info.edit',$report->id)}}" hrm-update-action="{{route('candidate-report-info.update',$report->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item action-police-delete" href="#"  hrm-delete-action="{{route('candidate-report-info.destroy',$report->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">There are no police report details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane" id="bottom-justified-tab8">
                                <div class="col-md-12">
                                    {!! Form::open(['route' => 'candidate-pcc-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                                    <div class="form-group">
                                        <label>Candidate data for: <span class="text-danger">*</span></label>
                                        <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                        <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Country:</label>
                                                <select class="custom-select " name="country">
                                                    <option value disabled selected> Select Country </option>
                                                    @foreach($countries as $key => $value)
                                                        <option value="{{$key}}">{{ucwords($value)}} </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select the country.
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PCC Issued Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="issued" id="datepicker-pcc-issued" required>
                                                <div class="invalid-feedback">
                                                    Please enter the issued date.
                                                </div>
                                                @if($errors->has('issued'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('issued')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PCC Stamping date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"  name="stamping_date" id="datepicker-pcc-stamp" required>
                                                <div class="invalid-feedback">
                                                    Please select the stamping date.
                                                </div>
                                                @if($errors->has('stamping_date'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('stamping_date')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PCC Registration Number <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="registration_number" required>
                                                <div class="invalid-feedback">
                                                    Please enter the registration number.
                                                </div>
                                                @if($errors->has('registration_number'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('registration_number')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PCC Expiry Date <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="expired_date" id="datepicker-pcc-expiry" required>
                                                <div class="invalid-feedback">
                                                    Please select completed on date.
                                                </div>
                                                @if($errors->has('expired_date'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('expired_date')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Police report image: </label>
                                                <input type="file" class="form-control" name="image">
                                                <div class="invalid-feedback">
                                                    Please upload the police report image.
                                                </div>
                                                @if($errors->has('image'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('image')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" id="submit-candidate-language">Submit</button>
                                    </div>
                                    {!! Form::close() !!}
                                    <br/>
                                    <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                        <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th>Issued Date</th>
                                            <th>Stamping date</th>
                                            <th>Registration Number</th>
                                            <th>Expiry Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($pcc_info)>0)
                                            @foreach(@$pcc_info as $report)
                                                <tr>
                                                    <td>  @foreach($countries as $key => $value)
                                                            @if($key == $report->country)
                                                                {{$value}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($report->issued)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($report->stamping_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td>{{$report->registration_number}}</td>
                                                    <td>{{\Carbon\Carbon::parse($report->expiry_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                                    <td class="text-right">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item action-pcc-view" href="#" hrm-view-action="{{route('candidate-pcc-info.show',$report->id)}}" data-toggle="modal" data-target="#view_pcc_info" id="{{$report->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                                <a class="dropdown-item action-pcc-edit" href="#" hrm-edit-action="{{route('candidate-pcc-info.edit',$report->id)}}" hrm-update-action="{{route('candidate-pcc-info.update',$report->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                                <a class="dropdown-item action-pcc-delete" href="#"  hrm-delete-action="{{route('candidate-pcc-info.destroy',$report->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="7" class="text-center">There are no PCC report details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-license" role="tabpanel" aria-labelledby="v-pills-license-tab">
                        <h4 class="font-italic mb-4">License Information</h4>
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'candidate-license-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label>Candidate data for: <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>License No: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="license_no" required>
                                        <div class="invalid-feedback">
                                            Please enter the license number.
                                        </div>
                                        @if($errors->has('license_no'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('license_no')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>License Image(front/back): <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="image" required>
                                        <div class="invalid-feedback">
                                            Please upload the license image.
                                        </div>
                                        @if($errors->has('image'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>License Type: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="license_type" required>
                                        <div class="invalid-feedback">
                                            Please enter the license type.
                                        </div>
                                        @if($errors->has('license_type'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('license_type')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country: <span class="text-danger">*</span></label>
                                        <select class="custom-select " name="country" required>
                                            <option value disabled selected> Select Country </option>
                                            @foreach($countries as $key => $value)
                                                <option value="{{$key}}">{{ucwords($value)}} </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select the country.
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Issued Date: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="issued_date" id="license-issue-datepicker" required>
                                        <div class="invalid-feedback">
                                            Please enter the license issue date.
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
                                        <label>Expiry Date: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="expirary_date" id="license-expiry-datepicker" required>
                                        <div class="invalid-feedback">
                                            Please enter the license expiry date.
                                        </div>
                                        @if($errors->has('expirary_date'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('expirary_date')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remarks: <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" name="remarks" required>
                                            </textarea>
                                        <div class="invalid-feedback">
                                            Please enter the remarks.
                                        </div>
                                        @if($errors->has('remarks'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('remarks')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" id="submit-candidate-license">Submit</button>
                            </div>
                            {!! Form::close() !!}
                            <br/>

                            <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>License Number</th>
                                    <th>License Type</th>
                                    <th>Issue Date</th>
                                    <th>Expiry Date </th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($license_info)>0)
                                    @foreach(@$license_info as $license)
                                        <tr>
                                            <td>{{ucfirst($license->license_no)}}</td>
                                            <td>{{ucfirst($license->license_type)}}</td>
                                            <td>{{\Carbon\Carbon::parse($license->issued_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                            <td>{{\Carbon\Carbon::parse($license->expirary_date)->isoFormat('MMMM Do, YYYY')}}</td>
                                            <td>
                                                @foreach($countries as $key => $value)
                                                    @if($key == $license->country)
                                                        {{ucfirst($value)}}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-license-view" href="#" hrm-view-action="{{route('candidate-license-info.show',$license->id)}}" data-toggle="modal" data-target="#view_license_info" id="{{$license->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                        <a class="dropdown-item action-license-edit" href="#" hrm-edit-action="{{route('candidate-license-info.edit',$license->id)}}" hrm-update-action="{{route('candidate-license-info.update',$license->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item action-license-delete" href="#"  hrm-delete-action="{{route('candidate-license-info.destroy',$license->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">There are no License details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>


                    {{--medical information--}}
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-medical" role="tabpanel" aria-labelledby=" v-pills-medical-tab">
                        <h4 class="font-italic mb-4"> {{($medical_info !== null) ? "Update":"Add"}} Medical Information</h4>
                        <div class="col-md-12">
                            @if($medical_info !==null)
                                {!! Form::open(['route'=>['candidate-medical-info.update', @$medical_info->id],'method'=>'PUT','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            @else
                                {!! Form::open(['route' => 'candidate-medical-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            @endif
                            <div class="form-group">
{{--                                <label>Candidate data for: <span class="text-danger">*</span></label>--}}
                                <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Candidate Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Candidate Regd Number:</label>
                                                        <input type="text" class="form-control" name="registration_no" id="registration_no" value="{{$candidate_personal->registration_no}}" required readonly>
                                                        <div class="invalid-feedback">
                                                            Please select the candidate regd number.
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
                                                        <label>Candidate Name: <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control demand-applied-date" name="candidate_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" id="candidate_name" readonly>
                                                        <div class="invalid-feedback">
                                                            Please enter candidate name.
                                                        </div>
                                                        @if($errors->has('candidate_name'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('candidate_name')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Passport Number:</label>
                                                        <input type="text" class="form-control" name="passport_no" id="passport_no" value="{{$candidate_personal->passport_no}}" readonly>
                                                        <div class="invalid-feedback">
                                                            Please select the candidate passport number.
                                                        </div>
                                                        @if($errors->has('passport_number'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('passport_number')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mobile Number: <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="mobile_no" id="mobile_no"  value="{{$candidate_personal->mobile_no}}" readonly>
                                                        <div class="invalid-feedback">
                                                            Please enter candidate mobile number.
                                                        </div>
                                                        @if($errors->has('mobile_number'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('mobile_number')}}
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

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Complexion </label>
                                                        <input type="text" class="form-control" name="complexion" id="complexion" value="{{@$medical_info->complexion}}" />
                                                        <div class="invalid-feedback">
                                                            Please select the candidate complexion number.
                                                        </div>
                                                        @if($errors->has('complexion'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('complexion')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Blood Group </label>
                                                        <select class="custom-select country select-height" name="bloodgroup" id="bloodgroup">
                                                            <option value disabled {{($medical_info == null) ? "selected":""}}> Select Blood Group</option>
                                                            <option value="O-pos" {{(@$medical_info->bloodgroup == "O-pos") ? "selected":""}}>O+</option>
                                                            <option value="O-neg" {{(@$medical_info->bloodgroup == "O-neg") ? "selected":""}}>O-</option>
                                                            <option value="A-pos" {{(@$medical_info->bloodgroup == "A-pos") ? "selected":""}}>A+</option>
                                                            <option value="A-neg" {{(@$medical_info->bloodgroup == "A-neg") ? "selected":""}}>A-</option>
                                                            <option value="B-pos" {{(@$medical_info->bloodgroup == "B-pos") ? "selected":""}}>B+</option>
                                                            <option value="B-neg" {{(@$medical_info->bloodgroup == "B-neg") ? "selected":""}}>B-</option>
                                                            <option value="AB-pos" {{(@$medical_info->bloodgroup == "AB-pos") ? "selected":""}}>AB+</option>
                                                            <option value="AB-neg" {{(@$medical_info->bloodgroup == "AB-neg") ? "selected":""}}>AB-</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please enter candidate blood group.
                                                        </div>
                                                        @if($errors->has('blood_group'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('blood_group')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Height</label>
                                                        <div class="input-group">
                                                            <input type="number" min="1" class="form-control" name="height" id="height" value="{{@$medical_info->height}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">Fts</span>
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please select the candidate height.
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
                                                        <label>Weight </label>
                                                        <div class="input-group">
                                                            <input type="number" min="1" class="form-control" name="weight" id="weight" value="{{@$medical_info->weight}}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text" id="basic-addon2">Kgs</span>
                                                            </div>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Please enter candidate weight.
                                                        </div>
                                                        @if($errors->has('weight'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('weight')}}
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
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="check_medical" value="yes" id="checkMedical" {{(@$medical_info->check_medical == "yes") ? "checked":""}}>
                                            <label class="form-check-label" for="checkMedical">
                                                Check if you want to edit Medical Information
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Medical Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medical Report Number</label>
                                                        <input type="text" class="form-control medical-report required" name="medical_report_number" id="medical_report_number" value="{{@$medical_info->medical_report_number}}" readonly>
                                                        <div class="invalid-feedback">
                                                            Please select the Medical Report Number.
                                                        </div>
                                                        @if($errors->has('medical_report_num'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('medical_report_num')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Medical Clinic Name</label>
                                                        <select class="custom-select country select-height medical-report-select" name="health_clinic_id" id="health_clinic_id" disabled>
                                                            <option value disabled {{(@$medical_info->health_clinic_id == null || @$medical_info == null)? "selected":""}}> Select Medical Clinic</option>
                                                            @foreach($clinic_detail as $clinic)
                                                                <option value="{{$clinic->id}}" {{(@$medical_info->health_clinic_id == $clinic->id ) ? "selected":""}}>{{ucwords($clinic->name)}} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select Medical Clinic name.
                                                        </div>
                                                        @if($errors->has('medical_clinic'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('medical_clinic')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Issued Date</label>
                                                        <input type="text" class="form-control demand-status-applied medical-report" name="report_issued_date" id="report_issued_date" value="{{@$medical_info->report_issued_date}}" readonly>
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
                                                        <label>Expiry Date <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control medical-report" name="report_expiry_date" id="report_expiry_date" value="{{@$medical_info->report_expiry_date}}" readonly>
                                                        <div class="invalid-feedback">
                                                            Please select the expiry date.
                                                        </div>
                                                        @if($errors->has('expiry_date'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('expiry_date')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Result </label>
                                                <select class="custom-select country select-height medical-report-select" name="result" id="result" disabled>
                                                    <option value disabled {{(@$medical_info == null) ? "selected":""}}> Select Result</option>
                                                    <option value="fail" {{(@$medical_info->result == "fail") ? "selected":""}}>Fail</option>
                                                    <option value="pass" {{(@$medical_info->result == "pass") ? "selected":""}}>Pass</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please select result.
                                                </div>
                                                @if($errors->has('result'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('result')}}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Report </label>
                                                <textarea type="text" class="form-control medical-report" rows="2" name="report" id="report" readonly>{{@$medical_info->report}}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter report.
                                                </div>
                                                @if($errors->has('report'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('report')}}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Remarks </label>
                                                <textarea type="text" class="form-control medical-report" rows="2" name="report_remarks" id="report_remarks" readonly>{{@$medical_info->report_remarks}}</textarea>
                                                <div class="invalid-feedback">
                                                    Please enter report.
                                                </div>
                                                @if($errors->has('report_remarks'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('report_remarks')}}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input medical-report-select" type="checkbox" name="payment_status" value="yes" id="paymentCheck" {{(@$medical_info->payment_status == "yes") ? "checked":""}} disabled>
                                                            <label class="form-check-label medical-report-select" for="paymentCheck" disabled>
                                                                Medical Payment
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label>Amount (Nrs) </label>
                                                        <input type="text" class="form-control medical-report" name="amount" id="payment_amount" value="{{@$medical_info->amount}}" readonly>
                                                        <div class="invalid-feedback">
                                                            Please enter the payment amount.
                                                        </div>
                                                        @if($errors->has('amount'))
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('amount')}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Report Image:</label>
                                                <input type="file" class="form-control medical-report-select" name="report_image" disabled>
                                                <div class="invalid-feedback">
                                                    Please upload the report image.
                                                </div>
                                                @if($errors->has('report_image'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('report_image')}}
                                                    </div>
                                                @endif
                                            </div>

                                            @if(@$medical_info !== null)
                                                <div class="col-12 col-md-12 col-lg-9">
                                                    @if(@$medical_info->report_image !== null)
                                                        <label>Current Report Image:</label>
                                                        <div class="card">
                                                            <img src="{{asset('images/medical/'.@$medical_info->report_image)}}" class="card-img-top">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif

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
                                                <label>Status Applied Date: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control demand-status-applied medical-report" name="status_applied_date" id="status_applied_date" value="{{@$medical_info->status_applied_date}}" readonly>
                                                <div class="invalid-feedback">
                                                    Please enter status applied date.
                                                </div>
                                                @if($errors->has('status_applied_date'))
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('status_applied_date')}}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Sub Status: <span class="text-danger">*</span></label>
                                                <select class="custom-select country select-height medical-report-select" name="sub_status_id" id="sub_status_individual" disabled>
                                                    <option value disabled {{($medical_info == null) ? "selected":""}}> Select Sub Status</option>
                                                    @foreach($substatus as $sub)
                                                        <option value="{{$sub->id}}" {{(@$medical_info->sub_status_id == $sub->id) ? "selected":""}}>{{ucwords($sub->name)}} </option>
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
                                                <textarea type="text" class="form-control medical-report" rows="2" name="remarks" id="remarks_medical" readonly>{{@$medical_info->remarks}}</textarea>
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
                                <button class="btn btn-primary submit-btn" id="submit-candidate-medical">{{($medical_info == null) ? "Add":"Update"}}</button>
                            </div>
                            {!! Form::close() !!}
                            <br/>

                        </div>
                    </div>


                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-bank" role="tabpanel" aria-labelledby="v-pills-bank-tab">
                        <h4 class="font-italic mb-4">Bank/Misc Information</h4>
                        <div class="col-md-12">
                            {!! Form::open(['route' => 'candidate-bank-info.store','method'=>'post','class'=>'needs-validation','novalidate'=>'','enctype'=>'multipart/form-data']) !!}
                            <div class="form-group">
                                <label>Candidate data for: <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="candidate_personal_information_id" value="{{$candidate_personal->id}}" readonly>
                                <input type="text" class="form-control" name="personal_name" value="{{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bank Details: <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" name="bank_details" required>
                                        </textarea>
                                        <div class="invalid-feedback">
                                            Please enter the bank details.
                                        </div>
                                        @if($errors->has('bank_details'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('bank_details')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cheque Copy: <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" name="cheque_image" required>
                                        <div class="invalid-feedback">
                                            Please upload cheque image.
                                        </div>
                                        @if($errors->has('cheque_image'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('cheque_image')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Remarks: <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control" name="bank_remarks" required>
                                        </textarea>
                                        <div class="invalid-feedback">
                                            Please enter the bank remarks.
                                        </div>
                                        @if($errors->has('bank_remarks'))
                                            <div class="invalid-feedback">
                                                {{$errors->first('bank_remarks')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" id="submit-candidate-document">Submit</button>
                            </div>
                            {!! Form::close() !!}
                            <br/>

                            <table class="child_row-verified table-responsive table table-striped table-bordered nowrap">
                                <thead>
                                <tr>
                                    <th>Bank Details</th>
                                    <th>Cheque Image</th>
                                    <th>Bank Remarks</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($bank_info)>0)
                                    @foreach(@$bank_info as $bank)
                                        <tr>
                                            <td>{{ucfirst($bank->bank_details)}}</td>
                                            <td>
                                                    <img src="/images/bank/{{$bank->cheque_image}}" style="width:8rem;" alt="{{$bank->bank_details}}" />
                                            </td>
                                            <td>{{ucfirst($bank->bank_remarks)}}</td>
                                            <td>{{ucfirst(App\Models\User::find($bank->created_by)->name)}} </td>
                                            <td>
                                                @if($bank->updated_by == null)
                                                    No updates yet.
                                                @else
                                                    {{ucfirst(\App\Models\User::find(@$bank->updated_by)->name)}}
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item action-bank-view" href="#" hrm-view-action="{{route('candidate-bank-info.show',$bank->id)}}" data-toggle="modal" data-target="#view_bank_info" id="{{$bank->id}}"><i class="fa fa-eye m-r-5"></i> View </a>
                                                        <a class="dropdown-item action-bank-edit" href="#" hrm-edit-action="{{route('candidate-bank-info.edit',$bank->id)}}" hrm-update-action="{{route('candidate-bank-info.update',$bank->id)}}" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item action-bank-delete" href="#"  hrm-delete-action="{{route('candidate-bank-info.destroy',$bank->id)}}" ><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">There are no Bank details created for {{$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}} </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->

    <!-- View candidate professional info Modal -->
    @include('admin.modals.candidate.professional.view')
    <!-- /View candidate professional info Modal -->

    <!-- Edit candidate professional info Modal -->
    @include('admin.modals.candidate.professional.edit')
    <!-- /Edit candidate professional info Modal -->

    <!-- View candidate professional training info Modal -->
    @include('admin.modals.candidate.professional_training.view')
    <!-- /View candidate professional training info Modal -->

    <!-- Edit candidate professional training info Modal -->
    @include('admin.modals.candidate.professional_training.edit')
    <!-- /Edit candidate professional training info Modal -->

    <!-- view candidate qualification info Modal -->
    @include('admin.modals.candidate.qualification.view')
    <!-- /view candidate qualification info Modal -->

    <!-- Edit candidate qualification info Modal -->
    @include('admin.modals.candidate.qualification.edit')
    <!-- /Edit candidate qualification info Modal -->

    <!-- Edit language qualification info Modal -->
    @include('admin.modals.candidate.language.edit')
    <!-- /Edit language qualification info Modal -->

    <!-- view candidate document info Modal -->
    @include('admin.modals.candidate.document.view')
    <!-- /Edit candidate document info Modal -->

    <!-- view candidate document info Modal -->
    @include('admin.modals.candidate.document.edit')
    <!-- /Edit candidate document info Modal -->

    <!-- view candidate bank info Modal -->
    @include('admin.modals.candidate.bank.view')
    <!-- /Edit candidate bank info Modal -->

    <!-- edit candidate bank info Modal -->
    @include('admin.modals.candidate.bank.edit')
    <!-- /Edit candidate bank info Modal -->

    <!-- view candidate bank info Modal -->
    @include('admin.modals.candidate.license.view')
    <!-- /view candidate bank info Modal -->

    <!-- edit candidate bank info Modal -->
    @include('admin.modals.candidate.license.edit')
    <!-- /Edit candidate bank info Modal -->

    <!-- view candidate demand entry info Modal -->
    @include('admin.modals.candidate.demandentry.view')
    <!-- /view candidate demand entry info Modal -->

    <!-- edit candidate demand entry info Modal -->
    @include('admin.modals.candidate.demandentry.edit')
    <!-- /Edit candidate demand entry info Modal -->

     <!-- Forbidden Attribute Modal -->
     @include('admin.modals.sub_status.forbidden')
    <!-- /Forbidden Attribute Modal -->

    <!-- view candidate police info Modal -->
    @include('admin.modals.candidate.police.view')
    <!-- /view candidate police info Modal -->

    <!-- edit candidate police Modal -->
    @include('admin.modals.candidate.police.edit')
    <!-- /Edit candidate police Modal -->

    <!-- view candidate pcc info Modal -->
    @include('admin.modals.candidate.pcc.view')
    <!-- /view candidate pcc info Modal -->

    <!-- edit candidate pcc Modal -->
    @include('admin.modals.candidate.pcc.edit')
    <!-- /Edit candidate pcc Modal -->
@endsection
@section('js')
    <script type="text/javascript">
        var medical = "<?php echo @$medical_info->check_medical; ?>";

        $(document).on('change','input[name="enable_damand_entry"]', function (e) {
            e.preventDefault();
            if($(this).prop("checked") == true){

                $(".demand-remarks").removeAttr("readonly", "readonly");
                $(".demand-number-pax").removeAttr("readonly", "readonly");
                $(".demand-status-applied").removeAttr("readonly", "readonly");
                $(".demand-issue-date").removeAttr("readonly", "readonly");
                $(".demand-receivable-salary").removeAttr("readonly", "readonly");
                $(".demand-reference-amount").removeAttr("readonly", "readonly");


                $(".demand-sub-status").removeAttr("disabled", "disabled");
                $(".demand-agency-name").removeAttr("disabled", "disabled");
                $(".demand-job-category").removeAttr("disabled", "disabled");
                $(".demand-company-name").removeAttr("disabled", "disabled");

                $(".demand-remarks").attr("required", "required");
                $(".demand-number-pax").attr("required", "required");
                $(".demand-status-applied").attr("required", "required");
                $(".demand-issue-date").attr("required", "required");
                $(".demand-sub-status").attr("required", "required");
                $(".demand-agency-name").attr("required", "required");
                $(".demand-job-category").attr("required", "required");
                $(".demand-company-name").attr("required", "required");
            }
            else if($(this).prop("checked") == false){

                $(".demand-remarks").removeAttr("required", "required");
                $(".demand-number-pax").removeAttr("required", "required");
                $(".demand-status-applied").removeAttr("required", "required");
                $(".demand-issue-date").removeAttr("required", "required");
                $(".demand-sub-status").removeAttr("required", "required");
                $(".demand-agency-name").removeAttr("required", "required");
                $(".demand-job-category").removeAttr("required", "required");
                $(".demand-company-name").removeAttr("required", "required");


                $(".demand-remarks").attr("readonly", "readonly");
                $(".demand-number-pax").attr("readonly", "readonly");
                $(".demand-status-applied").attr("readonly", "readonly");
                $(".demand-issue-date").attr("readonly", "readonly");
                $(".demand-receivable-salary").attr("readonly", "readonly");
                $(".demand-reference-amount").attr("readonly", "readonly");

                $(".demand-sub-status").attr("disabled", "disabled");
                $(".demand-agency-name").attr("disabled", "disabled");
                $(".demand-job-category").attr("disabled", "disabled");
                $(".demand-company-name").attr("disabled", "disabled");



            }
        });

        $(document).on('change','input[name="check_medical"]', function (e) {
            e.preventDefault();
            if($(this).prop("checked") == true){
                medicalChecked();
            }
            else if($(this).prop("checked") == false){
                medicalNotChecked();
            }
        });

        function medicalChecked(){
            $(".medical-report").removeAttr("readonly", "readonly");
            $(".medical-report-select").removeAttr("disabled", "disabled");
            $(".required").attr("required", "required");
        }

        function medicalNotChecked(){
            $(".medical-report").attr("readonly", "readonly");
            $(".medical-report-select").attr("disabled", "disabled");
            $(".required").removeAttr("required", "required");

        }

        $(document).on('change','.update-enable-demand-entry', function (e) {
            e.preventDefault();
            if($(this).prop("checked") == true){

                checkedTrue();
            }
            else if($(this).prop("checked") == false){

                $(".update-demand-remarks").removeAttr("required", "required");
                $(".update-demand-number-pax").removeAttr("required", "required");
                $(".update-demand-status-applied").removeAttr("required", "required");
                $(".update-demand-issue-date").removeAttr("required", "required");
                $(".update-demand-sub-status").removeAttr("required", "required");
                $(".update-demand-agency-name").removeAttr("required", "required");
                $(".update-demand-job-category").removeAttr("required", "required");
                $(".update-demand-company-name").removeAttr("required", "required");
                $(".update-demand-reference-amount").removeAttr("required", "required");


                $(".update-demand-remarks").attr("readonly", "readonly");
                $(".update-demand-number-pax").attr("readonly", "readonly");
                $(".update-demand-status-applied").attr("readonly", "readonly");
                $(".update-demand-issue-date").attr("readonly", "readonly");
                $(".update-demand-receivable-salary").attr("readonly", "readonly");


                $(".update-demand-sub-status").attr("disabled", "disabled");
                $(".update-demand-agency-name").attr("disabled", "disabled");
                $(".update-demand-job-category").attr("disabled", "disabled");
                $(".update-demand-company-name").attr("disabled", "disabled");



            }
        });

        function checkedTrue(){
            $(".update-demand-remarks").removeAttr("readonly", "readonly");
            $(".update-demand-number-pax").removeAttr("readonly", "readonly");
            $(".update-demand-status-applied").removeAttr("readonly", "readonly");
            $(".update-demand-issue-date").removeAttr("readonly", "readonly");
            $(".update-demand-receivable-salary").removeAttr("readonly", "readonly");
            $(".update-demand-reference-amount").removeAttr("readonly", "readonly");

            $(".update-demand-sub-status").removeAttr("disabled", "disabled");
            $(".update-demand-agency-name").removeAttr("disabled", "disabled");
            $(".update-demand-job-category").removeAttr("disabled", "disabled");
            $(".update-demand-company-name").removeAttr("disabled", "disabled");

            $(".update-demand-remarks").attr("required", "required");
            $(".update-demand-number-pax").attr("required", "required");
            $(".update-demand-status-applied").attr("required", "required");
            $(".update-demand-issue-date").attr("required", "required");
            $(".update-demand-sub-status").attr("required", "required");
            $(".update-demand-agency-name").attr("required", "required");
            $(".update-demand-job-category").attr("required", "required");
            $(".update-demand-company-name").attr("required", "required");
        }

        $(document).ready(function () {

            if(medical =="yes"){
                medicalChecked();
            }
            else{
                medicalNotChecked();
            }

            $(".professional-to").on("dp.change", function() {
                var issue = $('.professional-from').data('date');

                var expiry        = new Date($(this).val()),
                    final_issue   = new Date(issue),
                    residency     = new Date(expiry - final_issue).getFullYear() - 1970;
                $('#duration_professional').attr('value',residency);
            });
            $("#edit-datepicker-to").on("dp.change", function() {
                var issue = $('#edit-datepicker-from').data('date');

                var expiry        = new Date($(this).val()),
                    final_issue   = new Date(issue),
                    residency     = new Date(expiry - final_issue).getFullYear() - 1970;
                $('#duration_professional_edit').attr('value',residency);
            });


            <?php if(@$theme_data->default_date_format=='nepali'){ ?>
                $('#datepicker-from').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-pcc-issued-edit').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-pcc-stamp-edit').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });

                $('#datepicker-pcc-expiry-edit').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-pcc-issued').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-pcc-stamp').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-pcc-expiry').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-report-issued').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-report-issued-edit').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-report-stamp').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#datepicker-report-expiry').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#edit-datepicker-from').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });

                $('#datepicker-to').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#edit-datepicker-to').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });

                $('#datepicker-completed-on').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#edit-datepicker-completed-on').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#license-issue-datepicker').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#license-expiry-datepicker').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#edit-license-issue-datepicker').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });
                $('#edit-license-expiry-datepicker').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    ndpYearCount: 10,
                    dateFormat :'YYYY-MM-DD',
                    language: "english",
                });

            $('.demand-issue-date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#issued_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            }); $('#report_expiry_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });

            $('.demand-status-applied').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('.status_applied_date').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            $('#edit_status_applied_dates').nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                ndpYearCount: 10,
                dateFormat :'YYYY-MM-DD',
                language: "english",
            });
            <?php }
            else if(@$theme_data->default_date_format=='english'){ ?>
                $("#datepicker-from").on("dp.change", function (e) {
                    $('#datepicker-to').data("DateTimePicker").minDate(e.date);
                });
                $("#datepicker-pcc-issued-edit").on("dp.change", function (e) {
                    $('#datepicker-pcc-expiry-edit').data("DateTimePicker").minDate(e.date);
                });
                $("#edit-datepicker-from").on("dp.change", function (e) {
                    $('#edit-datepicker-to').data("DateTimePicker").minDate(e.date);
                });
                $("#datepicker-report-issued").on("dp.change", function (e) {
                    $('#datepicker-report-expiry').data("DateTimePicker").minDate(e.date);
                });
                $("#license-issue-datepicker").on("dp.change", function (e) {
                    $('#license-expiry-datepicker').data("DateTimePicker").minDate(e.date);
                });
                $("#edit-license-issue-datepicker").on("dp.change", function (e) {
                    $('#edit-license-expiry-datepicker').data("DateTimePicker").minDate(e.date);
                });
                $("#report_issued_date").on("dp.change", function (e) {
                    $('#report_expiry_date').data("DateTimePicker").minDate(e.date);
                });

                $("#datepicker-report-issued-edit").on("dp.change", function (e) {
                    $('#datepicker-report-expiry-edit').data("DateTimePicker").minDate(e.date);
                });
                $('#datepicker-from').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                $("#datepicker-pcc-issued").on("dp.change", function (e) {
                    $('#datepicker-pcc-expiry').data("DateTimePicker").minDate(e.date);
                });

                $('#datepicker-pcc-issued').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-pcc-issued-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-pcc-expiry-edit').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-pcc-expiry').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-pcc-stamp').datetimepicker({
                    format: 'YYYY-MM-DD'
                });



                $('#datepicker-report-issued').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-stamp-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-issued-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-stamp').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-expiry').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-report-expiry-edit').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#report_expiry_date').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#edit-datepicker-from').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#edit-datepicker-to').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-to').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-completed-on').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#edit-datepicker-completed-on').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#license-issue-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#license-expiry-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#edit-license-expiry-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#edit-license-issue-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('.demand-issue-date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                $('.demand-status-applied').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#status_applied_date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#edit_status_applied_dates').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#issued_date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            $('#datepicker-pcc-stamp-edit').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            <?php }
            else{?>
                $("#license-issue-datepicker").on("dp.change", function (e) {
                    $('#license-expiry-datepicker').data("DateTimePicker").minDate(e.date);
                });
                $("#edit-license-issue-datepicker").on("dp.change", function (e) {
                    $('#edit-license-expiry-datepicker').data("DateTimePicker").minDate(e.date);
                });
                $('#datepicker-report-stamp-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-issued-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $("#datepicker-report-issued-edit").on("dp.change", function (e) {
                    $('#datepicker-report-expiry-edit').data("DateTimePicker").minDate(e.date);
                });
                $("#datepicker-report-issued").on("dp.change", function (e) {
                    $('#datepicker-report-expiry').data("DateTimePicker").minDate(e.date);
                });
                $("#report_issued_date").on("dp.change", function (e) {
                    $('#report_expiry_date').data("DateTimePicker").minDate(e.date);
                });

                $("#datepicker-pcc-issued").on("dp.change", function (e) {
                    $('#datepicker-pcc-expiry').data("DateTimePicker").minDate(e.date);
                });
                $("#datepicker-pcc-issued-edit").on("dp.change", function (e) {
                    $('#datepicker-pcc-expiry-edit').data("DateTimePicker").minDate(e.date);
                });
                $('#datepicker-from').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-pcc-stamp-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-pcc-issued-edit').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#report_expiry_date').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });

                $('#datepicker-pcc-expiry-edit').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-pcc-issued').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-pcc-expiry').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-pcc-stamp').datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                $('#datepicker-to').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            $('#datepicker-report-expiry-edit').datetimepicker({
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
                $('#edit-datepicker-from').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-to').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-issued').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-stamp').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#datepicker-report-expiry').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#datepicker-completed-on').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#edit-datepicker-completed-on').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#license-issue-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#license-expiry-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#edit-license-expiry-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD',
                    useCurrent: false
                });
                $('#edit-license-issue-datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('.demand-issue-date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('.demand-status-applied').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#status_applied_date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#edit_status_applied_dates').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
                $('#issued_date').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            <?php }?>
        });

        //ajax requests
        $(document).on('change','.demand-company-name', function (e) {
            e.preventDefault();
            var demand_id = $(this).children("option:selected").val();

            url = "{{route('candidate-info.getdemandcategory')}}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "POST",
                cache: false,
                data:{
                    demand_id: demand_id,
                },
                success: function(dataResult){
                    var options = '<option selected disabled>Select Job Category</option>';
                    $.each( dataResult.response, function(key, value) {
                        options += '<option value="'+key+'">'+value+'</option>';
                    });
                    $('#job_to_demand_id').html(options);
                    $('.demand-issue-date').attr('value',dataResult.demand.issued_date);
                    $('.demand-number-pax').attr('value',dataResult.demand.num_of_pax);

                },
                error: function() {
                    swal({
                        title: 'Demand details Info',
                        text: "Error. Could not confirm the status of the Job category.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        });

        $(document).on('change','.update-demand-company-name', function (e) {
            e.preventDefault();
            var demand_id = $(this).children("option:selected").val();
            url = "{{route('candidate-info.getdemandcategory')}}";
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: url,
                type: "POST",
                cache: false,
                data:{
                    demand_id: demand_id,
                },
                success: function(dataResult){
                    var options = '<option selected disabled>Select Job Category</option>';
                    $.each( dataResult.response, function(key, value) {
                        options += '<option value="'+key+'">'+value+'</option>';
                    });
                    $('#update_job_to_demand_id').html(options);
                    $('#issued_date').attr('value',dataResult.demand.issued_date);
                    $('#num_of_pax').attr('value',dataResult.demand.num_of_pax);

                },
                error: function() {
                    swal({
                        title: 'Demand details Info',
                        text: "Error. Could not confirm the status of the Job category.",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true,
                    });
                }
            });
        });
        //ajax requests

        //profesionals
        $(document).on('click','.action-professional-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_candidate_name').text(candidatename);
                    console.log(dataResult);
                    if(dataResult.show.job_ref_no !== null){
                        $('#view_job_ref_no').text(dataResult.show.job_ref_no);
                    }else{
                        $('#view_job_ref_no').text("N/A");
                    }

                    if(dataResult.show.company_name !== null){
                        $('#view_company_name').text(dataResult.show.company_name);
                    }else{
                        $('#view_company_name').text("N/A");
                    }

                    if(dataResult.show.address !== null){
                        $('#view_address').text(dataResult.show.address);
                    }else{
                        $('#view_address').text("N/A");
                    }


                    $('#view_country').text(dataResult.country);

                    if(dataResult.show.category_of_job !== null){
                        $('#view_category_of_job').text(dataResult.show.category_of_job);
                    }else{
                        $('#view_category_of_job').text('N/A');
                    }
                    if(dataResult.show.designation !== null){
                        $('#view_designation').text(dataResult.show.designation);
                    }else{
                        $('#view_designation').text('N/A');
                    }
                    if(dataResult.show.duration !== null){
                        $('#view_duration').text(dataResult.show.duration);
                    }else{
                        $('#view_duration').text('N/A');
                    }
                    if(dataResult.from !== null){
                        $('#view_from').text(dataResult.from);
                    }else{
                        $('#view_from').text('N/A');
                    }
                    if(dataResult.to !== null){
                        $('#view_to').text(dataResult.to);
                    }else{
                        $('#view_to').text('N/A');
                    }

                    if(dataResult.show.document != null){
                        var photograph = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/professional/' + dataResult.show.document + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/professional/' + dataResult.show.document + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_image').html(photograph);
                    }
                    else{
                        $('#view_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-professional-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            console.log(action);
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_professional_info").modal("toggle");
                    if(dataResult.edit.job_ref_no !== null){
                        $('#job_ref_no').attr('value',dataResult.edit.job_ref_no);
                    }

                    if(dataResult.edit.company_name !== null){
                        $('#company_name').attr('value',dataResult.edit.company_name);
                    }

                    if(dataResult.edit.address !== null){
                        $('#address').attr('value',dataResult.edit.address);
                    }
                    $('#select2-country-container').text(dataResult.countryname);
                    $('#country option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                    if(dataResult.edit.category_of_job !== null){
                        $('#category_of_job').attr('value',dataResult.edit.category_of_job);
                    }
                    if(dataResult.edit.designation !== null){
                        $('#designation').attr('value',dataResult.edit.designation);
                    }
                    var duration = dataResult.edit.duration;
                    if(duration !== null){
                        $('#duration_professional_edit').attr('value',duration);
                    }
                    if(dataResult.edit.from !== null){
                        $('.update-from').attr('value',dataResult.edit.from);
                    }
                    if(dataResult.edit.to !== null){
                        $('.update-to').attr('value',dataResult.edit.to);
                    }

                    $('.updatecandidateprofessional').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });

        $(document).on('click','.action-professional-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });


        //trainings
        $(document).on('click','.action-training-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_training_candidate_name').text(candidatename);

                    if(dataResult.showtraining.certificate_no !== null){
                        $('#view_training_certificate_no').text(dataResult.showtraining.certificate_no);
                    }else{
                        $('#view_training_certificate_no').text("N/A");
                    }

                    if(dataResult.showtraining.training_type !== null){
                        $('#view_training_training_type').text(dataResult.showtraining.training_type);
                    }else{
                        $('#view_training_training_type').text("N/A");
                    }

                    $('#view_training_institute_name').text(dataResult.showtraining.institute_name);
                    $('#view_training_country').text(dataResult.country);
                    $('#view_training_duration').text(dataResult.showtraining.duration);
                    if(dataResult.showtraining.certificate != null){
                        var photograph = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/professional/' + dataResult.showtraining.certificate + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/professional/' + dataResult.showtraining.certificate + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_certificate').html(photograph);
                    }
                    else{
                        $('#view_certificate').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-training-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_professional_training").modal("toggle");
                    if(dataResult.edit.certificate_no !== null){
                        $('#certificate_no').attr('value',dataResult.edit.certificate_no);
                    }

                    if(dataResult.edit.training_type !== null){
                        $('#training_type').attr('value',dataResult.edit.training_type);
                    }

                    $('#institute_name').attr('value',dataResult.edit.institute_name);
                    $('#select2-training_country-container').text(dataResult.countries);
                    $('#training_country option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                    $('#training_duration').attr('value',dataResult.edit.duration);
                    $('.updatecandidatetraining').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });

        $(document).on('click','.action-training-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Training Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //qualifications
        $(document).on('click','.action-qualification-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_qualification_candidate_name').text(candidatename);
                    $('#view_qualification_school_college_name').text(dataResult.show.school_college_name);
                    $('#view_qualification_academic_level').text(dataResult.show.academic_level);
                    $('#view_qualification_address').text(dataResult.show.address);
                    $('#view_qualification_completed_on').text(dataResult.completed_on);
                    $('#view_qualification_division').text(dataResult.division);
                    $('#view_qualification_result').text(dataResult.show.result);
                    if(dataResult.show.document != null){
                        var photograph = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/professional/' + dataResult.show.document + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/professional/' + dataResult.show.document + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_qualification_image').html(photograph);
                    }
                    else{
                        $('#view_qualification_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-qualification-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_qualifications").modal("toggle");
                    $('#school_college_name').attr('value',dataResult.edit.school_college_name);
                    $('#academic_level option[value="'+dataResult.edit.academic_level+'"]').prop('selected', true);
                    $('#qualification_address').attr('value',dataResult.edit.address);
                    $('.completed-on').attr('value',dataResult.edit.completed_on);
                    $('#division option[value="'+dataResult.edit.division+'"]').prop('selected', true);
                    $('#result option[value="'+dataResult.edit.result+'"]').prop('selected', true);
                    $('.updatecandidatequalification').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });

        $(document).on('click','.action-qualification-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Qualification Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //languages
        $(document).on('click','.action-language-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_language").modal("toggle");
                    $('#language option[value="'+dataResult.edit.language+'"]').prop('selected', true);
                    $('#speaking option[value="'+dataResult.edit.speaking+'"]').prop('selected', true);
                    $('#reading option[value="'+dataResult.edit.reading+'"]').prop('selected', true);
                    $('#writing option[value="'+dataResult.edit.writing+'"]').prop('selected', true);
                    $('.updatecandidatelanguage').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });

        $(document).on('click','.action-language-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Language Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //document
        $(document).on('click','.action-document-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_document_candidate_name').text(candidatename);
                    $('#view_document_resume').text(dataResult.show.resume);
                    $('#view_document_original_passport').text(dataResult.show.original_passport);
                    $('#view_document_passport_xerox_copy').text(dataResult.show.passport_xerox_copy);
                    $('#view_document_academic_certificates').text(dataResult.show.academic_certificates);
                    $('#view_original_academic_certificates').text(dataResult.show.original_academic);
                    $('#view_document_professional_training').text(dataResult.show.professional_training);
                    $('#view_document_work_certificates').text(dataResult.show.work_certificates);
                    $('#view_document_medical_reports').text(dataResult.show.medical_reports);
                    $('#view_document_original_driving_license').text(dataResult.show.original_driving_license);
                    $('#view_document_driving_license_copy').text(dataResult.show.driving_license_copy);
                    $('#view_document_photographs').text(dataResult.show.photographs);

                    if(dataResult.show.photograph_image != null){
                        var photograph = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/document/' + dataResult.show.photograph_image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/document/' + dataResult.show.photograph_image + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_document_photograph_image').html(photograph);
                    }
                    else{
                        $('#view_document_photograph_image').text("N/A");
                    }
                    if(dataResult.show.passport_image != null) {
                        var passport = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/document/' + dataResult.show.passport_image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/document/' + dataResult.show.passport_image + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_document_passport_image').html(passport);
                    }else{
                        $('#view_document_passport_image').text("N/A");
                    }
                    if(dataResult.show.signature_image != null) {
                        var signature = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/document/' + dataResult.show.signature_image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/document/' + dataResult.show.signature_image + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_document_signature_image').html(signature);
                    }else{
                        $('#view_document_signature_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.astction-document-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_document").modal("toggle");
                    $('#resume option[value="'+dataResult.edit.resume+'"]').prop('selected', true);
                    $('#original_passport option[value="'+dataResult.edit.original_passport+'"]').prop('selected', true);
                    $('#passport_xerox_copy option[value="'+dataResult.edit.passport_xerox_copy+'"]').prop('selected', true);
                    $('#academic_certificates option[value="'+dataResult.edit.academic_certificates+'"]').prop('selected', true);
                    $('#original_academic option[value="'+dataResult.edit.original_academic+'"]').prop('selected', true);
                    $('#professional_training option[value="'+dataResult.edit.professional_training+'"]').prop('selected', true);
                    $('#work_certificates option[value="'+dataResult.edit.work_certificates+'"]').prop('selected', true);
                    $('#medical_reports option[value="'+dataResult.edit.medical_reports+'"]').prop('selected', true);
                    $('#original_driving_license option[value="'+dataResult.edit.original_driving_license+'"]').prop('selected', true);
                    $('#driving_license_copy option[value="'+dataResult.edit.driving_license_copy+'"]').prop('selected', true);
                    $('#photographs option[value="'+dataResult.edit.photographs+'"]').prop('selected', true);
                    $('.updatecandidatedocument').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");

                    }
                }
            });
        });

        $(document).on('click','.action-document-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Document Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //bank
        $(document).on('click','.action-bank-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_bank_candidate_name').text(candidatename);
                    $('#view_bank_bank_details').text(dataResult.show.bank_details);
                    $('#view_bank_bank_remarks').text(dataResult.show.bank_remarks);
                    if(dataResult.show.cheque_image != null) {
                        var cheque = '<a class="thumbnailbank-order" href="#thumbbank">' +
                            '<img src="/images/bank/' + dataResult.show.cheque_image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/bank/' + dataResult.show.cheque_image + '" style="height:12rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_bank_cheque_image').html(cheque);
                    }else{
                        $('#view_bank_cheque_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-bank-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_bank").modal("toggle");
                    $('#bank_details').text(dataResult.edit.bank_details);
                    $('#bank_remarks').text(dataResult.edit.bank_remarks);
                    $('.updatecandidatebank').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-bank-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Bank Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //license
        $(document).on('click','.action-license-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_license_candidate_name').text(candidatename);
                    $('#view_license_license_no').text(dataResult.show.license_no);
                    $('#view_license_license_type').text(dataResult.show.license_type);
                    $('#view_license_issued_date').text(dataResult.issued_date);
                    $('#view_license_expirary_date').text(dataResult.expirary_date);
                    $('#view_license_country').text(dataResult.country);
                    $('#view_license_remarks').text(dataResult.show.remarks);
                    if(dataResult.show.image != null) {
                        var image = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/license/' + dataResult.show.image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/license/' + dataResult.show.image + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_license_image').html(image);
                    }else{
                        $('#view_license_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-license-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_license").modal("toggle");
                    $('#license_no').attr('value',dataResult.edit.license_no);
                    $('#license_type').attr('value',dataResult.edit.license_type);
                    $('#license_country option[value="'+dataResult.edit.country+'"]').prop('selected', true);
                    $('.edit-lis-issued-date').attr('value',dataResult.edit.issued_date);
                    $('.edit-lis-expirary-date').attr('value',dataResult.edit.expirary_date);
                    $('#license-remarks').text(dataResult.edit.remarks);
                    $('.updatecandidatelicense').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-license-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "License Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //police report
        $(document).on('click','.action-police-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_license_candidate_name').text(candidatename);
                    $('#view_police_issued').text(dataResult.issued);
                    $('#view_police_stamping').text(dataResult.stamp);
                    $('#view_police_expiry').text(dataResult.expiry);
                    $('#view_police_registration').text(dataResult.show.registration_number);
                    if(dataResult.show.image != null) {
                        var image = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/document/' + dataResult.show.image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/document/' + dataResult.show.image + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_police_image').html(image);
                    }else{
                        $('#view_police_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-police-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    $("#edit_police_report_entry").modal("toggle");
                    $('#datepicker-report-issued-edit').attr('value',dataResult.edit.issued);
                    $('#datepicker-report-stamp-edit').attr('value',dataResult.edit.stamping_date);
                    $('.regis-edit').attr('value',dataResult.edit.registration_number);
                    $('.report-expiry-date').attr('value',dataResult.edit.expiry_date);
                    $('.updatepolicereportss').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-police-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Police Report Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //PCC report
        $(document).on('click','.action-pcc-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_license_candidate_name').text(candidatename);
                    $('#view_pcc_country').text(dataResult.country);
                    $('#view_pcc_issued').text(dataResult.issued);
                    $('#view_pcc_stamping').text(dataResult.stamp);
                    $('#view_pcc_expiry').text(dataResult.expiry);
                    $('#view_pcc_registration').text(dataResult.show.registration_number);
                    if(dataResult.show.image != null) {
                        var image = '<a class="thumbnail-order" href="#thumb">' +
                            '<img src="/images/document/' + dataResult.show.image + '" style="height:5rem;" alt=""/>' +
                            '<span><img src="/images/document/' + dataResult.show.image + '" style="height:18rem;" /><br />' +
                            '</span>' +
                            '</a>';
                        $('#view_pcc_image').html(image);
                    }else{
                        $('#view_pcc_image').text("N/A");
                    }
                }
            });
        });

        $(document).on('click','.action-pcc-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    $("#edit_pcc_entry").modal("toggle");
                    $('#pcc-country-edit option[value="'+dataResult.edit.country+'"]').prop('selected', true);

                    $('#datepicker-pcc-issued-edit').attr('value',dataResult.edit.issued);
                    $('#datepicker-pcc-stamp-edit').attr('value',dataResult.edit.stamping_date);
                    $('#registration_number_pcc').attr('value',dataResult.edit.registration_number);
                    $('#datepicker-pcc-expiry-edit').attr('value',dataResult.edit.expiry_date);
                    $('.updatepccreportss').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-pcc-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "PCC Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });

        //demand info
        $(document).on('click','.action-demand-job-view', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('hrm-view-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    var candidatename = "<?php echo $candidate_personal->candidate_firstname." ".$candidate_personal->candidate_middlename." ".$candidate_personal->candidate_lastname ?>";
                    $('#view_demandentry_candidate_name').text(candidatename);
                    $('#view_demandentry_skills').text(dataResult.show.skills);
                    $('#view_demandentry_job_category_id').text(dataResult.job_category);
                    $('#view_demandentry_salary').text(dataResult.show.salary);
                    var demand_id = dataResult.show.demand_info_id;
                    if(demand_id !== null){
                        $('#view_demandentry_demand_info_id').text(dataResult.company_name);
                        $('#view_demandentry_job_to_demand_id').text(dataResult.assigned_category.job_category.name);
                        $('#view_demandentry_issued_date').text(dataResult.issued_date);
                        $('#view_demandentry_status_applied_date').text(dataResult.status_applied_date);
                        $('#view_demandentry_num_of_pax').text(dataResult.show.num_of_pax);
                        $('#view_demandentry_overseas_agent_id').text(dataResult.agent_name);
                        $('#view_demandentry_sub_status').text(dataResult.sub_status);
                        $('#view_demandentry_remarks').text(dataResult.show.remarks);
                    }else{
                        $('#view_demandentry_demand_info_id').text("Not Set");
                        $('#view_demandentry_job_to_demand_id').text("Not Set");
                        $('#view_demandentry_issued_date').text("Not Set");
                        $('#view_demandentry_status_applied_date').text("Not Set");
                        $('#view_demandentry_num_of_pax').text("Not Set");
                        $('#view_demandentry_overseas_agent_id').text("Not Set");
                        $('#view_demandentry_sub_status').text("Not Set");
                        $('#view_demandentry_remarks').text("Not Set");
                    }
                }
            });
        });

        $(document).on('click','.action-demand-job-edit', function (e) {
            e.preventDefault();
            var url =  $(this).attr('hrm-edit-action');
            var id=$(this).attr('id');
            var action = $(this).attr('hrm-update-action');
            $.ajax({
                url: $(this).attr('hrm-edit-action'),
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    $("#edit_candidate_demandentry").modal("toggle");
                    $('#skills').text(dataResult.edit.skills);
                    $('#job_category_id option[value="'+dataResult.edit.job_category_id+'"]').prop('selected', true);
                    $('#salary').attr('value',dataResult.edit.salary);
                    var demand_id = dataResult.edit.demand_info_id;
                    if(demand_id !== null){
                        $('.update-enable-demand-entry').prop("checked", true);
                        checkedTrue();
                        $('.update-demand-company-name option[value="'+dataResult.edit.demand_info_id+'"]').prop('selected', true);
                        var options = '<option disabled>Select Job Category</option>';
                        $.each( dataResult.response, function(key, value) {
                            options += '<option value="'+key+'">'+value+'</option>';
                        });
                        $('#receivable_salary').attr('value',dataResult.edit.receivable_salary);

                        $('#update_job_to_demand_id').html(options);
                        $('#update_job_to_demand_id option[value="'+dataResult.edit.job_to_demand_id+'"]').prop('selected', true);
                        $('#issued_date').attr('value',dataResult.edit.issued_date);
                        $('#edit_status_applied_dates').attr('value',dataResult.edit.status_applied_date);
                        $('#num_of_pax').attr('value',dataResult.edit.num_of_pax);
                        $('#reference_amount').attr('value',dataResult.edit.personal_info.reference_amount);
                        $('#sub_status option[value="'+dataResult.edit.sub_status_id+'"]').prop('selected', true);
                        $('#remarks').text(dataResult.edit.remarks);
                        $('#overseas_agent_id option[value="'+dataResult.edit.overseas_agent_id+'"]').prop('selected', true);
                    }
                    $('.updatecandidatedemandentry').attr('action',action);
                },
                error: function(error){
                    if(error.statusText="Forbidden"){
                        $("#error-forbidden").modal("toggle");
                    }
                }
            });
        });

        $(document).on('click','.action-demand-job-delete', function (e) {
            e.preventDefault();
            var form = $('#deleted-form');
            var action = $(this).attr('hrm-delete-action');
            form.attr('action',$(this).attr('hrm-delete-action'));
            $url = form.attr('action');
            var form_data = form.serialize();
            // $('.deleterole').attr('action',action);
            swal({
                title: "Are You Sure?",
                text: "This item will be removed permanently.",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function(){
                $.post( $url, form_data)
                    .done(function(response) {
                        if(response == 'success'){
                            swal("Removed!", "Demand Job Details permanently Removed.", "success");
                            $(response).remove();
                            window.location.reload();
                        }else{
                            swal({
                                title: "ERROR - 403",
                                text: "Something went wrong! Could not remove the details",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    })
                    .fail(function(response){
                        if(response.statusText="Forbidden"){
                            swal({
                                title: "Forbidden Error - 403",
                                text: "You do not have permission to execute !",
                                type: "error",
                                showCancelButton: true,
                                closeOnConfirm: false,
                            }, function(){
                                swal.close();
                            })
                        }
                    });
            });
        });


    </script>

@endsection
