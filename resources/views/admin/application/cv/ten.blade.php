<link rel="stylesheet" href="{{asset('/backend/assets/ten.css')}}" />

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
            <div class="cv-main-container" >
            <article class="resume-wrapper text-center position-relative " id="pdf-container">
                <div class="resume-wrapper-inner mx-auto text-start bg-white shadow-lg">
                    <header class="resume-header pt-4 pt-md-0">
                        <div class="row">
                            <div class="col-block col-md-auto resume-picture-holder text-center text-md-start">
                            @if(count($candidate_personal->documentInfo) == 0)
                                <img class="picture" src="{{asset('/images/profiles/others.png')}}" />
                            @else
                                <img class="picture" src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}"  />
                            @endif
                            </div><!--//col-->
                            <div class="col">
                                <div class="row p-4 justify-content-center justify-content-md-between">
                                    <div class="primary-info col-auto">
                                        <h1 class="name mt-0 mb-1 text-white text-uppercase text-uppercase cv-name">{{$name}}</h1>
                                        <div class="title mb-3">Passport No: {{@$candidate_personal->passport_no}}</div>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><a class="text-link" href="#">DOB: {{@$candidate_personal->date_of_birth}}</a></li>
                                            <li class="mb-2"><a class="text-link" href="#">{{ucwords(@$candidate_personal->permanent_address)}} | {{ucwords(@$candidate_personal->mobile_no)}}</a></li>
                                            <li class="mb-2"><a class="text-link" href="#">{{@$candidate_personal->email_address}}</a></li>
                                        </ul>
                                    </div><!--//primary-info-->
                                
                                </div><!--//row-->
                                
                            </div><!--//col-->
                        </div><!--//row-->
                    </header>
                    <div class="resume-body p-5">
                        @if(@$candidate_personal->cvInfo->profile)

                        <section class="resume-section summary-section mb-5">
                            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Career Summary</h2>
                            <div class="resume-section-content">
                                    <p class="mb-0">{{@$candidate_personal->cvInfo->profile}}</p>
                            </div>
                        </section><!--//summary-section-->
                        @endif

                        <div class="row">
                            <div class="col-lg-8">
                            @if(count($candidate_personal->professionalInfo)>0)

                                <section class="resume-section experience-section mb-5">
                                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Work Experience</h2>
                                    <div class="resume-section-content">
                                        <div class="resume-timeline position-relative">
                                        
                                            @foreach($candidate_personal->professionalInfo as $p)

                                            <article class="resume-timeline-item position-relative pb-5">
                                                
                                                <div class="resume-timeline-item-header mb-2">
                                                    <div class="d-flex flex-column flex-md-row">
                                                        <h3 class="resume-position-title font-weight-bold mb-1">{{ucwords($p->category_of_job)}} <small class="text-muted">({{ucwords($p->company_name)}})</small></h3>
                                                        <div class="resume-company-name ms-auto"></div>
                                                    </div><!--//row-->
                                                    <div class="resume-position-time">{{date('Y',strtotime(@$p->from))}} - {{date('Y',strtotime(@$p->to))}}</div>
                                                </div><!--//resume-timeline-item-header-->
                                                <div class="resume-timeline-item-desc">
                                                    <p>@foreach($countries as $value=>$c)
                                                                        @if($value == $p->country)
                                                                            {{$c}}
                                                                        @endif
                                                                    @endforeach</p>
                                                    
                                                </div><!--//resume-timeline-item-desc-->

                                            </article><!--//resume-timeline-item-->
                                            @endforeach
                                            
                                            
                                        </div><!--//resume-timeline-->
                                        
                                    </div>
                                </section><!--//experience-section-->
                                @endif

                                @if(@$candidate_personal->cvInfo->duty)
                                <section class="resume-section skills-section mb-5">
                                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Responsibilities</h2>
                                    <div class="resume-section-content">
                                        <div class="resume-skill-item">
                                            @if(@$candidate_personal->cvInfo->duty)
                                                    <div class="sectionContent skill-list">
                                                    {!! @$candidate_personal->cvInfo->duty !!}
                                                    </div>
                                            @endif
                                        </div><!--//resume-skill-item-->
                                       
                                    </div><!--resume-section-content-->
                                </section><!--//skills-section-->
                                @endif

                                @if(@$candidate_personal->cvInfo->declaration)
                                <section class="resume-section skills-section mb-5">
                                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Declaration</h2>
                                    <div class="resume-section-content">
                                        <div class="resume-skill-item">
                                            @if(@$candidate_personal->cvInfo->declaration)
                                                    {!! @$candidate_personal->cvInfo->declaration !!}
                                            @endif
                                        </div><!--//resume-skill-item-->
                                       
                                    </div><!--resume-section-content-->
                                </section><!--//skills-section-->
                                @endif

                            </div>
                            <div class="col-lg-4">
                            @if(@$candidate_personal->cvInfo->skill)
                                <section class="resume-section skills-section mb-5">
                                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Skills</h2>
                                    <div class="resume-section-content">
                                        <div class="resume-skill-item">
                                            @if(@$candidate_personal->cvInfo->skill)
                                                    <div class="sectionContent skill-list">
                                                    {!! @$candidate_personal->cvInfo->skill !!}
                                                    </div>
                                            @endif
                                        </div><!--//resume-skill-item-->
                                       
                                    </div><!--resume-section-content-->
                                </section><!--//skills-section-->
                                @endif

                              

                            @if(count($candidate_personal->qualificationInfo)>0)

                                <section class="resume-section education-section mb-5">
                                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Education</h2>
                                    <div class="resume-section-content">
                                        <ul class="list-unstyled">
                                             @foreach($candidate_personal->qualificationInfo as $q)

                                            <li class="mb-2">
                                                <div class="resume-degree font-weight-bold">{{ucwords(str_replace('-',' ',$q->academic_level))}}</div>
                                                <div class="resume-degree-org">{{ucwords($q->school_college_name)}}</div>
                                                <div class="resume-degree-time">{{date('Y',strtotime(@$q->completed_on))}} | {{$q->address}}</div>
                                            </li>
                                            @endforeach
                                          
                                        </ul>
                                    </div>
                                </section><!--//education-section-->
                            @endif

                                @if(count($candidate_personal->languageInfo)>0)
                               
                                <section class="resume-section language-section mb-5">
                                    <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Language</h2>
                                    <div class="resume-section-content">
                                        <ul class="list-unstyled resume-lang-list">
                                            @foreach($candidate_personal->languageInfo as $lang)
                                            <li class="mb-2"><span class="resume-lang-name font-weight-bold">{{ucwords(@$lang->language)}}</span></li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </section><!--//language-section-->
                                @endif
                                
                           
                                
                            </div>
                        </div><!--//row-->
                    </div><!--//resume-body-->
                    
                    
                </div>
            </article> 


            </div>
       </div>
    </div>