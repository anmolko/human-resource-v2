
        <link rel="stylesheet" href="{{asset('/backend/assets/two.css')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

        <div class="row align-items-center report-groups">
            <div class="col">
            </div>
            <div class="col-auto float-right ml-auto">
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-white" id="generate-pdf">PDF</button>
                    <button class="btn btn-white" onclick="printerDiv('drag')"><i class="fa fa-print fa-lg"></i> Print</button>
                </div>
            </div>
        </div>
       
        <div class="row" id="drag">
            <div class="col-md-12">

                <div class="grid-container" id="pdf-container">
                    <div class="zone-1">
                        <div class="toCenter">
                                @if(count($candidate_personal->documentInfo) == 0)
                                    <div class="profile" style="background-image: url('{{asset('/images/profiles/others.png')}}')"></div>

                                @else
                                    <div class="profile" style="background-image: url('{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}')"></div>

                                @endif
                        </div>
                        <div class="contact-box">
                            <div class="title">
                                <h2>Contact</h2>
                            </div>
                            @if(@$candidate_personal->mobile_no)
                            <div class="call">
                                <div class="text">{{@$candidate_personal->mobile_no}}</div>
                            </div>
                            @endif
                            @if(@$candidate_personal->contact_no)
                            <div class="call">
                                <div class="text">{{@$candidate_personal->contact_no}}</div>
                            </div>
                            @endif

                            <div class="email">
                                <div class="text">{{@$candidate_personal->email_address}}</div>
                            </div>
                        </div>
                    
                    
                    </div>
                
                    <div class="zone-2">
                        <div class="headTitle">
                            <h1 class="cv-name">{{$name}}</h1>
                        </div>
                        <div class="subTitle">
                            <h4>DOB: {{@$candidate_personal->date_of_birth}}<h4>
                        </div>
                        <div class="subTitle">
                            <h4>Passport No: {{@$candidate_personal->passport_no}}<h4>
                        </div>
                        @if(@$candidate_personal->cvInfo->profile)

                        <div class="group-1">
                            <div class="title">
                                <div class="box">
                                    <h2>About Me</h2>
                                </div>
                            </div>
                            <div class="desc">{{@$candidate_personal->cvInfo->profile}}</div>
                        </div>
                        @endif
                        <div class="group-2">
                            <div class="title">
                                <div class="box">
                                    <h2>Personal Details</h2>
                                </div>
                            </div>
                           
                                <div class="item personal-list">
                                    <div class="contactIcon">Permanent Address: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->permanent_address}}</div>
                                </div>
                                <div class="item">
                                    <div class="contactIcon">Father's Name: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->father_name}}</div>
                                </div>
                                <div class="item">
                                    <div class="contactIcon">Gender: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->gender}}</div>
                                </div>

                                <div class="item">
                                    <div class="contactIcon">Marital Status: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->martial_status}}</div>
                                </div>

                                <div class="item">
                                    <div class="contactIcon">Religion: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->religion}}</div>
                                </div>

                                <div class="item">
                                    <div class="contactIcon">Nationality: </div>
                                    <div class="contactInfo personal-detail">{{@$candidate_personal->nationality}}</div>
                                </div>

                                @if(@$languages)
                                <div class="item">
                                    <div class="contactIcon">Language: </div>
                                    <div class="contactInfo personal-detail">{{implode(", ", $languages)}}</div>
                                </div>
                                @endif
                        </div>

                        @if(count($candidate_personal->qualificationInfo)>0)

                        <div class="group-2">
                            <div class="title">
                                <div class="box">
                                    <h2>Education</h2>
                                </div>
                            </div>
                            <div class="desc">
                            @foreach($candidate_personal->qualificationInfo as $q)

                                <ul>
                                    <li>
                                        <div class="msg-1">Completed on {{date('M j, Y',strtotime(@$q->completed_on))}}  | {{ucwords(str_replace('-',' ',$q->academic_level))}}</div>
                                        <div class="msg-2">{{ucwords($q->school_college_name)}}</div>
                                    </li>
                                </ul>
                                @endforeach
                                
                            </div>
                        </div>

                        @endif
                        @if(count($candidate_personal->professionalInfo)>0)

                        <div class="group-3">
                            <div class="title">
                                <div class="box">
                                    <h2>Work Experience</h2>
                                </div>
                            </div>
                            <div class="desc">
                            @foreach($candidate_personal->professionalInfo as $p)

                                <ul>
                                    <li>
                                        <div class="msg-1">{{date('M j, Y',strtotime(@$p->from))}} - {{date('M j, Y',strtotime(@$p->to))}} | {{ucwords($p->category_of_job)}}</div>
                                        <div class="msg-2">{{ucwords($p->company_name)}}</div>
                                        <div class="msg-3"> @foreach($countries as $value=>$c)
                                                                @if($value == $p->country)
                                                                    {{$c}}
                                                                @endif
                                                            @endforeach</div>
                                    </li>
                                </ul>
                                @endforeach
                               
                            </div>
                        </div>
                        @endif

                        @if(@$candidate_personal->cvInfo->skill)

                        <div class="group-3">
                            <div class="title">
                                <div class="box">
                                    <h2>Skills</h2>
                                </div>
                            </div>
                            <div class=" skill-list">
                            {!! @$candidate_personal->cvInfo->skill !!}
                            
                            </div>
                        </div>
                        @endif

                        @if(@$candidate_personal->cvInfo->duty)

                        <div class="group-3">
                            <div class="title">
                                <div class="box">
                                    <h2>Responsibilities</h2>
                                </div>
                            </div>
                            <div class=" skill-list">
                            {!! @$candidate_personal->cvInfo->duty !!}
                            
                            </div>
                        </div>
                        @endif


                        @if(@$candidate_personal->cvInfo->declaration)

                            <div class="group-3">
                                <div class="title">
                                    <div class="box">
                                        <h2>Declaration</h2>
                                    </div>
                                </div>
                                <div class="declaration">
                                {{ @$candidate_personal->cvInfo->declaration }}

                                </div>
                            </div>
                            @endif

                    </div>
                        
                </div>

            </div>
        </div>

