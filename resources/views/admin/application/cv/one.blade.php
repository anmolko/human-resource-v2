
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" />
    <link rel="stylesheet" href="{{asset('/backend/assets/one.css')}}" />

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

            <div id="pdf-container" class="cv instaFade breakFastBurrito">
                <div class="mainDetails">
                    <div id="headshot" class="quickFade">
                                @if(count($candidate_personal->documentInfo) == 0)
                                    <img src="{{asset('/images/profiles/others.png')}}" class="mt-3"/>
                                @else
                                    <img src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}" class="mt-3" />
                                @endif
                    </div>
        
                    <div id="name">
                        <h1 class="quickFade delayTwo cv-name">{{$name}}</h1>
                        <div class="bioDetails">
                            <div style="float: left">DOB: {{@$candidate_personal->date_of_birth}}</div>
                            <div style="float: right">Passport No: {{@$candidate_personal->passport_no}}</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
        
                <div class="primaryContent">
                 
        
                    <div id="mainArea" class="quickFade delayFive">
                        @if(@$candidate_personal->cvInfo->profile)
                        <section id="Profile">
                            <article>
                                <div class="sectionTitle">
                                    <h1>Personal Profile</h1>
                                </div>
        
                                <div class="sectionContent">
                                    <p>{{@$candidate_personal->cvInfo->profile}}</p>
                                </div>
                            </article>
                            <div class="clear"></div>
                        </section>
                        @endif

                        <section id="credentials">
                            <div class="sectionTitle">
                                <h1>Basic Info</h1>
                            </div>
                            <div class="sectionContent">
                                <div class="phone">
                                    @if(@$candidate_personal->mobile_no)
                                    <div class="item">
                                        <div class="contactIcon"><i class="fa fa-phone fa-fw fa-lg" aria-hidden="true"></i></div>
                                        <div class="contactInfo">{{@$candidate_personal->mobile_no}}</div>
                                    </div>
                                    @endif
                                    @if(@$candidate_personal->contact_no)
                                    <div class="item">
                                        <div class="contactIcon"><i class="fa fa-phone fa-fw fa-lg" aria-hidden="true"></i></div>
                                        <div class="contactInfo">{{@$candidate_personal->contact_no}} </div>
                                    </div>
                                    @endif

                                    <div class="item">
                                        <div class="contactIcon"><i class="fa fa-at fa-fw fa-lg" aria-hidden="true"></i></div>
                                        <div class="contactInfo">{{@$candidate_personal->email_address}}</div>
                                    </div>
                                </div>
                                <div class="address">
                                    <div class="item">
                                        <div class="contactIcon"><i class="fa fa-envelope fa-fw fa-lg" aria-hidden="true"></i></div>
                                        <div class="contactInfo">
                                        {{@$candidate_personal->permanent_address}}
                                        </div>
                                    </div>
                                </div>
                            
        
                            </div>
                            <div class="clear"></div>

                        </section>
                        <section id="credentials">
                            <div class="sectionTitle">
                                <h1>Personal Details</h1>
                            </div>
                            <div class="sectionContent">
                                <div class="item">
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
                            <div class="clear"></div>
                        </section>
        
                        @if(count($candidate_personal->qualificationInfo)>0)
                                        
                        <section id="Education">
                            <div class="sectionTitle">
                                <h1>Education</h1>
                            </div>
                            <div class="sectionContent">
                              

                                @foreach($candidate_personal->qualificationInfo as $q)
                                        
                                    <article>
                                        <h2>{{ucwords(str_replace('-',' ',$q->academic_level))}}</h2>
                                        <h3>{{ucwords($q->school_college_name)}}</h3>
                                        <p class="subDetails">Graduate on {{date('M j, Y',strtotime(@$q->completed_on))}}</p>
                                        <p>{{$q->address}}</p>
                                    </article>
                                @endforeach
                               
                            </div>
                            <div class="clear"></div>
                        </section>
                        @endif
        
                        @if(count($candidate_personal->professionalInfo)>0)
                            <section id="Work">
                                <div class="sectionTitle">
                                    <h1>Work Experience</h1>
                                </div>
            
                                <div class="sectionContent">
                                    @foreach($candidate_personal->professionalInfo as $p)

                                        <article>
                                            <h2>{{ucwords($p->category_of_job)}}</h2>
                                            <h3>{{ucwords($p->company_name)}}</h3>
                                            <p class="subDetails">{{date('M j, Y',strtotime(@$p->from))}} - {{date('M j, Y',strtotime(@$p->to))}}</p>
                                            <p>  @foreach($countries as $value=>$c)
                                                                @if($value == $p->country)
                                                                    {{$c}}
                                                                @endif
                                                            @endforeach
                                                        </p>
                                        </article>
                                    @endforeach
                                   
                                </div>
                                <div class="clear"></div>
                            </section>
                        @endif
                        @if(@$candidate_personal->cvInfo->skill)
        
                        <section>
                            <div class="sectionTitle">
                            <h1>Key Skills</h1>
                            </div>
                    
                            <div class="sectionContent skill-list">
                            {!! @$candidate_personal->cvInfo->skill !!}
                            </div>
                            <div class="clear"></div>
                        </section> 
                        @endif

                        @if(@$candidate_personal->cvInfo->duty)

                        <section>
                            <div class="sectionTitle">
                            <h1>Duties</h1>
                            </div>
                    
                            <div class="sectionContent skill-list">
                            {!! @$candidate_personal->cvInfo->duty !!}
                            </div>
                            <div class="clear"></div>
                        </section> 
                        @endif

                        @if(@$candidate_personal->cvInfo->declaration)

                            <section>
                                <div class="sectionTitle">
                                <h1>Declaration</h1>
                                </div>

                                <div class="sectionContent declaration">
                                {{ @$candidate_personal->cvInfo->declaration }}
                                </div>
                                <div class="clear"></div>
                            </section> 
                            @endif
                       
        
                    </div>
                </div>
            </div>
        </div>
    </div>
  

