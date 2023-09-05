<link rel="stylesheet" href="{{asset('/backend/assets/eight.css')}}" />

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
            <div class="wrapper cv-main-container" id="pdf-container">
                <div class="cv-header">
                    
                    <h1 class="quote cv-name">{{$name}}</h1>
                    <h3 class="dob-passport">DOB: {{@$candidate_personal->date_of_birth}}<br> Passport No: {{@$candidate_personal->passport_no}} </h3>
                </div>
                <div class="side">
                    
                    @if(count($candidate_personal->documentInfo) == 0)
                        <div class="photo" style="background-image: url('{{asset('/images/profiles/others.png')}}')"></div>

                    @else
                        <div class="photo" style="background-image: url('{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}')"></div>

                    @endif
                    <div class="info basic-info">
                    <h2>Basic Information</h2>
                    <div class="line"></div>
                    <p>Mobile No： {{ucwords(@$candidate_personal->mobile_no)}}</p>
                    <p>Address： {{ucwords(@$candidate_personal->permanent_address)}}</p>
                    <p>Email： <a href="mailto:{{@$candidate_personal->email_address}}">{{@$candidate_personal->email_address}}</a></p>
                    <p>Gender：{{ucwords(@$candidate_personal->gender)}}</p>
                    <p>Father's Name：{{ucwords(@$candidate_personal->father_name)}}</p>
                    <p>Marital Status：{{ucwords(@$candidate_personal->martial_status)}}</p>
                    <p>Religion：{{ucwords(@$candidate_personal->religion)}}</p>
                    <p>Nationality：{{ucwords(@$candidate_personal->nationality)}}</p>
                    <p>Father's Name：{{ucwords(@$candidate_personal->father_name)}}</p>
                    <p>Language：{{ucwords(implode(", ", $languages))}}</p>
                    
                    </div>
                    @if(@$candidate_personal->cvInfo->skill)
                    <div class="skills">
                        <h2>Skills</h2>
                        <div class="line"></div>
                            <div class="sectionContent skill-list">
                            {!! @$candidate_personal->cvInfo->skill !!}
                            </div>
                    </div>
                    @endif

                    @if(@$candidate_personal->cvInfo->duty)
                    <div class="skills">
                        <h2>Responsibilities</h2>
                        <div class="line"></div>
                            <div class="sectionContent skill-list">
                            {!! @$candidate_personal->cvInfo->duty !!}
                            </div>
                    </div>
                    @endif

                </div>
                <div class="cv-content">
                    @if(@$candidate_personal->cvInfo->profile)

                    <h2>About Me</h2>
                    <div class="line"></div>
                    <p>{{@$candidate_personal->cvInfo->profile}}</p>
                    @endif

                    @if(count($candidate_personal->professionalInfo)>0)
                
                    <h2>Work Experience</h2>
                    <div class="line"></div>
                    <ul class="timeline">
                    @foreach($candidate_personal->professionalInfo as $p)

                    <div class="event" data-date="{{date('M Y',strtotime(@$p->from))}} - {{date('M Y',strtotime(@$p->to))}}">
                        <h3>{{ucwords($p->category_of_job)}} | {{ucwords($p->company_name)}}</h3>
                        <h4>@foreach($countries as $value=>$c)
                                                                        @if($value == $p->country)
                                                                            {{$c}}
                                                                        @endif
                                                                    @endforeach</h4>
                       
                    </div><br>
                    @endforeach
                    
                    </ul>
                    @endif


                    @if(count($candidate_personal->qualificationInfo)>0)
                
                    <h2>Education</h2>
                    <div class="line"></div>
                    <ul class="timeline">
                    @foreach($candidate_personal->qualificationInfo as $q)

                    <div class="event" data-date="{{date('Y',strtotime(@$q->completed_on))}}">
                        <h3>{{ucwords(str_replace('-',' ',$q->academic_level))}} </h3>
                        <h4>{{ucwords($q->school_college_name)}} -- {{$q->address}}</h4>
                       
                    </div><br>
                    @endforeach
                    
                    </ul>
                    @endif
                    @if(@$candidate_personal->cvInfo->declaration)


                    <h2>Declaration</h2>
                    <div class="line"></div>
                    <p>{{@$candidate_personal->cvInfo->declaration}}</p>
                    @endif
                <br><br>
                </div>
            </div>
       </div>
    </div>