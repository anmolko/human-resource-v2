

    <link rel="stylesheet" href="{{asset('/backend/assets/four.css')}}" />

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

              <div class="cv" id="pdf-container">
                <div class="cv-row">
                  <div class="cv-wrap">
                    <div class="cv-name">{{$name}}</div>
                    <div class="cv-subname">Passport No: {{@$candidate_personal->passport_no}}</div>

                    @if(@$candidate_personal->cvInfo->profile)

                    <div class="cv-content">
                      <div class="head-title">Summary</div>
                    
                      <p>{{@$candidate_personal->cvInfo->profile}}</p>
                  
                    </div>
                    @endif

                    @if(count($candidate_personal->professionalInfo)>0)

                    <div class="cv-content">
                      <div class="head-title">Exprecince</div>
                      @foreach($candidate_personal->professionalInfo as $p)

                      <div class="cv-content-item">
                        <div class="title">{{ucwords($p->category_of_job)}}</div>
                        <div class="subtitle">{{ucwords($p->company_name)}}</div>
                        <div class="time">{{date('M, Y',strtotime(@$p->from))}} - {{date('M, Y',strtotime(@$p->to))}}, @foreach($countries as $value=>$c)
                                                                      @if($value == $p->country)
                                                                          {{$c}}
                                                                      @endif
                                                                  @endforeach</div>
                      </div>
                      @endforeach
                  
                    </div>
                    @endif

                    @if(count($candidate_personal->qualificationInfo)>0)

                    <div class="cv-content">
                        <div class="head-title">Education</div>
                        
                        @foreach($candidate_personal->qualificationInfo as $q)

                        <div class="cv-content-item">
                          <div class="title">{{ucwords(str_replace('-',' ',$q->academic_level))}}
                          </div>
                          <div class="subtitle">{{ucwords($q->school_college_name)}}</div>
                          <div class="time">{{date('M Y',strtotime(@$q->completed_on))}}, {{ucwords($q->address)}}</div>
                        </div>
                        @endforeach
                  
                    </div>
                    @endif

                    @if(@$candidate_personal->cvInfo->duty)
                      <div class="cv-content">
                        <div class="head-title">Duties</div>
                        <div class=" skill-list">
                          {!! @$candidate_personal->cvInfo->duty !!}
                        </div>
                      </div>
                    @endif

                    

                   
                    

                  </div>
                  <div class="cv-wrap">
                    <div class="avatar">
                      @if(count($candidate_personal->documentInfo) == 0)
                            <img src="{{asset('/images/profiles/others.png')}}" />
                        @else
                            <img src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}" />
                        @endif
                    </div>
                    <div class="info">
                      <div class="title">Contact</div>
                      <p><a href="mailto:{{@$candidate_personal->email_address}}">{{@$candidate_personal->email_address}}</a></p>
                      <p><a href="tel:{{@$candidate_personal->mobile_no}}">{{@$candidate_personal->mobile_no}}</a></p>
                      <p><a href="tel:{{@$candidate_personal->contact_no}}">{{@$candidate_personal->contact_no}}</a></p>
                      <p></p>
                    </div>
                    <div class="cv-skills">
                        <div class="head-title">Personal Details
                        </div>
                        <div class="cv-skills-item">
                        <div class="title">DOB: <strong>{{date('M j, Y',strtotime(@$candidate_personal->date_of_birth))}}</strong></div>
                        <div class="title">Address: <strong>{{@$candidate_personal->permanent_address}}</strong></div>
                        <div class="title">Father's Name: <strong>{{@$candidate_personal->father_name}}</strong></div>
                        <div class="title">Gender: <strong>{{@$candidate_personal->gender}}</strong></div>
                        <div class="title">Marital Status: <strong>{{@$candidate_personal->martial_status}}</strong></div>
                        <div class="title">Religion: <strong>{{@$candidate_personal->religion}}</strong></div>
                        <div class="title">Nationality: <strong>{{@$candidate_personal->nationality}}</strong></div>
                        
                        </div>
                    
                      </div>


                      @if(count($candidate_personal->languageInfo)>0)

                      <div class="cv-skills">
                        <div class="head-title">Languages
                        </div>
                        <div class="cv-skills-item">
                          @foreach($candidate_personal->languageInfo as $lang)
                            <div class="title">{{ucwords(@$lang->language)}}</div>
                          @endforeach

                        </div>
                    
                      </div>
                      @endif

                    
                    
                
                    @if(@$candidate_personal->cvInfo->skill)
                      <div class="cv-content">
                        <div class="head-title">Skills</div>
                        <div class=" skill-list">
                          {!! @$candidate_personal->cvInfo->skill !!}
                        </div>
                      </div>
                    @endif
                    
                    </div>
                    

                </div>
                <div class="cv-row">

                   @if(@$candidate_personal->cvInfo->declaration)
                      <div class="cv-content">
                        <div class="head-title">Declaration</div>
                        {!! @$candidate_personal->cvInfo->declaration !!}
                      </div>
                    @endif
                
                </div>
              </div>

      </div>
    </div>


