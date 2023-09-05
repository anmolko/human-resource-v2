<link rel="stylesheet" href="{{asset('/backend/assets/seven.css')}}" />

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
            <page class="resume-wrapper" id="pdf-container">
                <section class="intro">
                    <figure class="profile-box">
                            @if(count($candidate_personal->documentInfo) == 0)
                                <img src="{{asset('/images/profiles/others.png')}}" />
                            @else
                                <img src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}"  />
                            @endif
                    </figure>
                    <div class="contact-box">
                    <dl class="intro">
                    @if(@$candidate_personal->mobile_no)
                        <dt>Call</dt>
                        <dd>{{@$candidate_personal->mobile_no}}</dd>
                        @endif
                        <dt>Email</dt>
                        <dd>{{@$candidate_personal->email_address}}</dd>
                        <dt>Home</dt>
                        <dd>{{@$candidate_personal->permanent_address}}</dd>
                        
                    </dl>
                    </div>
                    @if(@$candidate_personal->cvInfo->profile)
                    <div class="word-box">
                    <p>{{@$candidate_personal->cvInfo->profile}}</p>
                    </div>
                    @endif
                    
                    <div class="box">
                    <h3 class="title">Personal Details</h3>
                    <dl class="detail">
                        @if(@$candidate_personal->contact_no)
                        <dt>Contact No</dt>
                            <dd>{{@$candidate_personal->contact_no}}</dd>
                        @endif
                        <dt>Father's Name</dt>
                            <dd>{{@$candidate_personal->father_name}}</dd>

                        <dt >Gender</dt>
                        <dd>{{@$candidate_personal->gender}}</dd>

                        <dt >Marital Status</dt>
                        <dd>{{@$candidate_personal->martial_status}}</dd>

                        <dt >Religion</dt>
                        <dd>{{@$candidate_personal->religion}}</dd>

                        <dt >Nationality</dt>
                        <dd>{{@$candidate_personal->nationality}}</dd>

                        <dt >Language</dt>
                        <dd>{{implode(", ", $languages)}}</dd>
                    </dl>
                    
                        
                    </div>
                    @if(@$candidate_personal->cvInfo->duty)

                    <div class="box">
                    <h3 class="title">Duties</h3>
                    <div class="skills">
                            
                        <div class="sectionContent skill-list">
                        {!! @$candidate_personal->cvInfo->duty !!}
                        </div>
                    
                    </div>
                    </div>
                    @endif

                    
                </section>
                <section class="detail">
                    <header class="">
                    <h1 class="cv-name">{{$name}}</h1>
            
                    </header>
                    <div class="sub-header">
                    <h4 id="type-js">
                        <em class="">DOB: {{@$candidate_personal->date_of_birth}}<br> Passport No: {{@$candidate_personal->passport_no}}</em>
                    </h4>
                    </div>
                    @if(count($candidate_personal->professionalInfo)>0)

                    <div class="box">
                    <h3 class="title">Work-Experience</h3>
                    @foreach($candidate_personal->professionalInfo as $p)

                    <h4>{{ucwords($p->category_of_job)}} - {{ucwords($p->company_name)}}.<span>{{date('M Y',strtotime(@$p->from))}} - {{date('M Y',strtotime(@$p->to))}}</span></h4>
                    <p> @foreach($countries as $value=>$c)
                                                                        @if($value == $p->country)
                                                                            {{$c}}
                                                                        @endif
                                                                    @endforeach</p>
                    @endforeach
                    
                    @endif

                    </div>
                    @if(count($candidate_personal->qualificationInfo)>0)

                    <div class="box">
                    <h3 class="title">Education</h3>
                    @foreach($candidate_personal->qualificationInfo as $q)

                    <h4>{{ucwords(str_replace('-',' ',$q->academic_level))}} <span>({{date('M Y',strtotime(@$q->completed_on))}})</span></h4>
                    <p>{{ucwords($q->school_college_name)}}, {{$q->address}}</p>
                    @endforeach

                    </div>
                    @endif

                    @if(@$candidate_personal->cvInfo->skill)

                    <div class="box">
                    <h3 class="title">Skils</h3>
                    <div class="skills">
                            
                        <div class="sectionContent skill-list">
                        {!! @$candidate_personal->cvInfo->skill !!}
                        </div>

                    </div>
                    </div>
                    @endif
            
                
                </section>
                <footer>
                    @if(@$candidate_personal->cvInfo->declaration)

                        <section class="declaration">
                            <div class="box">
                            <h3 class="title">Declaration</h3>
                            </div>

                            <div class="sectionContent ">
                            {{ @$candidate_personal->cvInfo->declaration }}
                            </div>
                            <div class="clear"></div>
                        </section> 
                        @endif
                </footer>
            </page>
       </div>
    </div>