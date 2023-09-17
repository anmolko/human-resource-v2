@extends('layouts.master')
@section('title') {{@$candidate_personal->candidate_firstname}} @endsection
@section('css')
    <style>
        .personal-info li .title {
            color: #4f4f4f;
            float: left;
            font-weight: 500;
            margin-right: 30px;
            width: 28%;
        }
        .dash-widget-info{
          text-align: left;
        }
        #v-pills-tabContent {
            padding-top: 0;
        }
        .card-file-thumb img {
            object-fit: contain;
            height: 200px;
            width: 200px;
        }

        .card-file-thumb {
            align-items: center;
            background-color: #f5f5f5;
            color: #777;
            display: flex;
            font-size: 48px;
            height: 200px;
            justify-content: center;
        }
    </style>


@endsection
@section('content')

    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Individual Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('candidate')}}">Candidate Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('candidate-personal-info.index')}}">Candidate Entry</a></li>

                        <li class="breadcrumb-item active">{{@$candidate_personal->candidate_firstname}} </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="card-group m-b-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Candidate Status</span>
                                </div>

                            </div>
                            <h3 class="mb-3">
                            {{ ($candidate_personal->status !== null) ? ucwords(str_replace("-"," ",$candidate_personal->status)):"Not Assigned" }}
                            </h3>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Passport Expire  Date</span>
                                </div>

                            </div>
                            <h3 class="mb-3">{{\Carbon\Carbon::parse(@$candidate_personal->expiry_date)->isoFormat('MMM Do, YYYY')}}</h3>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Applied Company</span>
                                </div>

                            </div>
                            <h3 class="mb-3">{{(@$demand_job_info->demand_info_id === null) ? "Not set": ucfirst(\App\Models\DemandInformation::find(@$demand_job_info->demand_info_id)->company_name)}}</h3>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="d-block">Police Expire Date</span>
                                </div>

                            </div>
                            @if( $police_info !== null )
                                <h3 class="mb-3">{{\Carbon\Carbon::parse($police_info->expiry_date)->isoFormat('MMM Do, YYYY')}}</h3>
                            @else
                            <h3 class="mb-3">Not Set </h3>
                            @endif
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <span>PCC Expire Date</span>
                            @if( $pcc_info !== null )
                                <h3 >{{\Carbon\Carbon::parse($pcc_info->expiry_date)->isoFormat('MMM Do, YYYY')}}</h3>
                            @else
                            <h3 >Not Set </h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <span>Medical Expiry Date</span>
                            @if( $medical_info !== null )
                                <h3 >{{\Carbon\Carbon::parse($medical_info->report_expiry_date)->isoFormat('MMM Do, YYYY')}}</h3>
                            @else
                            <h3 >Not Set </h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="card dash-widget">
                    <div class="card-body">
                        <div class="dash-widget-info">
                            <span>Applied Country </span>
                            <h3>
                            {{(@$demand_job_info->demand_info_id === null) ? "Not set": \App\Models\DemandInformation::find(@$demand_job_info->demand_info_id)->countryState->country}}
                            </h3>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card mb-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#">
                                        <img alt="{{@$candidate_personal->candidate_firstname}}" src="<?php if(!empty(@$candidate_personal->image)){ echo '/images/candidate_info/'.$candidate_personal->image; } else { if($candidate_personal->gender=="male") {echo '/images/profiles/male.png'; } elseif($candidate_personal->gender=="female") {echo '/images/profiles/female.png'; } elseif($candidate_personal->gender=="others") {echo '/images/profiles/others.png'; } } ?>" />
                                    </a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0 mb-0">{{@$candidate_personal->candidate_firstname}} {{$candidate_personal->candidate_middlename}} {{$candidate_personal->candidate_lastname}}</h3>
                                            <h6 class="text-muted">Reg No : {{$candidate_personal->registration_no}}</h6>
                                            <small class="text-muted">Serial No : {{$candidate_personal->serial_no}}</small>
                                            <div class="staff-id">Passport No : {{$candidate_personal->passport_no}}</div>
                                            <div class="small doj text-muted">Date of Birth : {{\Carbon\Carbon::parse($candidate_personal->date_of_birth)->isoFormat('Do MMMM, YYYY')}}</div>
                                            <div class="small doj text-muted">Religion : {{ucwords(@$candidate_personal->religion)}}</div>
                                            <div class="small doj text-muted">Birth Place : {{ucwords(@$candidate_personal->birth_place)}}</div>

                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Reference Names:</div>
                                                <div class="text">{{$candidate_personal->referenceInfo ? $candidate_personal->referenceInfo->reference_name:'Direct Office'}}
                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Applied Job:</div>
                                                <div class="text">
                                                {{(@$demand_job_info->job_to_demand_id === null) ? "Not set": \App\Models\JobtoDemand::find(@$demand_job_info->job_to_demand_id)->jobCategory->name}}
                                                </div>
                                            </li>


                                            <li>
                                                <div class="title">Email:</div>
                                                <div class="text"><a href="mailto:{{$candidate_personal->email_address}}">{{$candidate_personal->email_address}}</a></div>
                                            </li>
                                            <li>
                                                <div class="title">Address:</div>
                                                <div class="text">{{$candidate_personal->permanent_address}}</div>
                                            </li>

                                            <li>
                                                <div class="title">Mobile No:</div>
                                                <div class="text">{{$candidate_personal->mobile_no}}</div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card tab-box">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">

                        <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                        @if(count($professional_info)>0 || count($training_info)>0)
                        <li class="nav-item"><a href="#emp_professional" data-toggle="tab" class="nav-link ">Professional Experience|Training</a></li>
                        @endif

                        @if(count($language_info)>0 || count($qualification_info)>0)
                        <li class="nav-item"><a href="#emp_qualification" data-toggle="tab" class="nav-link ">Qualification | Language</a></li>
                        @endif
                        @if(@$demand_job_info !== null)
                        <li class="nav-item"><a href="#emp_demand" data-toggle="tab" class="nav-link ">Demand</a></li>
                        @endif
                        @if($medical_info !==null)

                        <li class="nav-item"><a href="#emp_medical" data-toggle="tab" class="nav-link ">Medical</a></li>
                        @endif

                        @if( $police_info !== null || $pcc_info !== null)
                        <li class="nav-item"><a href="#emp_police" data-toggle="tab" class="nav-link ">Police | PCC</a></li>
                        @endif

                        <li class="nav-item"><a href="#emp_amount" data-toggle="tab" class="nav-link ">Amount</a></li>
                        @if( $candidate_personal->status !== null)

                        <li class="nav-item"><a href="#emp_history" data-toggle="tab" class="nav-link ">History</a></li>
                        @endif

                        @if(count($files)>0 )

                        <li class="nav-item"><a href="#emp_file" data-toggle="tab" class="nav-link ">File</a></li>
                       @endif
                        <!-- <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Bank & Statutory <small class="text-danger">(Admin Only)</small></a></li> -->
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content">

            <!-- Profile Info Tab -->
            <div id="emp_profile" class="pro-overview tab-pane fade show active">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Personal Informations </h3>
                                <ul class="personal-info">
                                    <li>
                                        <div class="title">Passport Issued Date:</div>
                                        <div class="text">{{$candidate_personal->issued_date}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Passport Expiry Date:</div>
                                        <div class="text">{{$candidate_personal->expiry_date}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Candidate Type:</div>
                                        <div class="text"> {{ucwords($candidate_personal->candidate_type)}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Aboard Contact No:</div>
                                        <div class="text"> {{$candidate_personal->aboard_contact_no}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Receipt No:</div>
                                        <div class="text">{{$candidate_personal->receipt_no}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Age:</div>
                                        <div class="text">{{$candidate_personal->age}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Gender :</div>
                                        <div class="text"> {{ucwords($candidate_personal->gender)}}</div>
                                    </li>




                                <li>
                                        <div class="title">Martial Status:</div>
                                        <div class="text"> {{ucwords($candidate_personal->martial_status)}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Height:</div>
                                        <div class="text"> {{$candidate_personal->height}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Weight:</div>
                                        <div class="text"> {{$candidate_personal->weight}}</div>
                                    </li>


                                    <hr>
                                    <li>
                                        <div class="title">Next of Kin:</div>
                                        <div class="text"> {{$candidate_personal->next_of_kin}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Kin Relationship:</div>
                                        <div class="text"> {{ucwords($candidate_personal->kin_relationship)}}</div>
                                    </li>
                                    <li>
                                        <div class="title">Kin Contact No:</div>
                                        <div class="text"> {{$candidate_personal->kin_contact_no}}</div>
                                    </li>
                                    <hr>

                                    <li>
                                        <div class="title">Father Name:</div>
                                        <div class="text"> {{$candidate_personal->father_name}}</div>
                                    </li>
                                        <li>
                                        <div class="title">Father Contact No:</div>
                                        <div class="text"> {{$candidate_personal->father_contact_no}}</div>
                                    </li>
                                        <li>
                                        <div class="title">Mother Name:</div>
                                        <div class="text"> {{$candidate_personal->mother_name}}</div>
                                    </li>
                                    </li>
                                    <li>
                                        <div class="title">Mother Contact No:</div>
                                        <div class="text"> {{$candidate_personal->mother_contact_no}}</div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /Profile Info Tab -->

            <div id="emp_professional" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">
                        @if(count($professional_info)>0)

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Professional Experience </h3>
                                <ul class="personal-info">
                                        @foreach(@$professional_info as $professional)

                                        <li>
                                            <div class="title">Job Ref No:</div>
                                            <div class="text"> {{$professional->job_ref_no}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Company:</div>
                                            <div class="text"> {{$professional->company_name}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Job:</div>
                                            <div class="text"> {{$professional->category_of_job}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Duration:</div>
                                            <div class="text"> {{$professional->duration}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Designation:</div>
                                            <div class="text"> {{$professional->designation}}</div>
                                        </li>
                                        @endforeach

                                    <hr>
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if(count($training_info)>0)

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Professional Training </h3>
                                <ul class="personal-info">
                                        @foreach(@$training_info as $trainings)

                                        <li>
                                            <div class="title">Certificate no:</div>
                                            <div class="text"> {{ ($trainings->certificate_no !== null) ? $trainings->certificate_no:"Not Set" }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Type:</div>
                                            <div class="text"> {{ ($trainings->training_type !== null) ? $trainings->training_type:"Not Set" }}</div>
                                        </li>
                                        <li>
                                            <div class="title">Institute:</div>
                                            <div class="text"> {{$trainings->institute_name}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Country:</div>
                                            <div class="text">
                                                 @foreach($countries as $key => $value)
                                                    @if($key == $trainings->country)
                                                        {{$value}}
                                                    @endif
                                                @endforeach</div>
                                        </li>
                                        <li>
                                            <div class="title">Duration (in month):</div>
                                            <div class="text"> {{$trainings->duration}}</div>
                                        </li>
                                        @endforeach

                                    <hr>
                                </ul>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>

            </div>


            <div id="emp_qualification" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">
                    @if(count($qualification_info)>0)

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Qualification Info </h3>
                                <ul class="personal-info">
                                        @foreach(@$qualification_info as $qualification)

                                        <li>
                                            <div class="title">School/College name:</div>
                                            <div class="text"> {{ucfirst($qualification->school_college_name)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Academic Level:</div>
                                            <div class="text"> {{ucfirst(str_replace('-',' ',$qualification->academic_level))}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Address:</div>
                                            <div class="text"> {{ucfirst($qualification->address)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Completed On:</div>
                                            <div class="text"> {{\Carbon\Carbon::parse($qualification->completed_on)->isoFormat('MMMM Do, YYYY')}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Division:</div>
                                            <div class="text"> {{ucfirst(str_replace('-',' ',$qualification->division))}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Result:</div>
                                            <div class="text"> {{ucfirst($qualification->result)}} </div>
                                        </li>
                                        @endforeach

                                    <hr>
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if(count($language_info)>0)

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Language Info </h3>
                                <ul class="personal-info">
                                        @foreach(@$language_info as $language)

                                        <li>
                                            <div class="title">Language:</div>
                                            <div class="text"> {{ucfirst($language->language)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Speaking:</div>
                                            <div class="text">{{ucfirst($language->speaking)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Reading:</div>
                                            <div class="text"> {{ucfirst($language->reading)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Writing:</div>
                                            <div class="text">    {{ucfirst($language->writing)}}
                                                </div>
                                        </li>

                                        @endforeach

                                    <hr>
                                </ul>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>

            </div>

            <div id="emp_demand" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">
                    @if($demand_job_info !== null)

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Demand Info </h3>
                                <ul class="personal-info">

                                        <li>
                                            <div class="title">Actual Job Category:</div>
                                            <div class="text"> {{ucfirst(\App\Models\JobCategory::find($demand_job_info->job_category_id)->name)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Company Name:</div>
                                            <div class="text"> {{($demand_job_info->demand_info_id === null) ? "Not set": ucfirst(\App\Models\DemandInformation::find($demand_job_info->demand_info_id)->company_name)}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Issued date:</div>
                                            <div class="text"> {{($demand_job_info->issued_date === null) ? "Not set": \Carbon\Carbon::parse($demand_job_info->issued_date)->isoFormat('MMMM Do, YYYY')}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Applied date:</div>
                                            <div class="text"> {{($demand_job_info->issued_date === null) ? "Not set": \Carbon\Carbon::parse($demand_job_info->status_applied_date)->isoFormat('MMMM Do, YYYY')}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Agent Name:</div>
                                            <div class="text"> {{($demand_job_info->overseas_agent_id === null) ? "Not set": ucfirst(\App\Models\OverseasAgent::find($demand_job_info->overseas_agent_id)->fullname)}}</div>
                                        </li>

                                </ul>
                            </div>
                        </div>
                        @endif



                    </div>

                </div>

            </div>

            <div id="emp_medical" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">
                    @if($medical_info !== null)

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Medical Info </h3>
                                <ul class="personal-info">

                                        <li>
                                            <div class="title">Complexion:</div>
                                            <div class="text"> {{@$medical_info->complexion}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Company Name:</div>
                                            <div class="text">

                                            {{(@$medical_info->bloodgroup == "O-pos") ? "O+":""}}
                                                            {{(@$medical_info->bloodgroup == "O-neg") ? "O-":""}}
                                                           {{(@$medical_info->bloodgroup == "A-pos") ? "A+":""}}
                                                           {{(@$medical_info->bloodgroup == "A-neg") ? "A-":""}}
                                                           {{(@$medical_info->bloodgroup == "B-pos") ? "B+":""}}
                                                          {{(@$medical_info->bloodgroup == "B-neg") ? "B-":""}}
                                                            {{(@$medical_info->bloodgroup == "AB-pos") ? "AB+":""}}
                                                            {{(@$medical_info->bloodgroup == "AB-neg") ? "AB-":""}}

                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Height:</div>
                                            <div class="text"> {{@$medical_info->height}} Fts</div>
                                        </li>
                                        <li>
                                            <div class="title">Weight:</div>
                                            <div class="text">{{@$medical_info->weight}} Kgs </div>
                                        </li>
                                       <hr>
                                       <li>
                                            <div class="title">Medical Report Number:</div>
                                            <div class="text">{{@$medical_info->medical_report_number}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Medical Clinic Name:</div>
                                            <div class="text">
                                                @foreach($clinic_detail as $clinic)
                                                        {{(@$medical_info->health_clinic_id == $clinic->id ) ? ucwords($clinic->name):""}}
                                                @endforeach </div>
                                        </li>
                                        <li>
                                            <div class="title">Issued Date:</div>
                                            <div class="text">{{@$medical_info->report_issued_date}} </div>
                                        </li>
                                        <li>
                                            <div class="title">Expiry Date:</div>
                                            <div class="text">{{@$medical_info->report_expiry_date}} </div>
                                        </li>
                                        <li>
                                            <div class="title">Result:</div>
                                            <div class="text">
                                                {{(@$medical_info->result == "fail") ? "Fail":""}}
                                                  {{(@$medical_info->result == "pass") ? "Pass":""}} </div>
                                        </li>
                                        <li>
                                            <div class="title">Report:</div>
                                            <div class="text">{{@$medical_info->report}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Remarks:</div>
                                            <div class="text">{{@$medical_info->report_remarks}}  </div>
                                        </li>



                                </ul>
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
                        @endif



                    </div>

                </div>

            </div>

            <div id="emp_police" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">
                        @if($police_info !==null)

                            <div class="card profile-box ">
                                <div class="card-body">
                                    <h3 class="card-title">Police Info </h3>
                                    <ul class="personal-info">

                                            <li>
                                                <div class="title">Issued Date:</div>
                                                <div class="text"> {{\Carbon\Carbon::parse($police_info->issued)->isoFormat('MMMM Do, YYYY')}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Stamping date:</div>
                                                <div class="text">

                                                {{\Carbon\Carbon::parse($police_info->stamping_date)->isoFormat('MMMM Do, YYYY')}}

                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Registration Number:</div>
                                                <div class="text"> {{$police_info->registration_number}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Expiry Date:</div>
                                                <div class="text">{{\Carbon\Carbon::parse($police_info->expiry_date)->isoFormat('MMMM Do, YYYY')}} </div>
                                            </li>
                                        <hr>
                                        <div class="col-12 col-md-12 col-lg-9">
                                                @if(@$police_info->image !== null)
                                                    <label>Current Report Image:</label>
                                                    <div class="card">
                                                        <img src="{{asset('images/document/'.@$police_info->image)}}" class="card-img-top">
                                                    </div>
                                                @endif
                                            </div>



                                    </ul>

                                </div>
                            </div>
                        @endif


                        @if($pcc_info !==null)
                            <div class="card profile-box ">
                                <div class="card-body">
                                    <h3 class="card-title">PCC Info </h3>
                                    <ul class="personal-info">

                                            <li>
                                                <div class="title">Country:</div>
                                                <div class="text"> @foreach($countries as $key => $value)
                                                            @if($key == $pcc_info->country)
                                                                {{$value}}
                                                            @endif
                                                        @endforeach</div>
                                            </li>
                                            <li>
                                                <div class="title">Issued Date:</div>
                                                <div class="text">

                                                {{\Carbon\Carbon::parse($pcc_info->issued)->isoFormat('MMMM Do, YYYY')}}

                                                </div>
                                            </li>
                                            <li>
                                                <div class="title">Stamping date:</div>
                                                <div class="text"> {{\Carbon\Carbon::parse($pcc_info->stamping_date)->isoFormat('MMMM Do, YYYY')}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Registration Number:</div>
                                                <div class="text">{{$pcc_info->registration_number}} </div>
                                            </li>
                                            <li>
                                                <div class="title">Expiry Date:</div>
                                                <div class="text">{{\Carbon\Carbon::parse($pcc_info->expiry_date)->isoFormat('MMMM Do, YYYY')}} </div>
                                            </li>
                                        <hr>
                                        <div class="col-12 col-md-12 col-lg-9">
                                                @if(@$pcc_info->image !== null)
                                                    <label>Current Report Image:</label>
                                                    <div class="card">
                                                        <img src="{{asset('images/document/'.@$pcc_info->image)}}" class="card-img-top">
                                                    </div>
                                                @endif
                                            </div>



                                    </ul>

                                </div>
                            </div>
                        @endif

                    </div>

                </div>

            </div>

            <div id="emp_amount" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">Amount Info </h3>
                                <ul class="personal-info">

                                        <li>
                                            <div class="title">Document Processing Fee::</div>
                                            <div class="text">
                                                {{($candidate_personal->document_processing_fee === null) ? "Not set": "Rs ".number_format(@$candidate_personal->document_processing_fee)}}
                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Document Advance Fee:</div>
                                            <div class="text">
                                                {{($candidate_personal->advance_fee === null) ? "Not set": "Rs ".number_format(@$candidate_personal->advance_fee)}}

                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Medical Payment Amount:</div>
                                            <div class="text">
                                                {{(@$medical_info->payment_amount === null) ? "Not set": "Rs ".number_format(@$medical_info->payment_amount)}}

                                            </div>
                                        </li>
                                        <li>
                                            <div class="title">Job Category Amount(candidate) :</div>
                                            <div class="text">
                                                {{(@$demand_job_info->category_amount === null) ? "Not set": "Rs ".number_format(@$demand_job_info->category_amount)}}
                                            </div>
                                        </li>
                                       <hr>

                                        <li>
                                            <div class="title">Commision Amount(Overseas Agent):</div>
                                            <div class="text">
                                            {{(@$demand_job_info->commission_amount === null) ? "Not set": "Rs ".number_format(@$demand_job_info->commission_amount)}}
                                                 </div>
                                        </li>



                                </ul>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div id="emp_history" class="pro-overview tab-pane fade">
                <div class="row">
                    <div class="col-md-3 side-tab-sticky">
                        <!-- Tabs nav -->
                        <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link mb-3 p-3 shadow {{($candidate_personal->status == 'applied') ? 'active':'' }}" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                <i class="fa fa-user-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">Applied</span></a>

                            <a class="nav-link mb-3 p-3 shadow {{($candidate_personal->status == 'selected') ? 'active':'' }}" id="v-pills-selected-tab" data-toggle="pill" href="#v-pills-selected" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                <i class="fa fa-handshake-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">Selected</span></a>

                            <a class="nav-link mb-3 p-3 shadow {{($candidate_personal->status == 'under-process') ? 'active':'' }}" id="v-pills-under-tab" data-toggle="pill" href="#v-pills-under" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                <i class="fa fa-spinner mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">Under Process</span></a>

                            <a class="nav-link mb-3 p-3 shadow {{($candidate_personal->status == 'visa-received') ? 'active':'' }}" id="v-pills-visa-tab" data-toggle="pill" href="#v-pills-visa" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                <i class="fa fa-calendar-check-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">Visa Received</span></a>

                            <a class="nav-link mb-3 p-3 shadow {{($candidate_personal->status == 'ticket-received') ? 'active':'' }}" id="v-pills-ticket-tab" data-toggle="pill" href="#v-pills-ticket" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                <i class="fa fa-paper-plane-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">Ticked Received Details</span></a>

                            <a class="nav-link mb-3 p-3 shadow {{($candidate_personal->status == 'deployed') ? 'active':'' }}" id="v-pills-deployed-tab" data-toggle="pill" href="#v-pills-deployed" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                <i class="fa fa-hand-peace-o mr-2"></i>
                                <span class="font-weight-bold small text-uppercase">Deployed</span></a>


                        </div>
                    </div>

                    <div class="col-md-9 ">
                        <!-- Tabs content -->
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade shadow rounded bg-white {{($candidate_personal->status == 'applied') ? 'show active':'' }} p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                <h4 class="font-italic mb-4">Applied History</h4>
                                @if(count($applied_info)>0 )
                                    <div class="card profile-box ">
                                        <div class="card-body">

                                            <ul class="personal-info">

                                                @foreach(@$applied_info as $history)

                                                        <li>
                                                            <div class="title">Sub Status:</div>
                                                            <div class="text">
                                                            {{ucwords(\App\Models\SubStatus::find($history->sub_status_id)->name)}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Applied Date:</div>
                                                            <div class="text">
                                                                {{($history->status_applied_date === null) ? "Not set": \Carbon\Carbon::parse($history->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Remarks:</div>
                                                            <div class="text">
                                                                {{(@$history->remarks === null) ? "Not set": @$history->remarks}}

                                                            </div>
                                                        </li>
                                                    <hr>

                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                @else
                                    <h5>Not Set</h5>
                                @endif
                            </div>
                            <div class="tab-pane fade shadow rounded bg-white {{($candidate_personal->status == 'selected') ? 'show active':'' }} p-5" id="v-pills-selected" role="tabpanel" aria-labelledby="v-pills-selected-tab">
                                <h4 class="font-italic mb-4">Selected History</h4>
                                @if(count($selected_info)>0 )

                                    <div class="card profile-box ">
                                        <div class="card-body">

                                            <ul class="personal-info">

                                                @foreach(@$selected_info as $history)

                                                        <li>
                                                            <div class="title">Sub Status:</div>
                                                            <div class="text">
                                                            {{ucwords(\App\Models\SubStatus::find($history->sub_status_id)->name)}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Applied Date:</div>
                                                            <div class="text">
                                                                {{($history->status_applied_date === null) ? "Not set": \Carbon\Carbon::parse($history->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Remarks:</div>
                                                            <div class="text">
                                                                {{(@$history->remarks === null) ? "Not set": @$history->remarks}}

                                                            </div>
                                                        </li>
                                                    <hr>

                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                @else
                                    <h5>Not Set</h5>
                                @endif
                            </div>
                            <div class="tab-pane fade shadow rounded bg-white {{($candidate_personal->status == 'under-process') ? 'show active':'' }} p-5" id="v-pills-under" role="tabpanel" aria-labelledby="v-pills-under-tab">
                                <h4 class="font-italic mb-4">Under Process History</h4>
                                @if(count($under_info)>0 )
                                    <div class="card profile-box ">
                                        <div class="card-body">

                                            <ul class="personal-info">

                                                @foreach(@$under_info as $history)

                                                        <li>
                                                            <div class="title">Sub Status:</div>
                                                            <div class="text">
                                                            {{ucwords(\App\Models\SubStatus::find($history->sub_status_id)->name)}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Applied Date:</div>
                                                            <div class="text">
                                                                {{($history->status_applied_date === null) ? "Not set": \Carbon\Carbon::parse($history->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Remarks:</div>
                                                            <div class="text">
                                                                {{(@$history->remarks === null) ? "Not set": @$history->remarks}}

                                                            </div>
                                                        </li>
                                                    <hr>

                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                @else
                                    <h5>Not Set</h5>
                                @endif
                            </div>
                            <div class="tab-pane fade shadow rounded bg-white {{($candidate_personal->status == 'visa-received') ? 'show active':'' }} p-5" id="v-pills-visa" role="tabpanel" aria-labelledby="v-pills-visa-tab">
                                <h4 class="font-italic mb-4">Visa Received History</h4>
                                @if(count($visa_info)>0 )
                                    <div class="card profile-box ">
                                        <div class="card-body">

                                            <ul class="personal-info">

                                                @foreach(@$visa_info as $history)

                                                        <li>
                                                            <div class="title">Sub Status:</div>
                                                            <div class="text">
                                                            {{ucwords(\App\Models\SubStatus::find($history->sub_status_id)->name)}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Applied Date:</div>
                                                            <div class="text">
                                                                {{($history->status_applied_date === null) ? "Not set": \Carbon\Carbon::parse($history->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Remarks:</div>
                                                            <div class="text">
                                                                {{(@$history->remarks === null) ? "Not set": @$history->remarks}}

                                                            </div>
                                                        </li>
                                                    <hr>

                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                @else
                                    <h5>Not Set</h5>
                                @endif
                            </div>
                            <div class="tab-pane fade shadow rounded bg-white {{($candidate_personal->status == 'ticket-received') ? 'show active':'' }} p-5" id="v-pills-ticket" role="tabpanel" aria-labelledby="v-pills-ticket-tab">
                                <h4 class="font-italic mb-4">Ticket Received History</h4>
                                @if(count($ticket_info)>0 )
                                    <div class="card profile-box ">
                                        <div class="card-body">

                                            <ul class="personal-info">

                                                @foreach(@$ticket_info as $history)

                                                        <li>
                                                            <div class="title">Sub Status:</div>
                                                            <div class="text">
                                                            {{ucwords(\App\Models\SubStatus::find($history->sub_status_id)->name)}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Applied Date:</div>
                                                            <div class="text">
                                                                {{($history->status_applied_date === null) ? "Not set": \Carbon\Carbon::parse($history->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Remarks:</div>
                                                            <div class="text">
                                                                {{(@$history->remarks === null) ? "Not set": @$history->remarks}}

                                                            </div>
                                                        </li>
                                                    <hr>

                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                @else
                                    <h5>Not Set</h5>
                                @endif
                            </div>
                            <div class="tab-pane fade shadow rounded bg-white {{($candidate_personal->status == 'deployed') ? 'show active':'' }} p-5" id="v-pills-deployed" role="tabpanel" aria-labelledby="v-pills-deployed-tab">
                                <h4 class="font-italic mb-4">Deployed History</h4>
                                @if(count($deployed_info)>0 )
                                    <div class="card profile-box ">
                                        <div class="card-body">

                                            <ul class="personal-info">

                                                @foreach(@$deployed_info as $history)

                                                        <li>
                                                            <div class="title">Sub Status:</div>
                                                            <div class="text">
                                                            {{ucwords(\App\Models\SubStatus::find($history->sub_status_id)->name)}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Applied Date:</div>
                                                            <div class="text">
                                                                {{($history->status_applied_date === null) ? "Not set": \Carbon\Carbon::parse($history->status_applied_date)->isoFormat('MMMM Do, YYYY')}}
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="title">Remarks:</div>
                                                            <div class="text">
                                                                {{(@$history->remarks === null) ? "Not set": @$history->remarks}}

                                                            </div>
                                                        </li>
                                                    <hr>

                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                @else
                                    <h5>Not Set</h5>
                                @endif
                            </div>
                        </div>


                    </div>



                </div>
            </div>

            <div id="emp_file" class="pro-overview tab-pane fade ">
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="card profile-box ">
                            <div class="card-body">
                                <h3 class="card-title">File Details </h3>
                                    <div class="row row-sm">
                                        @if(count($files)>0 )

                                            @foreach($files as $file)

                                                <div class="col-6 col-sm-4 col-md-3 col-lg-4 col-xl-3">
                                                    <div class="card card-file">
                                                        <div class="dropdown-file">
                                                            <a class="dropdown-link" href="{{ route('file.download',$file->filename) }}" ><i class="fa fa-cloud-download m-r-5"></i> </a>

                                                        </div>
                                                        <div class="card-file-thumb">
                                                            <img alt="{{@$file->filename}}" src="{{ route('file.download',$file->filename) }}" />

                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- Bank Statutory Tab -->
            <!-- <div class="tab-pane fade" id="bank_statutory">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title"> Basic Salary Information</h3>
                        <form>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Salary basis <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select salary basis type</option>
                                            <option>Hourly</option>
                                            <option>Daily</option>
                                            <option>Weekly</option>
                                            <option>Monthly</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Salary amount <small class="text-muted">per month</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Type your salary amount" value="0.00">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Payment type</label>
                                        <select class="select">
                                            <option>Select payment type</option>
                                            <option>Bank transfer</option>
                                            <option>Check</option>
                                            <option>Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3 class="card-title"> PF Information</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">PF contribution</label>
                                        <select class="select">
                                            <option>Select PF contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">PF No. <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select PF contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee PF rate</label>
                                        <select class="select">
                                            <option>Select PF contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select additional rate</option>
                                            <option>0%</option>
                                            <option>1%</option>
                                            <option>2%</option>
                                            <option>3%</option>
                                            <option>4%</option>
                                            <option>5%</option>
                                            <option>6%</option>
                                            <option>7%</option>
                                            <option>8%</option>
                                            <option>9%</option>
                                            <option>10%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total rate</label>
                                        <input type="text" class="form-control" placeholder="N/A" value="11%">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee PF rate</label>
                                        <select class="select">
                                            <option>Select PF contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select additional rate</option>
                                            <option>0%</option>
                                            <option>1%</option>
                                            <option>2%</option>
                                            <option>3%</option>
                                            <option>4%</option>
                                            <option>5%</option>
                                            <option>6%</option>
                                            <option>7%</option>
                                            <option>8%</option>
                                            <option>9%</option>
                                            <option>10%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total rate</label>
                                        <input type="text" class="form-control" placeholder="N/A" value="11%">
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h3 class="card-title"> ESI Information</h3>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">ESI contribution</label>
                                        <select class="select">
                                            <option>Select ESI contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">ESI No. <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select ESI contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee ESI rate</label>
                                        <select class="select">
                                            <option>Select ESI contribution</option>
                                            <option>Yes</option>
                                            <option>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Additional rate <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select additional rate</option>
                                            <option>0%</option>
                                            <option>1%</option>
                                            <option>2%</option>
                                            <option>3%</option>
                                            <option>4%</option>
                                            <option>5%</option>
                                            <option>6%</option>
                                            <option>7%</option>
                                            <option>8%</option>
                                            <option>9%</option>
                                            <option>10%</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total rate</label>
                                        <input type="text" class="form-control" placeholder="N/A" value="11%">
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
            <!-- /Bank Statutory Tab -->

        </div>
    </div>
    <!-- /Page Content -->


@endsection
@section('js')

@endsection
