<link rel="stylesheet" href="{{asset('/backend/assets/six.css')}}" />

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
        <page size="A4" id="pdf-container">
        
            <div class="cv">
                <div id="header">
                <div class="contactDetails">
                    <ul>
                    @if(@$candidate_personal->email_address)
                        <li class="icon" ><a href="mailto:{{@$candidate_personal->email_address}}"><i class="fa fa-envelope">&nbsp;&nbsp;</i>{{@$candidate_personal->email_address}}</a></li>
                    @endif
                    @if(@$candidate_personal->mobile_no)
                        <li class="icon" ><a href="tel:{{@$candidate_personal->mobile_no}}"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;{{@$candidate_personal->mobile_no}}</a></li>
                    @endif
                    @if(@$candidate_personal->contact_no)
                        <li class="icon" ><a href="tel:{{@$candidate_personal->contact_no}}"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;{{@$candidate_personal->contact_no}}</a></li>
                    @endif
                    
                    </ul>
                </div>
                </div>
                <div class="mainDetails">
                <div id="headshot">
                            @if(count($candidate_personal->documentInfo) == 0)
                                <img id="avatar"  src="{{asset('/images/profiles/others.png')}}" />
                            @else
                                <img id="avatar"  src="{{asset('/images/document/'.@$candidate_personal->documentInfo[0]->photograph_image)}}" />
                            @endif
                    <!-- <img id="avatar" src="https://visualangle.ee/delivery/temp_image/icon.png" alt="Margus Lillemagi" title="See olen mina" /> -->
                </div>
                <div id="name">
                    <h1><span class="cv-name">{{$name}}</span></br><span class="nameDetails">&nbsp;&nbsp;{{date('j M  Y',strtotime(@$candidate_personal->date_of_birth))}}</span></h1>
                </div>
                <div class="clear"></div>
                </div>
                <div id="mainArea">
                @if(@$candidate_personal->cvInfo->profile)

                <section>
                    <article>
                        <div class="sectionTitle">
                            <h1>Profile</h1>
                        </div>
                        <div class="sectionContent">
                                <p>{{@$candidate_personal->cvInfo->profile}}</p>
                           </div>
                    </article>
                    <div class="clear"></div>
                </section>
                @endif

                <section>
                    <div class="sectionTitle">
                        <h1>Personal Details</h1>
                    </div>
                    <div class="sectionContent">
                        <ul class="keySkills personal-detail-container">
                            <li class="subDetails">Permanent Address:</li>
                            <li>&nbsp;{{@$candidate_personal->permanent_address}}</li>
                            
                
                            <li class="subDetails">Father's Name:</li>
                            <li>&nbsp;{{@$candidate_personal->father_name}}</li>

                            <li class="subDetails">Gender:</li>
                            <li>&nbsp;{{@$candidate_personal->gender}}</li>

                            <li class="subDetails">Marital Status:</li>
                            <li>&nbsp;{{@$candidate_personal->martial_status}}</li>

                            <li class="subDetails">Religion:</li>
                            <li>&nbsp;{{@$candidate_personal->religion}}</li>

                            <li class="subDetails">Nationality:</li>
                            <li>&nbsp;{{@$candidate_personal->nationality}}</li>

                            <li class="subDetails">Language:</li>
                            <li>&nbsp;{{implode(", ", $languages)}}</li>

                            <li class="subDetails">Passport No: </li>
                            <li>&nbsp;{{@$candidate_personal->passport_no}}</li>

                            
                        </ul>
                    </div>
                    <div class="clear"></div>
                </section>

         
                @if(count($candidate_personal->qualificationInfo)>0)

                <section>
                    <div class="sectionTitle">
                        <h1>Education</h1>
                    </div>
                    <div class="sectionContent">
                        <ul class="list">
                            @foreach($candidate_personal->qualificationInfo as $q)

                                <li><span class="subDetails">{{date('Y',strtotime(@$q->completed_on))}} | {{ucwords(str_replace('-',' ',$q->academic_level))}}&nbsp;&nbsp;</span><span class="bold">{{ucwords($q->school_college_name)}}</span> - {{$q->address}}</li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="clear"></div>
                </section>
                @endif
                @if(count($candidate_personal->professionalInfo)>0)
                <section>
                    <div class="sectionTitle">
                        <h1>Work Experience</h1>
                    </div>
                    <div class="sectionContent">
                        <ul class="list">
                            @foreach($candidate_personal->professionalInfo as $p)

                            <li><span class="subDetails">{{date('Y',strtotime(@$p->from))}} - {{date('Y',strtotime(@$p->to))}}&nbsp; | {{ucwords($p->category_of_job)}} </span><span class="bold">{{ucwords($p->company_name)}},</span>@foreach($countries as $value=>$c)
                                                                @if($value == $p->country)
                                                                    {{$c}}
                                                                @endif
                                                            @endforeach</li>
                            @endforeach
                         
                        </ul>
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
                    <div class="sectionContent">
                    {{ @$candidate_personal->cvInfo->declaration }}
                    </div>
                    <div class="clear"></div>
                </section>
                @endif

                </div>
            </div>
        </page>
       </div>
    </div>