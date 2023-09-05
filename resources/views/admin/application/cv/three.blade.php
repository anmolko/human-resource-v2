
    <link rel="stylesheet" href="{{asset('/backend/assets/three.css')}}" />

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
       
             <div class="cv-container" id="pdf-container">
                <div class="left_Side">
                    <div class="profileText">
                        <div class="imgBx">
                                @if(count($candidate_personal->documentInfo) == 0)
                                    <img src="{{asset('/images/profiles/others.png')}}" class="photo"/>
                                @else
                                    <img src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}" class="photo" />
                                @endif
                        </div>
                        <br>
                        <h2 class="cv-name">{{$name}} </h2><h5><span>DOB: {{date('M j, Y',strtotime(@$candidate_personal->date_of_birth))}}</span> </h5>
                        <h6><span>Passport No: {{@$candidate_personal->passport_no}}</span> </h6>
                    </div>

                    <div class="contactInfo">
                        <h3 class="title">Contact Info</h3>
                        <ul>
                            <li>
                                <span class="text">{{@$candidate_personal->mobile_no}}</span>
                            </li>
                            <li>
                                <span class="text">{{@$candidate_personal->contact_no}}</span>
                            </li>
                            <li>
                                <span class="text">{{@$candidate_personal->email_address}}</span>
                            </li>
                            <li>
                                <span class="text">{{@$candidate_personal->permanent_address}}</span>
                            </li>
                            
                        </ul>
                    </div>
                    @if(count($candidate_personal->qualificationInfo)>0)

                    <div class="contactInfo education">
                        <h3 class="title">Education</h3>
                        <ul>
                            @foreach($candidate_personal->qualificationInfo as $q)

                            <li>
                                <h5>Graduate on {{date('Y',strtotime(@$q->completed_on))}}</h5>
                                <h4>{{ucwords(str_replace('-',' ',$q->academic_level))}}</h4>
                                <h4>{{ucwords($q->school_college_name)}}</h4>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    @endif

                    @if(count($candidate_personal->languageInfo)>0)

                    <div class="contactInfo language">
                        <h3 class="title">Languages</h3>
                        @foreach($candidate_personal->languageInfo as $lang)
                        <ul>
                            <li>
                                <span class="text">{{ucwords(@$lang->language)}}</span>
                                <span class="percent">
                                    <div data-language="{{@$lang->language}}"></div>
                                </span>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    @endif

                </div>
                <div class="right_Side">
                    @if(@$candidate_personal->cvInfo->profile)
                    <div class="about">
                        <h2 class="title2">Profile</h2>
                        <p>{{@$candidate_personal->cvInfo->profile}}</p>
                    </div>
                    @endif
                    <div class="about skills">
                        <h2 class="title2">Personal Details</h2>
                        <div class="box">
                            <h5>Father's Name:</h5>
                            <div class="text">
                                <p>{{@$candidate_personal->father_name}}</p>
                            </div>
                        </div>
                        <div class="box">
                            <h5>Gender:</h5>
                            <div class="text">
                                <p>{{@$candidate_personal->gender}}</p>
                            </div>
                        </div>
                        <div class="box">
                            <h5>Marital Status:</h5>
                            <div class="text">
                                <p>{{@$candidate_personal->martial_status}}</p>
                            </div>
                        </div>
                        <div class="box">
                            <h5>Religion:</h5>
                            <div class="text">
                                <p>{{@$candidate_personal->religion}}</p>
                            </div>
                        </div>
                        <div class="box">
                            <h5>Nationality:</h5>
                            <div class="text">
                                <p>{{@$candidate_personal->nationality}}</p>
                            </div>
                        </div>
                     
                    </div>

                    @if(count($candidate_personal->professionalInfo)>0)


                        <div class="about">
                            <h2 class="title2">Experience</h2>
                            @foreach($candidate_personal->professionalInfo as $p)

                            <div class="box">
                                <div class="year_company">
                                    <h5>{{date('Y',strtotime(@$p->from))}} - {{date('Y',strtotime(@$p->to))}}</h5>
                                    <h5>{{ucwords($p->company_name)}}</h5>
                                </div>
                                <div class="text">
                                    <h4>{{ucwords($p->category_of_job)}}</h4>
                                    <p>@foreach($countries as $value=>$c)
                                                                    @if($value == $p->country)
                                                                        {{$c}}
                                                                    @endif
                                                                @endforeach</p>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    @endif

                
                    @if(@$candidate_personal->cvInfo->skill)
                    <div class="about">
                        <h2 class="title2">Work Skills</h2>
                        <div class=" skill-list">

                        {!! @$candidate_personal->cvInfo->skill !!}
                        </div>
                    </div>
                    @endif

                    @if(@$candidate_personal->cvInfo->duty)
                    <div class="about">
                        <h2 class="title2">Duties & Responsibilities</h2>
                        <div class=" skill-list">

                       {!! @$candidate_personal->cvInfo->duty !!}
                        </div>
                    </div>
                    @endif

                    @if(@$candidate_personal->cvInfo->declaration)
                    <div class="about">
                        <h2 class="title2">Declaration</h2>
                        <p>{{@$candidate_personal->cvInfo->declaration}}</p>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>


